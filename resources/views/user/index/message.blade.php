@extends('layout')

@section('title')

    <h1  style="z-index: 2;position: relative;">
        消息
    </h1>
@endsection

@section('css')
    <style>
        .select-friend-active{
            background-color: #3c8dbc;
            color: #ffffff;
        }
        .select-friend-item{
            line-height: 50px;font-size: 20px;border-bottom: 1px solid #cccccc;
        }
    </style>
@endsection
@section('content')
    <div class="row" style="z-index: 2;position: relative;">
        <div class="col-md-12">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">申请加群信息</h3>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="">
                            {{$groups_num}}
                        </span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th style="width: 150px">申请人</th>
                                <th width="300px;">申请信息</th>
                                <th>状态</th>
                                <th style="width: 100px">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($groups as $message)
                                <tr>
                                    <td>
                                        {{$message->group->name}}
                                    </td>
                                    <td>
                                        <img src="{{asset($message->user->avatar)}}" width="40px" class="img-circle" alt="User Image">
                                        {{$message->user->name}}</td>
                                    <td>
                                        {{$message->message}}
                                    </td>
                                    <td>
                                        @if($message->status==0)
                                            <span class="label label-success">待审</span>
                                        @elseif($message->status==1)
                                            <span class="label label-success">同意</span>
                                            审核人:{{$message->check->name}}
                                        @elseif($message->status==2)
                                            <span class="label label-warning">拒绝</span>
                                            审核人:{{$message->check->name}}
                                        @endif

                                    </td>
                                    <td>
                                        @if($message->status==0)
                                        <button type="button" data="{{$message->id}}" class="btn btn-info btn-sm apply-group-ok">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                        <button type="button" data="{{$message->id}}" class="btn btn-danger btn-sm apply-group-no">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row"  style="z-index: 2;position: relative;">
        <div class="col-md-12">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">好友申请信息</h3>
                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="">
                            {{$applys_num}}
                        </span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th style="width: 150px">申请人</th>
                                <th width="300px;">申请信息</th>
                                <th>状态</th>
                                <th style="width: 100px">操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($apply_friends as $message)
                                <tr>
                                    <td>
                                        <a href="{{url('user/index/profile/'.$message->user->id)}}">
                                            <img src="{{asset($message->user->avatar)}}" width="40px" class="img-circle" alt="User Image">
                                            {{$message->user->name}}({{$message->user->account}})
                                        </a>
                                    </td>
                                    <td>
                                        {{$message->message}}
                                    </td>
                                    <td>
                                        @if($message->status==0)
                                            <span class="label label-success">待审</span>
                                        @elseif($message->status==1)
                                            <span class="label label-success">同意</span>
                                        @elseif($message->status==2)
                                            <span class="label label-warning">拒绝</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if($message->status==0)
                                            <button type="button" data="{{$message->id}}" class="btn btn-info btn-sm apply-friend-ok">
                                                <span class="glyphicon glyphicon-ok"></span>
                                            </button>
                                            <button type="button" data="{{$message->id}}" class="btn btn-danger btn-sm apply-friend-no">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row"  style="z-index: 2;position: relative;">
        <div class="col-md-6">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">我的群申请信息</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>申请信息</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($myapplys as $message)
                                <tr>
                                    <td>
                                        {{$message->group->name}}
                                    </td>
                                    <td>
                                        {{$message->message}}
                                    </td>
                                    <td>
                                        @if($message->status==0)
                                            <span class="label label-success">待审</span>
                                        @elseif($message->status==1)
                                            <span class="label label-success">同意</span>
                                            审核人:{{$message->check->name}}
                                        @elseif($message->status==2)
                                            <span class="label label-warning">拒绝</span>
                                            审核人:{{$message->check->name}}
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">我的好友申请信息</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>申请人</th>
                                <th>申请信息</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($my_apply_friends as $message)
                                <tr>
                                    <td>
                                        {{$message->friend->name}}({{$message->friend->account}})
                                    </td>
                                    <td>
                                        {{$message->message}}
                                    </td>
                                    <td>
                                        @if($message->status==0)
                                            <span class="label label-success">待审</span>
                                        @elseif($message->status==1)
                                            <span class="label label-success">同意</span>
                                        @elseif($message->status==2)
                                            <span class="label label-warning">拒绝</span>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">系统消息</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>群名称</th>
                                <th>申请信息</th>
                                <th>状态</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>


    <!--选择分组-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">请选择分组</h4>
                </div>
                <div class="modal-body">
                    <a href="{{url('user/index/friend')}}">
                        新建分组
                    </a>
                    <div class="row">
                        @foreach(\Auth::user()->friends as $friend)
                            <div data="{{$friend->id}}" class="col-md-12 select-friend-item">{{$friend->name}}</div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary select-list-ok">确定</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        var apply_friend_id = '';
        var list_id = '';
        $('.apply-friend-ok').click(function(){
            apply_friend_id = $(this).attr("data");
            $('#myModal').modal('show');
        });

        $('.select-list-ok').click(function(){

            $(".select-friend-item").each(function(){
                if($(this).hasClass('select-friend-active')){
                    list_id = $(this).attr("data");
                }
            });

            if(list_id==''){
                show_notice("false","请选择分组");
                return false;
            }
            $.ajax({
                url:"friend/apply/ok",
                method:'post',
                dataType:'json',
                data:{apply_friend_id:apply_friend_id,list_id:list_id},
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

                }
            });

        });

        $('.apply-friend-no').click(function(){
            apply_friend_id = $(this).attr("data");
            $.ajax({
                url:"friend/apply/no",
                method:'post',
                dataType:'json',
                data:{apply_friend_id:apply_friend_id},
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

                }
            });
        });
        $('.select-friend-item').click(function(){
           $('.select-friend-item').removeClass('select-friend-active');
           $(this).addClass('select-friend-active');
        });
    </script>
    <script>
        $('.apply-group-ok').click(function(){
            var applygroup_id = $(this).attr('data');
            $.ajax({
                url:"applygroup/ok",
                method:'post',
                dataType:'json',
                data:{applygroup_id:applygroup_id},
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

                }
            });
        });

        $('.apply-group-no').click(function(){
            var applygroup_id = $(this).attr('data');
            $.ajax({
                url:"applygroup/no",
                method:'post',
                dataType:'json',
                data:{applygroup_id:applygroup_id},
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

                }
            });
        });
    </script>

@endsection