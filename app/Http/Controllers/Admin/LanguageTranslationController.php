<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use File;
class LanguageTranslationController extends Controller
{
    public function __construct()
    {
//        $this->middleware('permission:language-list|language-create|language-edit|language-delete', ['only' => ['index']]);
//        $this->middleware('permission:language-create', ['only' => ['create','store']]);
//        $this->middleware('permission:language-edit', ['only' => ['edit','update']]);
//        $this->middleware('permission:language-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $languages = DB::table('languages')->get();
        $columns = [];
        $columnsCount = $languages->count();

        if($languages->count() > 0){
            foreach ($languages as $key => $language){
                if ($key == 0) {
                    $columns[$key] = $this->openJSONFile($language->code);
                }
                $columns[++$key] = ['data'=>$this->openJSONFile($language->code), 'lang'=>$language->code];
            }
        }
        return view('admin.language', compact('languages','columns','columnsCount'));
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
        $request->validate([
            'key' => 'required',
            'value' => 'required',
        ]);

        $data = $this->openJSONFile('en');
        $data[$request->key] = $request->value;

        $this->saveJSONFile('en', $data);

        return redirect()->route('languages');
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
    public function destroy($key)
    {
        $languages = DB::table('languages')->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                unset($data[$key]);
                $this->saveJSONFile($language->code, $data);
            }
        }
        return response()->json(['success' => $key]);
    }

    /**
     * Open Translation File
     * @return Response
     */
    private function openJSONFile($code){
        $jsonString = [];
        if(File::exists(base_path('resources/lang/'.$code.'.json'))){
            $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }
    /**
     * Save JSON File
     * @return Response
     */
    private function saveJSONFile($code, $data){
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
    }


    /**
     * Save JSON File
     * @return Response
     */
    public function transUpdate(Request $request){
        $data = $this->openJSONFile($request->code);
        $data[$request->pk] = $request->value;

        $this->saveJSONFile($request->code, $data);
        return response()->json(['success'=>'Done!']);
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function transUpdateKey(Request $request){
        $languages = DB::table('languages')->get();

        if($languages->count() > 0){
            foreach ($languages as $language){
                $data = $this->openJSONFile($language->code);
                if (isset($data[$request->pk])){
                    $data[$request->value] = $data[$request->pk];
                    unset($data[$request->pk]);
                    $this->saveJSONFile($language->code, $data);
                }
            }
        }
        return response()->json(['success'=>'Done!']);
    }
}
