<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.profiles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'image'=>'required',
        ]);
        $user = User::find(auth()->user()->id);
        if ($request->hasFile('image')){
            $image_path = public_path("/admin/dist/img/users/".$user->avatar);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
            $img = $request->file('image');
            $imgName = date('YmdHis').".".$img->getClientOriginalExtension();
            $destinationPath = public_path('/admin/dist/img/users/');
            $img->move($destinationPath, $imgName);
        }else {
            $imgName = $user->avatar;
        }
        $user->update([
//            'first_name'=>$request->get('first_name'),
            'avatar'=>$imgName,
        ]);
//        return  dd($request->hasFile('image'));

        return redirect()->back()->with('success','Profile Picture has upload.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'email' => 'required|email|unique:users,email,'.$id,
            'phone_number'=>'required',
            'gender'=>'required|in:male,female',
            'username' => 'required|unique:users,username,'.$id,
        ]);
        $user = User::find($id);
        $user->update([
            'first_name'=>$request->get('first_name'),
            'last_name'=>$request->get('last_name'),
            'email'=>$request->get('email'),
            'phone_number'=>$request->get('phone_number'),
            'gender'=>$request->get('gender'),
            'username'=>$request->get('username'),
            'address'=>$request->get('address'),
        ]);
        return redirect()->route('profiles.index')->with('success','Profile Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //    Change Password
    public function change_password(Request $request){
        $this->validate($request,[
            'current_password'=>'required',
            'new_password'=>'required|same:confirm_pass',
            'confirm_pass'=>'required',
        ]);
//        Check password
        if(Hash::check(\request()->input('current_password'),auth()->user()->password)){
            User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
            return redirect()->back()->with('success','Password Update Successfully');
        }else{
            return redirect()->back()->with('error','The Current Password not much.');
        }
    }
}
