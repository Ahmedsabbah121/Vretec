<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['product_id','quantity','days_num','start_date','end_date','address','lat','lng','user_id'];
}
