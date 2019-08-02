<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function movement_origins(){
        return $this->hasMany('App\Movement', 'origin', 'id');
    }
    public function movement_destinations(){
        return $this->hasMany('App\Movement', 'destination', 'id');
    }
}
