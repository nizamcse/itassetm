<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportQuestion extends Model
{
    protected $fillable = [
        'complain',
        'user_id',
        'support_dept_id',
        'status',
        'title',
        'document',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function department(){
        return $this->belongsTo('App\SupportDept','support_dept_id');
    }

    public function answare(){
        return $this->hasMany('App\SupportAns','question_id');
    }
}
