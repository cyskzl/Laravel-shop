<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceivingAddress extends Model
{
    protected $table = 'receiving_address';
    protected $fillable = ['user_id','consignee','mobile','email','province','city','district','twon','detailed_address','zipcode','is_default'];
}
