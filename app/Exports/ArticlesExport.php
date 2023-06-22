<?php

namespace App\Exports;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class ArticlesExport implements FromCollection
{

    /**
    * @return \Illuminate\Support\Collection
    */
    protected $from_date;
    protected $to_date;
    function __construct($from_date,$to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
    public function collection()
    {
        $data =  DB::table('articles')
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->join('sub_categories', 'articles.sub_category_id', '=', 'sub_categories.id')
            ->whereBetween('created_at',[ $this->from_date,$this->to_date])
            ->select('categories.name','articles.title','articles.viewer','articles.created_at')
            ->get();
        return $data;
    }

}
