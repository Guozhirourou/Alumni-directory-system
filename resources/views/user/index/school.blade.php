@extends('layout')

@section('css')
@endsection

@section('title')

@endsection

@section('content')
@foreach($posts as $post)
<div class="row" style="z-index: 2;position: relative;" >
    <div class="col-md-offset-1 col-md-10">
        <div class="box box-widget">
            <a href="{{url('user/index/profile/'.$post->user->id)}}">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="{{asset($post->user->avatar)}}" alt="User Image">
                    <span class="username">
                        {{$post->user->name}}
                    </span>
                    <span class="description">
                        {{$post->created_at}}
                    </span>
                </div>
            </div>
            </a>
            <!-- /.box-header -->
            <div class="box-body">
                {!!$post->content!!}
                @if($post->zan(\Auth::id())->exists())
                    <a href="{{url('user/index/post/unzan/'.$post->id)}}" type="button" class="btn btn-primary">
                        赞{{$post->zans_count}}
                    </a>
                @else
                    <a href="{{url('user/index/post/zan/'.$post->id)}}" type="button" class="btn btn-default">
                        赞{{$post->zans_count}}
                    </a>
                @endif
                <button type="button" class="btn btn-primary show-comment-btn">评论{{$post->comments_count}}</button>
            </div>
            <div class="box-footer box-comments">
                @foreach($post->comments as $comment)
                <div class="box-comment">
                    <a href="{{url('user/index/profile/'.$comment->user->id)}}">
                        <img class="img-circle img-sm" src="{{asset($comment->user->avatar)}}" alt="User Image">
                    </a>
                    <div class="comment-text">
                      <span class="username">
                        {{$comment->user->name}}
                        <span class="text-muted pull-right">{{$comment->created_at}}</span>
                      </span>
                        {{$comment->content}}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="box-footer" style="display: none;">
                <div class="row">
                    <div class="col-md-11" style="padding-right: 0px;">
                        <textarea class="form-control" style="min-height: 50px;"></textarea>
                    </div>
                    <div class="col-md-1" align="center" style="padding: 0px;">
                        <button data="{{$post->id}}" type="button" class="btn btn-info comment-btn">评论</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
{{ $posts->links() }}

@endsection

@section('js')

<script>
    //点击评论
    $('.show-comment-btn').click(function(){
        $(this).parent().next().next().toggle();
    });
</script>

<script>
    $('.comment-btn').click(function(){
        var content = $(this).parent().prev().find("textarea").val();
        var post_id = $(this).attr("data");
        if(content==''){
            return false;
        }
        $.ajax({
            url:"post/comment",
            method:'post',
            dataType:'json',
            data:{post_id:post_id,content:content},
            success:function(data){
                if(data.status=="1"){
                    show_notice("true",data.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },2000);
                }else{
                    show_notice("false",data.msg);
                }
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                show_notice("false","服务器错误");
            }
        });
    });
</script>
@endsection