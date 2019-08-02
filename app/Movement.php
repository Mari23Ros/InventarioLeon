<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $table = 'movements';

    public function movement_type(){
        return $this->belongsTo('App\MovementType', 'movement_type_id', 'id');
    }
    public function document_type(){
        return $this->belongsTo('App\DocumentType', 'document_type_id', 'id');
    }
    public function buyer(){
        return $this->belongsTo('App\User', 'buyer', 'id');
    }
    public function authorizer(){
        return $this->belongsTo('App\User', 'authorizer', 'id');
    }
    public function deliverer(){
        return $this->belongsTo('App\User', 'deliverer', 'id');
    }
    public function reciever(){
        return $this->belongsTo('App\User', 'reciever', 'id');
    }
    public function origin(){
        return $this->belongsTo('App\Warehouse', 'origin', 'id');
    }
    public function destination(){
        return $this->belongsTo('App\Warehouse', 'destination', 'id');
    }
    public function products(){
        return $this->belongsToMany('App\Product', 'movement_product', 'movement_id', 'product_id')->withPivot('quantity', 'confirmed')->withTimestamps();
    }
}
