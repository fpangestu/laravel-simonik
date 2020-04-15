<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TimPenelitii extends Model
{
    protected $table = "tim_penelitiis";

    public function pegawai(){
    	return $this->belongsToMany('App\Pegawai');
    }
}
