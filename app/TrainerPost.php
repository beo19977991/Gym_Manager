<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrainerPost extends Model
{
    protected $table = "trainer_posts";

    protected $fillable =[
        'trainer_id',
        'title',
        'preview',
        'body',
        'photo',
    ];

    public function trainer()
    {
        return $this->belongsTo('App\Trainer','trainer_id','id');
    }
}
