<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementType extends Model
{
    protected $table = 'movement_types';

    public function movements(){
        return $this->hasMany('App\Movement', 'movement_type_id', 'id');
    }
}

#TO poppulate our option html
#App\Tag::lists('attribute')
