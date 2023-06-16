<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleAPIController extends Controller
{
    function index(){
        return Article::where('status',1)->get();
    }
    function getByID($id){
        $data = Article::findOrFail($id);
        return response()->json($data);
    }
}
