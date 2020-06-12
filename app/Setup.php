<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
    public $primaryKey  = 'id_setup';
    protected $guarded = [];

    // public function setup_detail()
    // {
    //     return $this->belongsTo('App\SetupDetail','setup_id');
    // }
}
