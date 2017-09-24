<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportDept extends Model
{
    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany('App\User','support_dept_users','support_dept_id','user_id')->withTimestamps();
    }
}
