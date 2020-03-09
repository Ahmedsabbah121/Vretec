<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = ['category_id','subcategory_name','subcategory_image'];

    public function categories()
    {
    	return $this->belongsTo('\App\Category', 'category_id');
    }
    public function products()
    {
    	return $this->hasMany('\App\Category', 'sub_cat_id');
    }
}
