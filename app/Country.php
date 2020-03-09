<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'id', 'country_code', 'country_name'
    ];
    public function user(){
        return $this->hasMany('User');
    }
    public function city(){
        return $this->hasMany('\App\City');
    }
}
