<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'category_id','sub_category_id','title','slug','body','thumbnail','viewer','status'
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }

    public function scopeSearch($query, $title = null, $category_id = null, $sub_category_id = null){

        if ( !empty($title) ) {
            $query->where('title', 'like','%'.$title.'%');
        }

        if ( !empty($category_id) ) {
            $query->where('category_id', $category_id);
        }

        if ( !empty($singer_id) ) {
            $query->where('sub_category_id', $sub_category_id);
        }
        return $query;
    }
}
