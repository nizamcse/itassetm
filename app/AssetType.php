<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AssetType extends Model
{
    protected $fillable = ['name','parent_id'];

    public function childs(){
        return $this->hasMany('App\AssetType','parent_id','id');
    }

    public function parent(){
        return $this->belongsTo('App\AssetType','parent_id','id');
    }

    public function childrenRecursive()
    {
        return $this->childs()->with('childrenRecursive');
    }

    public function yearlyBudget(){
        return $this->hasOne('App\YearlyBudgetInfo', 'unit', 'id');
    }
}
