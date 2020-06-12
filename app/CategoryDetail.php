<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryDetail extends Model
{
    public $primaryKey  = 'id_category_detail';
    protected $guarded = [];


    public function room()
    {
        return $this->belongsTo('App\Room','room_id');
    }

    public function category()
    {
        return $this->belongsTo('App\RoomCategory','room_category_id');
    }
}
