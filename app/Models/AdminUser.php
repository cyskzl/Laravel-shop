<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Zizaco\Entrust\HasRole;
//use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class AdminUser extends Model
{

    // use HasRole;
//    use Notifiable;
    use EntrustUserTrait;

    protected $table = 'admin_users';

    protected $fillable = [
    	'nickname', 'password', 'email', 'status','role_id'
    ];


    public function roleUser()
    {
        return $this->belongsToMany('App\Role', 'role_user',  'user_id', 'role_id');
    }

    public function post()
    {
        return $this->belongsTo('App\Role','role_id','id');
    }

}
