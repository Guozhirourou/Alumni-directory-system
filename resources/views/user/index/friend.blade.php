@extends('layout')

@section('title')

@endsection

@section('content')
    <div class="row" style="margin-bottom: 10px;z-index: 2;position: relative;" >
        <div class="col-md-1">
            <a class="btn btn-social-icon btn-google add-list">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-2">
            <div class="input-group" style="width: 200px;">
                <a href="{{url('user/index/friend/search_friend')}}">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat search-friend">查找</button>
                    </span>
                </a>
            </div>
        </div>
    </div>
    @foreach($friends as $friend)
    <div class="col-md-4" style="z-index: 2;position: relative;" >
        <div class="box box-primary direct-chat direct-chat-primary direct-chat-contacts-open collapsed-box">
            <div class="box-header with-border">
                <h3 class="box-title">{{$friend->name}}</h3>

                <div class="box-tools pull-right">
                    <span data-toggle="tooltip" title="" class="badge bg-light-blue">
                        {{$friend->users_count}}
                    </span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                    <button style="display: none;" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts" aria-describedby="tooltip677350">
                        <i class="fa fa-comments"></i>
                    </button>
                </div>
            </div>
            <div class="box-body" style="display: none;">
                <div class="direct-chat-messages">

                </div>
                <div class="direct-chat-contacts" style="background-color: #ffffff;">
                    <ul class="contacts-list">
                        @foreach($friend->users as $frienduser)
                            <li style="border-bottom: 1px solid #cccccc;">
                                <a href="{{url('user/index/profile/'.$frienduser->user->id)}}">
                                    <img class="contacts-list-img" src="{{asset($frienduser->user->avatar)}}" alt="User Image">
                                    <div class="contacts-list-info">
                                    <span class="contacts-list-name" style="color: #000000;">
                                        {{$frienduser->name==''?$frienduser->user->name:$frienduser->name}}
                                    </span>
                                        <span class="contacts-list-msg">{{$frienduser->user->account}}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- 新建列表 -->
    <div class="modal fade" id="addListModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">添加分组</h4>
                </div>
                <div class="modal-body" style="margin: 10px;">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-1 control-label">添加分组</label>
                            <div class="col-sm-8">
                                <input type="text" name="listName" class="form-control" placeholder="分组名称">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-add-list">创建</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('.add-list').click(function(){
        $('#addListModal').modal('show');
    });
    $('.btn-add-list').click(function(){

        var name = $("input[name='listName']").val();
        if(name==''){
            return;
        }

        $.ajax({
            url:"friend/add_list",
            method:'post',
            dataType:'json',
            data:{name:name},
            success:function(data){
                if(data.status=="1"){
                    show_notice("true",data.msg);
                    setTimeout(function(){
                        window.location.reload();
                    },2000)
                }else{
                    show_notice("false",data.msg);
                }
            },
            error: function(data) {
                show_notice("false","服务器错误");
            }
        });
    });
</script>
@endsection