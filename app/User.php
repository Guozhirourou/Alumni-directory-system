<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'account', 'password',
    ];

//    protected $hidden = [
//        'password', 'remember_token',
//    ];

    //我的文章
    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at','desc');
    }

    //我的群
    public function groups()
    {
        return $this->hasMany('App\Group');
    }
    //申请加群
    public function applygroups()
    {
        return $this->hasMany('App\ApplyGroup');
    }
    //我的列表
    public function friends()
    {
        return $this->hasMany('App\Friend');
    }
    //我的留言
    public function messages()
    {
        return $this->hasMany('App\Message','friend_id','id');
    }
}
