<?php

namespace App;
use App\SubCategory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name','category_image'];
    public function Products()
    {
        // return $this->hasMany(Products::class);
        return $this->hasManyThrough('App\Products', 'App\SubCategory' , 'category_id' , 'sub_cat_id');

    }

    // public function Products()
    // {
    //     return $this->hasManyThrough(
    //         'App\Products',
    //         'App\SubCategory',
    //         'category_id', // Foreign key on users table...
    //         'sub_cat_id', // Foreign key on posts table...
    //         'id', // Local key on countries table...
    //         'id' // Local key on users table...
    //     );
    // }
    public function subcategory(){
        return $this->hasMany(SubCategory::class);
    }
}
