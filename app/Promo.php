<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public $primaryKey  = 'id_promo';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
