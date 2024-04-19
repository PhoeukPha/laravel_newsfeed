<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')){
            $date = explode('-', $request->input('daterange'));
            $date_f = date("Y-m-d", strtotime($date['0']));
            $date_t = date("Y-m-d", strtotime($date['1']));
            $view = DB::table("articles")
                ->select(DB::raw('sum(viewer) as total'),DB::raw('date(created_at) as dates'))
                ->whereBetween(DB::raw('DATE(created_at)'), [$date_f, $date_t])
                ->groupBy('dates')
                ->orderBy('dates','asc')
                ->get();
        }
        else{
            $view = DB::table("articles")
                ->select(DB::raw('sum(viewer) as total'),DB::raw('date(created_at) as dates'))
                ->where('created_at', '>=', DB::raw('DATE(NOW()) - INTERVAL 10 DAY'))
                ->groupBy('dates')
                ->orderBy('dates','asc')
                ->get();
        }
        return view('admin.index',compact('view'));
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
        //
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
        //
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
}
