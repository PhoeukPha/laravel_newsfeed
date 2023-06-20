<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use File;

class ArticleController extends Controller
{
    public function makeSlug($string)
    {
        $LNSH = '/[^\-\s\pN\pL]+/u';
        $SADH   = '/[\-\s]+/';

        $string = preg_replace($LNSH, '', mb_strtolower($string, 'UTF-8'));
        $string = preg_replace($SADH, '-', $string);
        $string = trim($string, '-');

        return $string;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page') ?? 10;
        if ($request->query('title') || $request->query('menu_id')) {
            $data = Article::search(
                $request->query('title'),
                $request->query('menu_id')
            )->paginate($perPage);
        }else{
            $data = Article::orderby('created_at','desc')->paginate($perPage);
        }

        return view('admin.articles.index',compact('data'))->with('i', ($request->input('page', 1) - 1) * $perPage);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
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
           'title' => 'required',
            'body' => 'required',
            'thumbnail.*' => 'required'
        ]);
//        Thumbnail
        $img = $request->file('thumbnail');
        $imgName = date('YmdHis').'.'.$img->getClientOriginalExtension();
        $path = public_path('/frontend/assets/images/thumbnail/');
        $img->move($path,$imgName);

        Article::create([
           'title' => $request->input('title'),
           'slug' => $this->makeSlug($request->input('title')),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'body' => $request->input('body'),
            'thumbnail' => $imgName,
        ]);

        return redirect()->route('articles.index')->with('success','Article Created Successful.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Article::findOrFail(decrypt($id));
        return view('admin.articles.edit',compact('data'));
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
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'thumbnail.*' => 'required'
        ]);
        $data = Article::findOrFail(decrypt($id));
        if ($request->hasFile('thumbnail')){
            $path = public_path('/frontend/assets/images/thumbnail/'.$data->thumbnail);
            if (File::exists($path)){
                File::delete($path);
            }
            $img = $request->file('thumbnail');
            $imgName = date('YmdHis').'.'.$img->getClientOriginalExtension();
            $path = public_path('/frontend/assets/images/thumbnail/');
            $img->move($path,$imgName);
        }else{
            $imgName = $data->thumbnail;
        }
        $data->update([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'sub_category_id' => $request->input('sub_category_id'),
            'body' => $request->input('body'),
            'thumbnail' => $imgName,
        ]);
        return redirect()->route('articles.index')->with('success','Article Updated Successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Article::findOrFail(decrypt($id));
        unlink(public_path('frontend/assets/images/thumbnail/'.$data->thumbnail));

        $data->delete();
        return redirect()->route('articles.index')->with('success','Article Deleted Successful.');
    }

    public function getSubCategory(Request $request){
        $cat_ids = $request->cat_id;
        $sub_cat_id = SubCategory::where('category_id',$cat_ids)->where('status',1)->get();
//        dd($sub_cat_id);
        return Response()->json([
            'sub_cat_id' => $sub_cat_id
        ]);
    }
    public function changeStatus (Request $request){
        $data = Article::find($request->id)->update(['status' => $request->status]);
        return response()->json(['success','Status Change Successful']);
    }
}
