<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageDetail extends Model
{
    public $primaryKey  = 'id_package_detail';
    protected $guarded = [];

    public function package()
    {
        return $this->hasOne('App\Package','id_package','package_id');
        // return $this->belongsToMany('App\Package','App\PackageDetail','package_id','package_id')->withPivot('harga');
    }
}
