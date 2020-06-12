<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey  = 'id_order';
    protected $guarded = [];
}
