<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $primaryKey  = 'id_package';
    protected $guarded = [];
}
