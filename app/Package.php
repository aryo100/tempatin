<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    public $primaryKey  = 'id_package';
    protected $guarded = [];
    
    public function package_detail()
    {
        return $this->hasMany('App\PackageDetail','package_id');
        // return $this->belongsToMany('App\Package','App\PackageDetail','package_id','package_id')->withPivot('harga');
    }
}
