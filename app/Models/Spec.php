<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spec extends Model
{
    protected  $table = 'spec';
    public $timestamps = false;

    public function type()

    {

        return $this->hasOne('App\Models\GoodsType', 'type_id', 'id');

    }
}
