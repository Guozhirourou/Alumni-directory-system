<?php

namespace App\Http\Controllers;

use App\Message;
use App\MessageComment;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageBoard extends Controller
{
    //
    public function message_board(User $user)
    {
        $messages = Message::where('friend_id',$user->id)->get();
        return view('user.index.message_board',compact(['user','messages']));
    }
    //写留言
    public function write_message(Request $request)
    {
        $friend_id = $request->input('friend_id');
        $content = $request->input('content');
        $user_id = Auth::id();

        $message = new Message();
        $message->user_id = $user_id;
        $message->friend_id = $friend_id;
        $message->content = $content;
        if($message->save()){
            return ['status'=>'1','msg'=>'留言成功'];
        }else{
            return ['status'=>'0','msg'=>'留言失败'];
        }
    }
    //回复好友留言
    public function reply_message(Request $request)
    {
        $message_id = $request->input('message_id');
        $user_id = Auth::id();
        $content = $request->input('content');

        $message_comment = new MessageComment();
        $message_comment->message_id = $message_id;
        $message_comment->user_id = $user_id;
        $message_comment->content = $content;

        if($message_comment->save()){
            return ['status'=>'1','msg'=>'回复成功'];
        }else{
            return ['status'=>'0','msg'=>'回复失败'];
        }
    }
}
