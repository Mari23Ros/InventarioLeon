<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calibration extends Model
{
    public function product(){
        return $this->hasOne('App\Product');
    }
}
