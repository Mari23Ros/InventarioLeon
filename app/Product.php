<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function calibration(){
        return $this->belongsTo('App\Calibration');
    }

    public function category(){
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }
    public function state(){
        return $this->belongsTo('App\State');
    }
    public function size(){
        return $this->belongsTo('App\Size');
    }
    public function movements(){
        return $this->belongsToMany('App\Movement', 'movement_product', 'product_id', 'movement_id')->withPivot('quantity', 'confirmed')->withTimestamps();
    }
}
