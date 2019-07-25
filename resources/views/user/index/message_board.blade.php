@extends('layout')

@section('title')
    <div class="callout callout-info" style="z-index: 2;position: relative;">
        <h4 style="text-align: center">{{$user->name}}的留言板</h4>
    </div>
@endsection



@section('content')


<!--ADD-->
<link rel="stylesheet" href="{{asset('css/message_board_css/style.css')}}" />

<div id="wrap_123" style="z-index: 2;position: relative;">
	<div id='form_wrap_123' class="row " >
         <div class="col-md-10 col-md-offset-1" style="background-color: #ffffff;padding-left:0px;" >
  <!--       <div class="col-md-10 col-md-offset-1" style="background-color: #ffffff;padding: 50px 0px;margin-top: 100px;" >
     <!--ADDD-->        
 @foreach($messages as $message)
    <div>
        <div class="row" style="background-color: #ffffff;padding: 10px 0px;" >
            <div class="col-md-10 col-md-offset-1" style="margin-left:10px;">
                <a href="{{url('user/index/profile/'.$message->user->id)}}">
                    <img src="{{asset($message->user->avatar)}}" style="float: left" width="50px" height="50px" class="img-circle" alt="用户头像">
                </a>
                <div>
                    <p style="margin: 0px;line-height: 35px;font-size: 20px;">
                        @if($message->user->id!=\Auth::id()&&isMyFriend($message->user->id))
                            {{getFriendUserById($message->user->id)->name==''?$message->user->name:getFriendUserById($message->user->id)->name}}
                        @else
                            {{$message->user->name}}
                        @endif
                    </p>
                    <p style="margin: 0px;line-height: 15px;">
                        {{$message->created_at}}
                    </p>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #ffffff;padding: 0px 60px;font-size: 20px;">
            <div class="col-md-10 col-md-offset-1">
                {{$message->content}}
            </div>
        </div>
        @foreach($message->comments as $comment)
        <div class="row" style="background-color: #ffffff;padding: 10px 60px;">
            <div class="col-md-10 col-md-offset-1" style="margin-left:0px;">
                <a href="{{url('user/index/profile/'.$comment->user->id)}}">
                <img src="{{asset($comment->user->avatar)}}" style="float: left" width="35px" height="35px" class="img-circle" alt="用户头像">
                </a>
                <div>
                    <p style="margin: 0px;line-height: 20px;font-size: 20px;">
                        @if($comment->user->id!=\Auth::id()&&isMyFriend($comment->user->id))
                            {{getFriendUserById($comment->user->id)->name==''?$comment->user->name:getFriendUserById($comment->user->id)->name}}
                        @else
                            {{$comment->user->name}}
                        @endif
                        :{{$comment->content}}
                    </p>
                    <p style="margin: 0px;line-height: 15px;">
                        {{$comment->created_at}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @if(isCommentByMessageId($message->id))
            <div class="row" style="background-color: #ffffff;padding: 10px 0px;">
                <div class="col-md-10 col-md-offset-1" >
                    <div class="form-group">
                        <div class="col-md-11">
                            <textarea class="form-control message-box" rows="1"></textarea>
                        </div>
                        <div class="col-md-1">
                            <button data="{{$message->id}}" type="button" style="" class="btn btn-default reply-message">回复</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endforeach

    <div class="row" >
        <div class="col-md-12" >
            <form>
                <div class="form-group">
                    <label>给他(她)写留言</label>
                    <button data="{{$user->id}}"  type="" class="btn btn-default message-btn" style="margin-left:300px;">提交</button>
                    <textarea class="form-control message-content" rows="3"></textarea>
                </div>
                
                
            </form>
        </div> 
        <div class="col-md-12">
            @include('user.messgae')
        </div>
    </div>  
 
             
             
 <!--		<form id="123">
			<p>Hello Joe,</p>
			<label class="123" for="email">Your Message : </label>
			<textarea  name="message" value="Your Message" id="message" ></textarea>
			<p>Best,</p>	
            
			<label class="123" for="name">Name: </label>
			<input class="123" type="text" name="name" value="" id="name" />
			<label class="123" for="email">Email: </label>
			<input class="123" type="text" name="email" value="" id="email" />
			<input class="123" type="submit" name ="submit" value="Now, I send, thanks!" />
		</form>
-->


        </div>
	</div>
</div>








<!--
    @foreach($messages as $message)
    <div>
        <div class="row" style="background-color: #ffffff;padding: 10px 0px;">
            <div class="col-md-10 col-md-offset-1">
                <a href="{{url('user/index/profile/'.$message->user->id)}}">
                    <img src="{{asset($message->user->avatar)}}" style="float: left" width="50px" height="50px" class="img-circle" alt="用户头像">
                </a>
                <div>
                    <p style="margin: 0px;line-height: 35px;font-size: 20px;">
                        @if($message->user->id!=\Auth::id()&&isMyFriend($message->user->id))
                            {{getFriendUserById($message->user->id)->name==''?$message->user->name:getFriendUserById($message->user->id)->name}}
                        @else
                            {{$message->user->name}}
                        @endif
                    </p>
                    <p style="margin: 0px;line-height: 15px;">
                        {{$message->created_at}}
                    </p>
                </div>
            </div>
        </div>
        <div class="row" style="background-color: #ffffff;padding: 0px 60px;font-size: 20px;">
            <div class="col-md-10 col-md-offset-1">
                {{$message->content}}
            </div>
        </div>
        @foreach($message->comments as $comment)
        <div class="row" style="background-color: #ffffff;padding: 10px 60px;">
            <div class="col-md-10 col-md-offset-1">
                <a href="{{url('user/index/profile/'.$comment->user->id)}}">
                <img src="{{asset($comment->user->avatar)}}" style="float: left" width="35px" height="35px" class="img-circle" alt="用户头像">
                </a>
                <div>
                    <p style="margin: 0px;line-height: 20px;font-size: 20px;">
                        @if($comment->user->id!=\Auth::id()&&isMyFriend($comment->user->id))
                            {{getFriendUserById($comment->user->id)->name==''?$comment->user->name:getFriendUserById($comment->user->id)->name}}
                        @else
                            {{$comment->user->name}}
                        @endif
                        :{{$comment->content}}
                    </p>
                    <p style="margin: 0px;line-height: 15px;">
                        {{$comment->created_at}}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        @if(isCommentByMessageId($message->id))
            <div class="row" style="background-color: #ffffff;padding: 10px 0px;">
                <div class="col-md-10 col-md-offset-1">
                    <div class="form-group">
                        <div class="col-md-11">
                            <textarea class="form-control message-box" rows="1"></textarea>
                        </div>
                        <div class="col-md-1">
                            <button data="{{$message->id}}" type="button" style="" class="btn btn-default reply-message">回复</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @endforeach            
    <div class="row">
        <div class="col-md-12">
            <form>
                <div class="form-group">
                    <label>给他(她)写留言</label>
                    <textarea class="form-control message-content" rows="3"></textarea>
                </div>
                <button data="{{$user->id}}" type="button" class="btn btn-default message-btn">提交</button>
            </form>
        </div>
        <div class="col-md-12">
            @include('user.messgae')
        </div>
    </div>

-->



@endsection

@section('js')
<script>
    $('.message-btn').click(function(){
       var friend_id = $(this).attr("data");
       var content = $('.message-content').val();
       if(content==''){
           show_notice("false","留言内容不能为空");
       }
        $.ajax({
            url: 'write',
            data: {friend_id:friend_id,content:content},
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.status=="1"){
                    show_notice("true",data.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },2000)
                }else{
                    show_notice("false",data.msg);
                }
            },
            error: function (data) {

            }
        });
    });
    //回复留言
    $('.reply-message').click(function(){
        var message_id = $(this).attr("data");
        var content = $(this).parent().prev().find('textarea').val();
        if(content==''){
            show_notice("false","回复内容不能为空");
        }
        $.ajax({
            url: 'reply',
            data: {message_id:message_id,content:content},
            type: "POST",
            dataType: 'json',
            success: function(data) {
                if(data.status=="1"){
                    show_notice("true",data.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },2000)
                }else{
                    show_notice("false",data.msg);
                }
            },
            error: function (data) {

            }
        });
    });
</script>
@endsection