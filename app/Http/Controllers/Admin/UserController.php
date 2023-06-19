<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
//        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
//        $this->middleware('permission:user-create', ['only' => ['create','store']]);
//        $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('id','desc')->get();
        return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users,email',
            'phone_number'=>'required|regex:(^0\d{8,9}$)|min:9|max:10',
            'gender'=>'required|in:male,female',
            'username' => 'required|unique:users,username',
            'password' => 'required|same:confirm_pass',
            'role_id' => 'required|integer',
        ]);
        $user = User::create([
            'first_name'=>$request->input('first_name'),
            'last_name'=>$request->input('last_name'),
            'email'=>$request->input('email'),
            'phone_number'=>$request->input('phone_number'),
            'gender'=>$request->input('gender'),
            'username'=>$request->input('username'),
            'password'=>Hash::make($request->input('password')),
            'address'=>$request->input('address'),
        ]);
        $user->assignRole($request->input('role_id'));
        return redirect()->route('users.index')->with('success','User has been Create Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrFail(decrypt($id));
        return view('admin.users.edit',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name'=>'required',
            'last_name'=>'required',
            'email' => 'required|email|unique:users,email,'.decrypt($id),
            'phone_number'=>'required|regex:(^0\d{8,9}$)|min:9|max:10',
            'gender'=>'required|in:male,female',
            'username' => 'required|unique:users,username,'.decrypt($id),
            'role_id' => 'required|integer',
        ]);
        $user = User::findOrFail(decrypt($id));
        $user->update([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'phone_number'=>$request->get('phone_number'),
            'gender'=>$request->get('gender'),
            'username'=>$request->get('username'),
            'address'=>$request->get('address'),
        ]);
//        $get_role=$request->get('role_id');
        $tt=DB::table('model_has_roles')->where('model_id',decrypt($id))->delete();

        $user->assignRole($request->get('role_id'));
//        return dd($tt);
//
        return redirect()->route('users.index')->with('success','User has been Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail(decrypt($id));
        if ($user->id==1){
            return redirect()->route('users.index')->with('warning','Can\'n Delete this User but you can update it.');
        }else{
            $user->delete();
            return redirect()->route('users.index')->with('success','User has been Deleted Successfully.');
        }
    }

    public function changeStatus(Request $request){
        User::find($request->id)->update(['status' => $request->status]);

        return response()->json(['success'=>'Status changed successfully.']);
    }

    public function resetPassword(Request $request)
    {
        try {
            $userId = decrypt($request->user_id);
        } catch (DecryptException $e) {
            abort(404, 'Not Found!');
        }

        $user = User::findOrFail($userId);

        $request->validate([
            'password' => 'required|string|same:confirm-password',
            'confirm-password' => 'required|same:password',
        ]);

        try {
            $user->password = Hash::make($request->password);
            $user->save();
            $user->tokens()->delete();
//            \LogActivity::addToLog('Reset Password');
        } catch (\Exception $e) {
            return back()->withErrors([ 'password' => $e->getMessage()]);
        }

        return back()->with('success', "Password has been reset successfully.");
    }
}
