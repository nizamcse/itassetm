<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name','parent_id'];

    public function childs(){
        return $this->hasMany('App\Location','id','parent_id');
    }

    public function parent(){
        return $this->belongsTo('App\Location','parent_id','id');
    }
}
