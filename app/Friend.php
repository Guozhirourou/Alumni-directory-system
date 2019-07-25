<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    //一个列表对应多个好友
    public function users()
    {
        return $this->hasMany('App\FriendUser');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
