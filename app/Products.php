<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $fillable = ['name','price','image','available_quantity','status','sub_cat_id','owner_id'];
    public function users()
    {
    	return $this->belongsTo('\App\User', 'id');
    }
    public function subcategory()
    {
    	return $this->belongsTo('\App\SubCategory', 'sub_cat_id');
    }
}
