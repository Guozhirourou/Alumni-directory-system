<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageComment extends Model
{
    //
    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
