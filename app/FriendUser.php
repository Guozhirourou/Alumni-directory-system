<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendUser extends Model
{
    //一个成员只属于一个用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function friend()
    {
        return $this->belongsTo('App\Friend');
    }
}
