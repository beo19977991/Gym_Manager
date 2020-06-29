<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";

    protected $fillable =[
        'product_type_id',
        'product_name',
        'discription',
        'price',
        'quantity',
        'photo',
    ];
    public function product_type()
    {
        return $this->belongsTo('App\ProductType','product_type_id','id');
    }
}
