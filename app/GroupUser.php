<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    //
    protected $guarded = [];
    //一个群成员对应一个用户,一对一
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    //一个群成员对应一个群
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}
