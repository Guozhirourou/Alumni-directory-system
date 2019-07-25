@extends('layout')

@section('title')
    <div style="z-index: 2;position: relative;" >
    <h1>
        <a href="javascript:history.go(-1);" class="btn btn-social-icon btn-google add-group">
            <span class="glyphicon glyphicon-arrow-left"></span>
        </a>
    </h1>
    </div>
@endsection

@section('content')
    <div class="row" style="z-index: 2;position: relative;" >
        <div class="col-md-6">
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$group->name}}</h3>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="{{sizeof($group->groupusers)}}">
                            {{sizeof($group->groupusers)}}
                        </span>
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="成员">
                            <i class="fa fa-comments"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height: 350px;">
                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">李振成</span>
                                <span class="direct-chat-timestamp pull-right">23 12月 2:00 pm</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                你的作业写的怎么样了？有什么需要帮助的吗？
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                        <!-- Message to the right -->
                        <div class="direct-chat-msg right">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">韦喆艺</span>
                                <span class="direct-chat-timestamp pull-left">23 12月 2:05 pm</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                都挺好的，我快完成了！
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->

                        <!-- Message. Default to the left -->
                        <div class="direct-chat-msg">
                            <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">郭芷柔</span>
                                <span class="direct-chat-timestamp pull-right">23 12月 5:37 pm</span>
                            </div>
                            <!-- /.direct-chat-info -->
                            <img class="direct-chat-img" src="{{asset('admin/dist/img/user1-128x128.jpg')}}" alt="message user image">
                            <!-- /.direct-chat-img -->
                            <div class="direct-chat-text">
                                我也是，马上就完成了呢！
                            </div>
                            <!-- /.direct-chat-text -->
                        </div>
                        <!-- /.direct-chat-msg -->
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts" style="height: 350px;">
                        <ul class="contacts-list">
                            @foreach($group->groupusers as $key)
                                @if($key->user_id==$group->user_id)
                                <li>
                                    <a href="{{url('user/index/profile/'.$key->user_id)}}">
                                        <img class="contacts-list-img" src="{{asset($key->user->avatar)}}" alt="User Image">
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                {{$key->name}}(群主)
                                                <small class="contacts-list-date pull-right">2/28/2015</small>
                                            </span>
                                            <span class="contacts-list-msg">
                                                {{$key->user->account}}
                                            </span>
                                        </div>
                                        <!-- /.contacts-list-info -->
                                    </a>
                                </li>
                                @endif
                            @endforeach
                            @foreach($group->groupusers as $key)
                                @if($key->user_id!=$group->user_id&&$key->admin==1)
                                    <li>
                                        <a href="{{url('user/index/profile/'.$key->user_id)}}">
                                            <img class="contacts-list-img" src="{{asset($key->user->avatar)}}" alt="User Image">
                                        </a>
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                {{$key->name==''?$key->user->name:$key->name}}(管理员)
                                                @if($group->user_id==\Auth::id())
                                                <small data="{{$key->id}}" class="contacts-list-date pull-right arrange-no" style="cursor: pointer">
                                                    取消管理员
                                                </small>
                                                @endif
                                            </span>
                                            <span class="contacts-list-msg">
                                                {{$key->user->account}}
                                                @if($group->user_id==\Auth::id())
                                                    <small group-id="{{$group->id}}" user-id="{{$key->id}}" style="cursor: pointer" class="contacts-list-date pull-right delete-user">
                                                        移除
                                                    </small>
                                                @endif
                                            </span>
                                        </div>
                                            <!-- /.contacts-list-info -->
                                    </li>
                                @endif
                            @endforeach
                            @foreach($group->groupusers as $key)
                                @if($key->user_id!=$group->user_id&&$key->admin==0)
                                    <li>
                                        <a href="{{url('user/index/profile/'.$key->user_id)}}">
                                            <img class="contacts-list-img" src="{{asset($key->user->avatar)}}" alt="User Image">
                                        </a>
                                        <div class="contacts-list-info">
                                            <span class="contacts-list-name" style="cursor: pointer">
                                                {{$key->name==''?$key->user->name:$key->name}}
                                                    @if($group->user_id==\Auth::id())
                                                    <small data="{{$key->id}}" style="cursor: pointer" class="contacts-list-date pull-right arrange-ok">
                                                        设置管理员
                                                    </small>
                                                    @endif
                                            </span>
                                            <span class="contacts-list-msg" style="cursor: pointer">
                                                {{$key->user->account}}
                                                @if(isGroupAdministrator($group->id))
                                                    <small group-id="{{$group->id}}" style="cursor: pointer" user-id="{{$key->id}}" class="contacts-list-date pull-right delete-user">
                                                        移除
                                                    </small>
                                                @endif
                                            </span>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.direct-chat-pane -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form action="#" method="post">
                        <div class="input-group">
                            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                            <span class="input-group-btn">
                            <button type="button" class="btn btn-warning btn-flat">Send</button>
                          </span>
                        </div>
                    </form>
                </div>
                <!-- /.box-footer-->
            </div>
        </div>
        <div class="col-md-6" style="height: 450px;overflow: scroll;">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{asset($group->avatar)}}" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">
                        {{$group->name}}
                        @if(isGroupAdministrator($group->id))
                        <span data="{{$group->id}}" style="cursor: pointer;" class="glyphicon glyphicon-pencil edit-name" aria-hidden="true"></span>
                        @endif
                    </h3>
                    <h5 class="widget-user-desc">群号:{{$group->id}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        @if(groupUser($group->id))
                            <li style="padding: 5px;">
                                我的群名片
                            <input type="text" name="group-name" value="{{groupUser($group->id)->name==''?groupUser($group->id)->user->name:groupUser($group->id)->name}}" />
                            <button data="{{groupUser($group->id)->id}}" type="button" class="btn btn-info btn-sm group-name-btn">
                                完成
                            </button>
                            @if(isGroupAdministrator($group->id))
                                <button data="{{$group->id}}" style="float: right" type="button" class="btn btn-info btn-sm create-announcement-btn">
                                    发公告
                                </button>
                            @endif
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            @foreach($group->announcements as $announcement)
            <div class="box box-warning box-solid collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        {{$announcement->title}}
                    </h3>
                    <div class="box-tools pull-right">
                        {{$announcement->groupuser->name}}&emsp;{{$announcement->created_at}}
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="display: none;">
                    {{$announcement->message}}
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- 写公告 -->
    <div class="modal fade" id="createAnnouncement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">写公告</h4>
                </div>
                <div class="modal-body" style="margin: 10px;">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-1 control-label">标题</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" class="form-control" placeholder="标题">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-1 control-label">内容</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" id="message" rows="2" placeholder="内容"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary create-btn">创建</button>
                </div>
            </div>
        </div>
    </div>
    <!--修改群名称-->
    <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改群名称</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">新名字</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="newName" placeholder="新名字">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary edit-ok">保存</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')


<!--修改群名片-->
<script>
    $('.group-name-btn').click(function(){
        var name = $("input[name='group-name']").val();
        var id = $(this).attr('data');
        $.ajax({
            url:"groupcard",
            method:'post',
            dataType:'json',
            data:{name:name,id:id},
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
                show_notice("false","服务器错误");
            }
        });
    });
