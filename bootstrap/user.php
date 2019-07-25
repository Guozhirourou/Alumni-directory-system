<?php
/**
 * Created by PhpStorm.
 * User: lzc
 * Date: 17-10-26
 * Time: 下午8:44
 */
//是否为群主
function isGroupOwner($group_id)
{
    $group = \App\Group::find($group_id);
    if($group==null){
        return false;
    }
    if($group->user_id==\Auth::id()){
        return true;
    }else{
        return false;
    }
}
//是否为群管理员
function isGroupAdministrator($group_id)
{
    $flag = \App\GroupUser::where('group_id',$group_id)
        ->where('admin',1)
        ->where('user_id',Auth::id())
        ->first();
    if($flag==null){
        return false;
    }else{
        return true;
    }
}
function isGroupAdministratorById($group_id,$user_id)
{
    $flag = \App\GroupUser::where('group_id',$group_id)
        ->where('admin',1)
        ->where('user_id',$user_id)
        ->first();
    if($flag==null){
        return false;
    }else{
        return true;
    }
}
//是否为群成员
function isInGroup($group_id)
{
    $flag = \App\GroupUser::where('group_id',$group_id)
        ->where('user_id',Auth::id())
        ->first();
    if($flag==null){
        return false;
    }else{
        return true;
    }
}

//我在群里的groupuser
function groupUser($group_id)
{
    $groupuser = \App\GroupUser::where('group_id',$group_id)->where('user_id',\Auth::id())->first();
    return $groupuser;
}
//判断是否是我的好友
function isMyFriend($user_id)
{
    if($user_id==\Auth::id()){
        return true;
    }
    $friend_list_id = \App\Friend::where('user_id',\Auth::id())->pluck('id');
    $search = \App\FriendUser::whereIn('friend_id',$friend_list_id->toArray())->where('user_id',$user_id)->first();
    if($search!=null){
        return true;
    }else{
        return false;
    }
}
//获取FriendUser
function getFriendUserById($user_id)
{
    $friend_list_id = \App\Friend::where('user_id',\Auth::id())->pluck('id');
    $friend_user = \App\FriendUser::whereIn('friend_id',$friend_list_id->toArray())->where('user_id',$user_id)->first();
    return $friend_user;
}
//判断该留言是否可以回复
function isCommentByMessageId($message_id)
{
    $message = \App\Message::where('id',$message_id)
        ->where('user_id',\Auth::id())
        ->orWhere('friend_id',\Auth::id())->first();
    if($message!=null){
        return true;
    }else{
        return false;
    }
}
