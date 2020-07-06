<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['reports'];

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
