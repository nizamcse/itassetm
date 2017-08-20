<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = ['name','sec_sv','sec_org','created_by'];
    public function superVisor(){
        return $this->belongsTo('App\Employee','sec_sv');
    }
}
