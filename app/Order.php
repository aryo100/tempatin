<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $primaryKey  = 'id_order';
    protected $guarded = [];
    
    public function order_detail()
    {
        return $this->hasMany('App\OrderDetail','order_id');
    }
    public function form_content()
    {
        return $this->belongsToMany('App\FormDetail','App\FormContent','order_id','form_detail_id')->withPivot('value');
    }
}
