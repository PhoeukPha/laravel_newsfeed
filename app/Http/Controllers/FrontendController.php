<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $menu = Category::where('status',1)->get();

        $slide = Article::inRandomOrder()->where('status',1)->limit(3)->get();

        $last_post = Article::orderby('created_at','desc')->where('status',1)->limit(5)->get();

        $content = Article::orderby('created_at','desc')->where('status',1)->limit(6)->get();

        return view('index',compact('menu','slide','last_post','content'));
    }

    public function detail($slug){
        $menu = Category::where('status',1)->get();

        $slide = Article::inRandomOrder()->where('status',1)->limit(3)->get();

        $last_post = Article::orderby('created_at','desc')->where('status',1)->limit(3)->get();

        $data = Article::where('slug',$slug)->first();

        Article::where('slug',$slug)->increment('viewer',1);

        if ($data == null){
            return view('layouts.404',compact('menu','slide','last_post'));
        }else{
            return view('detail',compact('menu','slide','last_post','data'));
        }
    }

    public function get_data_by_category($value){
        $menu = Category::where('status',1)->get();

        $slide = Article::inRandomOrder()->where('status',1)->limit(3)->get();

        $last_post = Article::orderby('created_at','desc')->where('status',1)->limit(3)->get();

        $data = Article::join('categories','articles.category_id','=','categories.id')->where('categories.name',$value)->get();

        return view('filter',compact('menu','slide','last_post','data'));
    }

    public function get_data_by_sub_category($value){
        $menu = Category::where('status',1)->get();

        $slide = Article::inRandomOrder()->where('status',1)->limit(3)->get();

        $last_post = Article::orderby('created_at','desc')->where('status',1)->limit(3)->get();

        $data = Article::join('sub_categories','articles.sub_category_id','=','sub_categories.id')->where('sub_categories.name',$value)->get();

        return view('filter',compact('menu','slide','last_post','data'));
    }
}