</script>
<!--修改群名-->
<script>
    $('.edit-name').click(function(){
        var group_id = $(this).attr('data');
        $('#editNameModal').modal('show');
        $('.edit-ok').click(function(){
            var name = $('input[name="newName"]').val();
            if(name==''){
                show_notice("false","不能为空");
            }else{
                $.ajax({
                    url:"editgroupname",
                    method:'post',
                    dataType:'json',
                    data:{name:name,group_id:group_id},
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
            }
        });
    });
</script>
<!--设置管理员-->
<script>
    $('.arrange-ok').click(function(){
        var id = $(this).attr('data');
        $.ajax({
            url:"arrangeok",
            method:'post',
            dataType:'json',
            data:{id:id},
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
                show_notice("false","服务器错误");
            }
        });
    });
    $('.arrange-no').click(function(){
        var id = $(this).attr('data');
        $.ajax({
            url:"arrangeno",
            method:'post',
            dataType:'json',
            data:{id:id},
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
                show_notice("false","服务器错误");
            }
        });
    });
</script>
<!--写公告-->
<script>
    $('.create-announcement-btn').click(function(){
       var group_id = $(this).attr('data');
        $('#createAnnouncement').modal('show');
        $('.create-btn').click(function(){
           var title = $("input[name='title']").val();
           var message = $('#message').val();
           if(group_id==""||title==""||message==""){
               return false;
           }
            $.ajax({
                url:"announcement",
                method:'post',
                dataType:'json',
                data:{title:title,message:message,group_id:group_id},
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
    });
</script>
<!--移除群成员-->
<script>
    $('.delete-user').click(function(){
       var user_id = $(this).attr('user-id');
       var group_id = $(this).attr('group-id');
        $.ajax({
            url:"delgroupuser",
            method:'post',
            dataType:'json',
            data:{user_id:user_id,group_id:group_id},
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