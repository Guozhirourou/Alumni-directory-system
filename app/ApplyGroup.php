<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApplyGroup extends Model
{
    //
    protected $guarded = [];

    //每一条申请信息对应一个申请人
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //每一条申请信息属于一个群
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
    //一条申请信息对应一个审核人
    public function check()
    {
        return $this->belongsTo('App\User','check_id','id');
    }
}
