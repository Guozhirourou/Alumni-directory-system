<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyFriend extends Model
{
    //
    //每一条申请信息对应一个申请人
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //
    public function friend()
    {
        return $this->belongsTo('App\User','friend_id','id');
    }

}
