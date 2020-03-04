<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function scopeLimited($query)
    {
        if(!\Auth::check())
            return $query->limit(3);
    }
    public function prices(){
        return $this->hasMany('App\Prices');
    }

}
