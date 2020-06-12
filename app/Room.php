<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public $primaryKey  = 'id_room';
    protected $guarded = [];

    public function building()
    {
        return $this->belongsTo('App\Building','building_id');
    }
    
    public function category()
    {
        return $this->belongsToMany('App\RoomCategory','App\CategoryDetail','room_id','room_category_id');
    }
    
    public function setup()
    {
        return $this->belongsToMany('App\Setup','App\SetupDetail','room_id','setup_id');
    }
    
    public function facility()
    {
        return $this->belongsToMany('App\FacilityCategory','App\FacilityDetail','room_id','facility_category_id');
    }
    
    public function promo()
    {
        return $this->belongsToMany('App\User','App\Promo','room_id','user_id');
    }
    
    public function package()
    {
        return $this->belongsToMany('App\Package','App\PackageDetail','room_id','package_id')->withPivot('harga');
    }
}
