<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgendaKegiatan extends Model
{
    use SoftDeletes;

    protected $table = "agenda_kegiatans";
   	protected $dates = ['deleted_at'];
}
