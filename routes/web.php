<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return str_replace("world","Shanghai","Hello world!");
    return view('welcome');
});


Route::get('test',function (){
//    $id = \App\Group::where('user_id',\Illuminate\Support\Facades\Auth::id())->pluck('id');
//    $apply = \App\ApplyGroup::whereIn('group_id',$id->toArray())->get();
//    dd($apply);

    $id = \App\GroupUser::where('user_id',\Auth::id())->pluck('group_id');
    dd(groupUser(3)->id);
});

Route::get('login', [ 'as' => 'login', function(){
    if(str_contains(url()->previous(), 'admin')){
        return redirect('admin/login');
    }else{
        return redirect('user/login');
    }
}]);

//登录界面
Route::get('user/login',function(){
    return view('user.login');
});
Route::post('user/login','UserController@login');
Route::get('user/logout','UserController@logout');
//注册界面
Route::get('user/register',[ 'as' => 'register',function(){
    return view('user.register');
}]);
Route::post('user/auth_register','UserController@auth_register');

//登录成功后
Route::group(['prefix'=>'user/index/','middleware'=>'auth:web'],function(){
    //校友
    Route::get('friend','FriendController@friend');
    //添加分组
    Route::post('friend/add_list','FriendController@add_list');
    //查询好友
    Route::any('friend/search_friend','FriendController@search_friend');
    //申请加好友
    Route::post('friend/apply','FriendController@apply_friend');
    Route::post('friend/apply/ok','FriendController@apply_friend_ok');
    Route::post('friend/apply/no','FriendController@apply_friend_no');
    //删除好友
    Route::post('friend/delete','FriendController@delete_friend');

    //修改好友备注
    Route::post('friend/edit_friend_card','FriendController@edit_friend_card');
    //留言板
    Route::get('message_board/{user}','MessageBoard@message_board');
    //写留言
    Route::post('message_board/write','MessageBoard@write_message');
    //回复好友留言
    Route::post('message_board/reply','MessageBoard@reply_message');

    //群
    Route::get('group','UserController@group');
    Route::get('group/detail/{group}','UserController@groupdetail');//群
    Route::post('group/detail/groupcard','UserController@groupcard');//修改群名片
    Route::post('group/detail/editgroupname','UserController@editgroupname');//修改群名称
    Route::post('group/detail/editgroupimg','UserController@editgroupimg');//修改群名称
    Route::post('group/detail/arrangeok','UserController@arrangeok');//设置管理员
    Route::post('group/detail/arrangeno','UserController@arrangeno');//取消管理员
    Route::post('group/detail/announcement','UserController@announcement');//创建管公告
    Route::post('addgroup','UserController@addgroup');//创建班群
    Route::post('lookgroup','UserController@lookgroup');//查找班群
    Route::get('group/search','UserController@group_search');//查找班群
    Route::post('applygroup','UserController@applygroup');//申请加入班群
    Route::post('applygroup/ok','UserController@groupok');//同意加群
    Route::post('applygroup/no','UserController@groupno');//拒绝加群
    Route::post('group/detail/delgroupuser','UserController@delgroupuser');//管理员删除群成员


    //校友动态
    Route::get('school','UserController@school');

    //我的动态
    Route::get('post/{user}','UserController@post');
    Route::post('post/comment','UserController@comment');//评论文章
    Route::get('post/zan/{post}','UserController@zan');//赞文章
    Route::get('post/unzan/{post}','UserController@unzan');//取消赞文章

    Route::get('addpost','UserController@addpost');
    Route::post('storepost','UserController@storepost');
    Route::post('addpost/uploadimage','UserController@uploadimage');

    Route::get('profile/{user}','UserController@profile');//个人信息

    Route::post('editusername','UserController@editusername');
    Route::post('edituseravatar','UserController@edituseravatar');
    Route::get('message','UserController@message');//消息



});