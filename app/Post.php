<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $guarded = [];
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function zan($user_id)
    {
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }

    public function zans()
    {
        return $this->hasMany('App\Zan');
    }

    //评论模型，一个文章多个评论
    public  function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}
