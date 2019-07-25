<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
    protected $guarded = [];

    //群主
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //群成员,一个群有多个成员，一对多
    public function groupusers()
    {
        return $this->hasMany('App\GroupUser');
    }
    //群公告
    public function announcements()
    {
        return $this->hasMany('App\Announcement')->orderBy('created_at','desc');
    }

}
