<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $table = "product_types";

    protected $fillable =[
        'product_type_name',
        'discription',
    ];
    public function product()
    {
        return $this->hasMany('App\Product','product_type_id','id');
    }
}
