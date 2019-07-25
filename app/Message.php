<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function friend()
    {
        return $this->belongsTo('App\User','friend_id','id');
    }
    //留言回复
    public function comments()
    {
        return $this->hasMany('App\MessageComment');
    }
}
