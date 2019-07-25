@extends('layout')


@section('css')
<!--ADD-->
<link href="{{asset('css/banji_css/styles.css')}}" rel="stylesheet">
@endsection

@section('content')

    <div class="row" style="margin-bottom: 10px;z-index: 2;position: relative;">
        <div class="col-md-1">
            <a class="btn btn-social-icon btn-google add-group">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-md-2">
            <div class="input-group" style="width: 200px;">
                <input id="look-groupId" type="text" class="form-control" name="groupId" placeholder="群号">
                {{--<input type="text" class="form-control" name="groupIdName" placeholder="群号/群名称">--}}
                <span class="input-group-btn">
                    <button type="button" class="btn btn-info btn-flat look-group">查找</button>
                    {{--<button type="button" data="{{url('user/index/group/search')}}" class="btn btn-info btn-flat group-search">--}}
                        {{--查找--}}
                    {{--</button>--}}
                </span>
            </div>
        </div>
    </div>
    <div class="row look-result" style="display: none;z-index: 2;position: relative;">
        <div class="col-md-6">
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle look-groupimg" src="" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username look-groupname"></h3>
                    <h5 class="widget-user-desc look-groupid"></h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li>
                            <a href="#">
                                <input type="text" class="apply-group-id" name="group_id" style="display: none" value="">
                                <textarea class="form-control" id="apply_message" rows="2" placeholder="申请理由"></textarea>
                                <button type="button" class="btn btn-info apply-btn" style="margin-top: 10px;">提交申请</button>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

<div class='page' style="z-index: 2;position: relative;">
  <div class='content'>
    <div class='circle'>
      <div class='circle_title'>
        <h2>我创建的群</h2>
        <h3><span class="label label-success">{{sizeof($groups)}}</span></h3>
      </div>
      <div class='circle_inner'>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc1.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc3.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc2.png')}}">
        </div>
      </div>
      <div class='content_shadow'></div>
    </div>
  </div>
  <div class='content'>
    <div class='circle'>
      <div class='circle_title'>
        <h2>我管理的群</h2>
        <h3><span class="label label-success">{{sizeof($arranges)}}</span></h3>
      </div>
      <div class='circle_inner'>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc4.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc5.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc6.png')}}">
        </div>
      </div>
      <div class='content_shadow'></div>
    </div>
  </div>
  <div class='content'>
    <div class='circle'>
      <div class='circle_title'>
        <h2>我加入的群</h2>
        <h3><span class="label label-success">{{sizeof($joins)}}</span></h3>
      </div>
      <div class='circle_inner'>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc7.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc8.png')}}">
        </div>
        <div class='circle_inner__layer'>
          <img src="{{asset('image/pc9.png')}}">
        </div>
      </div>
      <div class='content_shadow'></div>
    </div>
  </div>
 <div class="col-md-4">
        @foreach($groups as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
            </a>
        @endforeach
 </div>    
 <div class="col-md-4">  
        @foreach($arranges as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
            </a>
        @endforeach
</div>    
<div class="col-md-4">    
        @foreach($joins as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
            </a>
        @endforeach  
</div>    
     
</div>




<!--yuanlaide chuangjian guanli jiaru 
    <div class="row">
        <div class="col-md-12">
            <h4>我创建的群<span class="label label-success">{{sizeof($groups)}}</span></h4>
        </div>
        @foreach($groups as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                <div class="col-md-4">
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        <div class="col-md-12">
            <h4>我管理的群<span class="label label-success">{{sizeof($arranges)}}</span></h4>
        </div>
        @foreach($arranges as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                <div class="col-md-4">
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
        <div class="col-md-12">
            <h4>我加入的群<span class="label label-success">{{sizeof($joins)}}</span></h4>
        </div>
        @foreach($joins as $group)
            <a href="{{url('user/index/group/detail/'.$group->id)}}">
                <div class="col-md-4">
                    <div class="box box-warning direct-chat direct-chat-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <img src="{{asset($group->avatar)}}" class="img-circle" alt="User Image" style="width: 50px">
                                {{$group->name}}
                                <span data-toggle="tooltip" title="{{$group->groupusers_count.'人'}}" class="badge bg-yellow">
                                {{$group->groupusers_count}}
                            </span>
                            </h3>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
-->



    <!-- 新建班级群 -->
    <div class="modal fade" id="addGroupModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">创建班群</h4>
                </div>
                <div class="modal-body" style="margin: 10px;">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-offset-1 control-label">群名称</label>
                            <div class="col-sm-8">
                                <input type="text" name="groupName" class="form-control" placeholder="群名称">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="button" class="btn btn-primary btn-add-group">创建</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')



<script>
    $('.add-group').click(function(){
        $('#addGroupModal').modal('show');
    });

    $('.btn-add-group').click(function(){

        var groupName = $("input[name='groupName']").val();
        if(groupName==''){
            return;
        }

        $.ajax({
            url:"addgroup",
            method:'post',
            dataType:'json',
            data:{groupName:groupName},
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
<!--查找群-->
<script>
    $('.group-search').click(function(){
       $data = $(this).attr("data");
       $groupIdName = $(" input[ name='groupIdName' ] ").val();
       if($groupIdName==''){
           show_notice("false","搜索词不能为空");
           return;
       }
       window.location.href=$data+'/?groupIdName='+$groupIdName;
    });

    $('.look-group').click(function(){

        var groupId = $("input[name='groupId']").val();

        if(groupId==''){
            show_notice("false","群号不能为空");
            return;
        }

        $.ajax({
            url:"lookgroup",
            method:'post',
            dataType:'json',
            data:{groupId:groupId},
            success:function(data){
                if(data.status=="1"){
                    $('.look-groupimg').attr('src','http://localhost/webdb/public/'+data.msg.avatar);
                    $('.look-groupname').html(data.msg.name);
                    $('.apply-group-id').val(data.msg.id);
                    $('.look-groupid').html("群号:"+data.msg.id);
                    $('.look-result').show();
                }else{
                    $('.look-result').hide();
                    show_notice("false",data.msg);
                }
            },
            error: function(data) {

            }
        });
    });
</script>
<!--申请加群-->
<script>
    $('.apply-btn').click(function(){
       var message = $('#apply_message').val();
       var group_id = $("input[name='group_id']").val();

       if(message==''){
           return;
       }

        $.ajax({
            url:"applygroup",
            method:'post',
            dataType:'json',
            data:{message:message,group_id:group_id},
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