<?php

namespace App\Http\Controllers;

use App\ApplyFriend;
use App\Friend;
use App\FriendUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    //校友
    public function friend()
    {
        $friends = Friend::where('user_id',Auth::id())
            ->withCount(['users'])
            ->orderBy('created_at','desc')
            ->get();
        return view('user.index.friend',compact(['friends']));
    }
    //添加分组
    public function add_list(Request $request)
    {
        $name = $request->input('name');
        $friend = new Friend();
        $friend->name = $name;
        $friend->user_id = Auth::id();
        if($friend->save()){
            return ['status'=>'1','msg'=>'添加成功'];
        }else{
            return ['status'=>'0','msg'=>'添加失败'];
        }
    }
    //查询好友
    public function search_friend(Request $request)
    {
        $users = [];
        if($request->isMethod('POST'))
        {
            $search = $request->input('search');
            $users = User::where('account',$search)->orWhere('name','like','%'.$search.'%')->get();
        }
        return view('user.index.friend_search',compact(['users']));
    }
    //申请加好友
    public function apply_friend(Request $request)
    {
        $friend_id = $request->input('friend_id');
        $message = $request->input('message');
        $list = $request->input('list_id');

        $apply_friend = new ApplyFriend();
        $apply_friend->friend_id = $friend_id;
        $apply_friend->user_id = Auth::id();
        $apply_friend->message = $message;
        $apply_friend->list_id = $list;
        if($apply_friend->save()){
            return ['status'=>'1','msg'=>'申请成功'];
        }else{
            return ['status'=>'0','msg'=>'申请失败'];
        }
    }
    //同意好友的申请
    public function apply_friend_ok(Request $request)
    {
        $id = $request->input('apply_friend_id');
        $apply_friend = ApplyFriend::find($id);
        $list_id = $request->input('list_id');

        $apply_friend->status = 1;

        $friend_user = new FriendUser();
        $friend_user->friend_id = $list_id;
        $friend_user->user_id = $apply_friend->user_id;

        $friend_user2 = new FriendUser();
        $friend_user2->friend_id = $apply_friend->list_id;
        $friend_user2->user_id = Auth::id();


        if($friend_user->save()&&$friend_user2->save()){
            $apply_friend->save();
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败'];
        }
    }
    //拒绝好友的申请
    public function apply_friend_no(Request $request)
    {
        $id = $request->input('apply_friend_id');
        $apply_friend = ApplyFriend::find($id);
        $apply_friend->status = 2;
        if($apply_friend->save()){
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败'];
        }
    }
    //修改好友备注
    public function edit_friend_card(Request $request)
    {
        $id = $request->input('friend_user_id');
        $name = $request->input('name');

        $friend_user = FriendUser::find($id);

        if($name==''){
            return ['status'=>'0','msg'=>'备注不能为空'];
        }

        if(isMyFriend($friend_user->user_id)){
            $friend_user->name = $name;
            if($friend_user->save()){
                return ['status'=>'1','msg'=>'修改成功'];
            }else{
                return ['status'=>'0','msg'=>'修改失败'];
            }
        }else{
            return ['status'=>'0','msg'=>'您没有该好友'];
        }
    }
    //删除好友
    public function delete_friend(Request $request)
    {
        $id = $request->input('id');
        $friend_user = FriendUser::find($id);

        $friend_user_id = $friend_user->user_id;

        $friend = User::find($friend_user_id);
        $friend_list_id = Friend::where('user_id',$friend->id)->pluck('id');
        $friend_user2 = FriendUser::whereIn('friend_id',$friend_list_id->toArray())->where('user_id',Auth::id())->first();

        $friend_user->delete();
        $friend_user2->delete();

        return ['status'=>'1','msg'=>'删除成功'];
    }
}
