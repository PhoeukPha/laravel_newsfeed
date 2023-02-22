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
}
