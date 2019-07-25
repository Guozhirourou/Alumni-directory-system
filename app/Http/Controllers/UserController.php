<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\ApplyFriend;
use App\ApplyGroup;
use App\Comment;
use App\Group;
use App\GroupApply;
use App\GroupUser;
use App\Post;
use App\User;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function auth_register(Request $request)
    {
        $account = $request->input('account');
        $password1 = $request->input('password1');

        if($account==''){
            return ['status'=>'0','msg'=>'账号不能为空'];
        }

        if($password1==''){
            return ['status'=>'0','msg'=>'密码不能为空'];
        }

        $user = User::where('account',$account)->first();
        if($user!=null){
            return ['status'=>'0','msg'=>'账号已存在'];
        }

        $user = new User();
        $user->account = $account;
        $user->name = $account;
        $user->password = bcrypt($password1);
        if($user->save()){
            return ['status'=>'1','msg'=>'注册成功'];
        }else{
            return ['status'=>'0','msg'=>'注册失败'];
        }

    }

    //登录
    public function login(Request $request)
    {
        $this->validate($request,[
//            'code' => 'bail|required|captcha',
            'account'=>'required',
            'password'=>'required',
        ],[
            'captcha'=>':attribute错误'
        ]);

        $account = $request->input('account');
        $password = $request->input('password');
        $is_remember = boolval(request('is_remember'));
        if(Auth::attempt(['account'=>$account,'password'=>$password],$is_remember))
        {
            return redirect('user/index/friend');
        }
        return redirect()->back()->withErrors('账号或密码错误');

    }

    //退出
    public function logout()
    {
        Auth::logout();
        return redirect('user/login');
    }

    //个人信息
    public function profile(User $user)
    {
        $user = User::withCount(['posts'])->find($user->id);
        return view('user.index.profile',compact(['user']));
    }

    //修改姓名
    public function editusername(Request $request)
    {

        $name = $request->input('name');
        if($name==''){
            return ['status'=>'0','msg'=>'姓名不能为空'];
        }else{
            $user = User::find(Auth::id());
            $user->name = $name;
            if($user->save()){
                return ['status'=>'1','msg'=>'修改成功'];
            }else{
                return ['status'=>'0','msg'=>'修改失败'];
            }
        }
    }

    //修改头像
    public function edituseravatar(Request $request)
    {
        $img_base64 = $request->input('img');
        $explode    = explode(',', $img_base64);
        if (!isset($explode[1]) || strlen($explode[1]) < 50) {
            return [
                'status'=>0,
                'msg'=>'失败'
            ];
        }
        $img_data = base64_decode($explode[1]);
        $img_name = 'myavatar/'.md5(time()).'.png';
        $filename = Storage::disk('public')->put($img_name,$img_data);//上传

        if($filename){
            $user = User::find(Auth::id());
            if($user->avatar=='myavatar/avatar.png'){
                $user->avatar = 'storage/'.$img_name;
                if($user->save()){
                    return ['status'=>1,'msg'=>'修改成功'];
                }else{
                    return ['status'=>0,'msg'=>'修改失败'];
                }
            }else{
                Storage::disk('public')->delete(str_replace("storage/","",$user->avatar));
                $user->avatar = 'storage/'.$img_name;
                if($user->save()){
                    return ['status'=>1,'msg'=>'修改成功'];
                }else{
                    return ['status'=>0,'msg'=>'修改失败'];
                }
            }
        }else{
            return [
                'status'=>0,
                'msg'=>'失败'
            ];
        }
    }

    //消息
    public function message()
    {

        //我创建的群申请消息以及我管理的群申请消息
//        $mygroup = Group::where('user_id',Auth::id())->pluck('id');

        //我管理的以及创建群id
        $mygroup = GroupUser::where('user_id',\Auth::id())->where('admin',1)->pluck('group_id');

        $groups = ApplyGroup::whereIn('group_id',$mygroup->toArray())
            ->orderBy('created_at','desc')
            ->get();
        //未审核消息数量
        $groups_num = DB::table('apply_groups')
            ->whereIn('group_id',$mygroup->toArray())
            ->where('status',0)
            ->count();
        $myapplys = ApplyGroup::where('user_id',Auth::id())->orderBy('created_at','desc')->get();

        //好友申请信息
        $apply_friends = ApplyFriend::where('friend_id',Auth::id())->get();
        $applys_num = ApplyFriend::where('friend_id',Auth::id())->where('status',0)->count();
        $my_apply_friends = ApplyFriend::where('user_id',Auth::id())->get();
        //我的好友列表
        return view('user.index.message',compact(['groups','groups_num','myapplys','apply_friends','applys_num','my_apply_friends']));
    }

    //群信息
    public function groupdetail(Group $group)
    {
        if(isInGroup($group->id)){
            //预加载
            $group->load('groupusers');
            $group->load('announcements');
            return view('user.index.groupdetail',compact(['group']));
        }else{
            return redirect()->back();
        }
    }

    //申请加入班群
    public function applygroup(Request $request)
    {
        $apply_id = Auth::id();
        $apply_message = $request->input('message');
        $group_id = $request->input('group_id');

        if($apply_id==''||$apply_message==''||$group_id==''){
            return ['status'=>'0','msg'=>'申请信息不能为空'];
        }

        $msg = ApplyGroup::where('group_id',$group_id)->where('user_id',$apply_id)->where('status','0')->first();
        if($msg!=null){
            return ['status'=>'0','msg'=>'您已经申请过，正在审核'];
        }

        $flag = GroupUser::where('group_id',$group_id)->where('user_id',$apply_id)->first();

        if($flag!=null){
            return ['status'=>'0','msg'=>'您已经在该群'];
        }

        $apply = new ApplyGroup();
        $apply->group_id = $group_id;
        $apply->user_id = $apply_id;
        $apply->message = $apply_message;

        if($apply->save()){
            return ['status'=>'1','msg'=>'申请已提交'];
        }else{
            return ['status'=>'0','msg'=>'操作失败'];
        }

    }
    //同意加群
    public function groupok(Request $request)
    {
        $message = ApplyGroup::find($request->input('applygroup_id'));
        if($message==null){
            return ['status'=>'0','msg'=>'操作失败'];
        }

        //判断是否为管理员
        $flag = GroupUser::where('group_id',$message->group_id)
            ->where('admin',1)
            ->where('user_id',Auth::id())
            ->first();
        if($flag==null){
            return ['status'=>'0','msg'=>'没有权限'];
        }

        $message->status = 1;
        $message->check_id = Auth::id();

        $groupuser = new GroupUser();
        $groupuser->group_id = $message->group_id;
        $groupuser->user_id = $message->user_id;
        //$groupuser->name = $message->user->name;

        if($message->save()&&$groupuser->save()){
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败,请重试'];
        }
    }
    //拒绝加群
    public function groupno(Request $request)
    {
        $message = ApplyGroup::find($request->input('applygroup_id'));
        if($message==null){
            return ['status'=>'0','msg'=>'操作失败'];
        }

        //判断是否为管理员
        $flag = GroupUser::where('group_id',$message->group_id)
            ->where('admin',1)
            ->where('user_id',Auth::id())
            ->first();
        if($flag==null){
            return ['status'=>'0','msg'=>'没有权限'];
        }

        $message->status = 2;
        $message->check_id = Auth::id();
        if($message->save()){
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败,请重试'];
        }
    }
    //班群
    public function group()
    {
        $groups = Group::where('user_id',Auth::id())->withCount(['groupusers'])->get();

        //我管理的群id
        $id = GroupUser::where('user_id',\Auth::id())->where('admin',1)->pluck('group_id');
        $arranges =  Group::whereIn('id',$id->toArray())->where('user_id','<>',Auth::id())->withCount(['groupusers'])->get();

        //我加入的群id
        $id = GroupUser::where('user_id',\Auth::id())->where('admin',0)->pluck('group_id');
        $joins = Group::whereIn('id',$id->toArray())->withCount(['groupusers'])->get();

        return view('user.index.group',compact(['groups','arranges','joins']));
    }

    //查找班群
    public function lookgroup(Request $request)
    {
        $group = Group::find($request->input('groupId'));
        if($group==null){
            return ['status'=>'0','msg'=>'不存在该群'];
        }else{
            return ['status'=>'1','msg'=>$group];
        }
    }
    public function group_search(Request $request)
    {
        $groupIdName = $request->input('groupIdName');

        $groups = Group::where('id',$groupIdName)->orwhere('name','like','%'.$groupIdName.'%')->get();

        return view('user.index.group_search',compact(['groups']));
    }

    //创建班群
    public function addgroup(Request $request)
    {
        $name = $request->input('groupName');
        if($name=='')
        {
            return ['status'=>'0','msg'=>'班级名称不能为空'];
        }

        $group = Group::where('user_id',Auth::id())->where('name',$name)->first();
        if($group!=null){
            return ['status'=>'0','msg'=>'该名称已存在'];
        }

        $groupuser = new GroupUser();

        $id = DB::table('groups')->insertGetId(
            ['name' => $name, 'user_id' => Auth::id(),'created_at'=>date('Y-m-d H-i-s')]
        );
        if($id>0) {
            $groupuser->group_id = $id;
            $groupuser->user_id = Auth::id();
            //$groupuser->name = Auth::user()->name;
            $groupuser->admin = 1;
            if($groupuser->save()){
                return ['status'=>'1','msg'=>'创建成功'];
            }else{
                return ['status'=>'0','msg'=>'创建失败'];
            }
        }else{
            return ['status'=>'0','msg'=>'创建失败'];
        }

    }
    //修改群名片
    public function groupcard(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');

        if($name==''){
            return ['status'=>'0','msg'=>'不能为空'];
        }

        $groupuser = GroupUser::find($id);
        if($groupuser==null){
            return ['status'=>'0','msg'=>'该记录不存在'];
        }

        //判断是不是本人
        if($groupuser->user_id!=Auth::id()){
            return ['status'=>'0','msg'=>'没有权限'];
        }

        $groupuser->name = $name;

        if($groupuser->save()){
            return ['status'=>'1','msg'=>'修改成功'];
        }else{
            return ['status'=>'0','msg'=>'修改失败，请重试'];
        }
    }

    //管理员修改群名
    public function editgroupname(Request $request)
    {
        $name = $request->input('name');
        $group_id = $request->input('group_id');

        if(isGroupAdministrator($group_id)){
            $group = Group::find($group_id);
            if($group!=null){
                $group->name = $name;
                if($group->save()){
                    return ['status'=>'1','msg'=>'修改成功'];
                }else{
                    return ['status'=>'0','msg'=>'失败'];
                }
            }else{
                return ['status'=>'0','msg'=>'该群不存在'];
            }
        }else{
            return ['status'=>'0','msg'=>'没有权限'];
        }
    }

    //设置管理员
    public function arrangeok(Request $request)
    {
        $groupuser = GroupUser::find($request->input('id'));
        if($groupuser==null){
            return ['status'=>'0','msg'=>'该记录不存在'];
        }
        //判断是否为群主
        if($groupuser->group->user_id!=Auth::id()){
            return ['status'=>'0','msg'=>'你没有权限'];
        }
        $groupuser->admin = 1;
        if($groupuser->save()){
            return ['status'=>'1','msg'=>'设置成功'];
        }else{
            return ['status'=>'0','msg'=>'设置失败'];
        }
    }
    //取消管理员
    public function arrangeno(Request $request)
    {
        $groupuser = GroupUser::find($request->input('id'));
        if($groupuser==null){
            return ['status'=>'0','msg'=>'该记录不存在'];
        }
        //判断是否为群主
        if($groupuser->group->user_id!=Auth::id()){
            return ['status'=>'0','msg'=>'你没有权限'];
        }

        $groupuser->admin = 0;
        if($groupuser->save()){
            return ['status'=>'1','msg'=>'设置成功'];
        }else{
            return ['status'=>'0','msg'=>'设置失败'];
        }
    }
    //创建公告
    public function announcement(Request $request)
    {
        $group_id = $request->input('group_id');
        if(isGroupAdministrator($group_id)){
            $title = $request->input('title');
            $message = $request->input('message');

            if($title==""||$message==""){
                return ['status'=>'0','msg'=>'信息不能为空'];
            }

            $announcement = new Announcement();
            $announcement->title = $title;
            $announcement->message = $message;
            $announcement->group_id = $group_id;
            $announcement->group_user_id = Auth::id();
            if($announcement->save()){
                return ['status'=>'1','msg'=>'成功'];
            }else{
                return ['status'=>'0','msg'=>'失败'];
            }
        }else{
            return ['status'=>'0','msg'=>'没有权限'];
        }
    }

    //管理员删除群成员
    public function delgroupuser(Request $request)
    {
        $user_id = $request->input('user_id');
        $group_id = $request->input('group_id');
        //先判断被删除用户是普通用户还是管理员，若为管理员只有群主能移除
        if(isGroupAdministratorById($group_id,$user_id)){
            //如果是管理员，在判断当前用户是否为群主
            if(isGroupOwner($group_id)){
                $groupuser = GroupUser::find($user_id);
                if($groupuser!=null){
                    if($groupuser->delete()){
                        return ['status'=>'1','msg'=>'操作成功'];
                    }else{
                        return ['status'=>'0','msg'=>'操作失败'];
                    }
                }else{
                    return ['status'=>'0','msg'=>'该用户不在该群'];
                }
            }else{
                return ['status'=>'0','msg'=>'只有群主才能移除管理员'];
            }
        }else{
            //被删除用户是普通用户，判断当前用户是否是管理员
            if(isGroupAdministrator($group_id)){
                $groupuser = GroupUser::find($user_id);
                if($groupuser!=null){
                    if($groupuser->delete()){
                        return ['status'=>'1','msg'=>'操作成功'];
                    }else{
                        return ['status'=>'0','msg'=>'操作失败'];
                    }
                }else{
                    return ['status'=>'0','msg'=>'该用户不在该群'];
                }
            }else{
                return ['status'=>'0','msg'=>'没有该权限'];
            }
        }
    }

    //校友动态
    public function school()
    {
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(6);
        return view('user.index.school',compact(['posts']));
    }


    //我的动态
    public function post(User $user)
    {
        $posts = Post::where('user_id',$user->id)
            ->orderBy('created_at','desc')
            ->withCount(['comments'])
            ->paginate(6);
        return view('user.index.post',compact(['posts','user']));
    }
    //新增动态
    public function addpost()
    {
        return view('user.index.addpost');
    }
    //
    public function storepost(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|string'
        ]);
        $content = $request->input('content');
        $post = new Post();
        $post->content = $content;
        $post->user_id = Auth::id();
        if($post->save()){
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败'];
        }
    }
    //赞文章
    public function zan(Post $post)
    {
        $zan = new Zan();
        $zan->user_id = Auth::id();
        $post->zans()->save($zan);
        return back();
    }
    //取消赞
    public function unzan(Post $post)
    {
        $post->zan(Auth::id())->delete();
        return back();
    }


    //上传图片
    public function uploadimage(Request $request)
    {
        $path = $request->file('wangEditorH5File')->store('postsImage');
        return asset('storage/'.$path);
    }

    //提交评论
    public  function comment(Request $request)
    {
        $this->validate($request,[
            'content'=>'required|min:2'
        ]);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->post_id = $request->input('post_id');
        $comment->content = $request->input('content');

        $bool = $comment->save();

        if($bool){
            return ['status'=>'1','msg'=>'操作成功'];
        }else{
            return ['status'=>'0','msg'=>'操作失败，请重试'];
        }
    }
}
