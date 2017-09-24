<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportAns extends Model
{
    protected $fillable = [
        'ans',
        'user_id',
        'question_id'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
}
