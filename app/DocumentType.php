<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'document_types';

    public function movements(){
        return $this->hasMany('App\Comment','document_type_id', 'id');
    }
}
