<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $guarded = [];
    //一个公告属于一个群成员用户
    public function groupuser()
    {
        return $this->belongsTo('App\GroupUser','group_user_id','id');
    }
}
