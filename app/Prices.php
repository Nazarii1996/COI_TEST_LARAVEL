<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $fillable=['product_id','currency','price'];
    public function product(){
        $this->belongsTo('App\Product');
    }
}
