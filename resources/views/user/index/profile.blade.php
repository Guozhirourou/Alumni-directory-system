@extends('layout')

@section('css')
    <link href="{{asset('css/avatar/cropper.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/avatar/sitelogo.css')}}" rel="stylesheet">
<!--ADD-->
    <link rel="stylesheet" href="{{asset('css/personalMess_css/style.css')}}" />

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

@section('title')
<!--zhushi
    <h1>
        @if(\Auth::id()==$user->id)
        个人信息
        @endif
    </h1>
-->	
@endsection

@section('content')

    <style>
        h3.tittle{
            border-bottom: solid 5px #5cafa5;

            padding: 0em 0 0.5em 0;
            
            position: relative;

        }
       
    </style>
     <div class="about-section" id="about" style="z-index: 2;position: relative;" >
        <div class="container">
               <h3 class="tittle" style="margin-top:-40px " ><img src="{{asset('image/气球.png')}}"    height="45" width="45"/>
                   @if(\Auth::id()==$user->id)
                   个人信息
                   @endif
               </h3>
                <div class="about-top" style="margin-top:20px ">
                  <div class="col-md-6 about-text">
                      
                   <h2>
                       <img src="{{asset('image/伞.png')}}"    height="40" width="40"/>
                      {{$user->name}}({{$user->account}})
                        @if($user->id==\Auth::id())
                        <span style="cursor: pointer;" class="glyphicon glyphicon-pencil edit-name" aria-hidden="true"></span>
                        @endif
                   </h2><hr style="border: 1px dashed #ccc; width: 100%; height: 1px;" />
                  <p>个人简介</p>
                  <p>超级无敌巨可爱宇宙无敌最厉害沉鱼落雁闭月羞花肤白貌美年轻大长腿国民女神的富强民主文明和谐友善敬业爱国balabalabalalabalabalabalalalalalalabalabalabalalalalalalalalalalalalalalala的super精致的戏精女孩</p>
                      <hr style="border: 1px dashed #ccc; width: 100%; height: 1px;" />
                    <a href="{{url('user/index/post/'.$user->id)}}" class="con two"><i class="glyphicon glyphicon-menu-right"></i>动态   <span class="pull-right badge   text-blue"  style="background-color:#fff" >{{$user->posts_count}}</span></a>
                    <a href="{{url('user/index/message_board/'.$user->id)}}" class="con two" style="position:relative;margin-left:130px"><i class="glyphicon glyphicon-menu-right" ></i>留言<span class="pull-right badge    text-blue" style="background-color:#fff">{{sizeof($user->messages)}}</span></a>
                </div>
                  <div class="col-md-6 about-pic">
                      
                    <img data-toggle="modal" data-target="#avatar-modal" class="img-circle" style="cursor: pointer;"src="{{asset($user->avatar)}}" alt="此处应该有头像但是没有头像啊啊啊啊啊"/> 
                  
                  </div>
                <div class="clearfix"> </div>       
            </div>
        </div>
     </div>
  <!--//about-->
<!--ADD-->
<!--
    <div class="col-md-6">
        <div class="box box-widget widget-user-2">
            <div class="widget-user-header bg-yellow" style="height: 100px;">
                <div  class="widget-user-image">
                    @if($user->id==\Auth::id())
                        <img data-toggle="modal" data-target="#avatar-modal" class="img-circle" style="cursor: pointer;" src="{{asset($user->avatar)}}" alt="User Avatar">
                    @else
                        <img class="img-circle" style="cursor: pointer;" src="{{asset($user->avatar)}}" alt="User Avatar">
                    @endif
                </div>
                <p class="widget-user-username" style="line-height: 60px;font-size: 20px;">
                    {{$user->name}}({{$user->account}})
                    @if($user->id==\Auth::id())
                        <span style="cursor: pointer;" class="glyphicon glyphicon-pencil edit-name" aria-hidden="true"></span>
                    @endif
                </p>
            </div>
            <div class="box-footer no-padding">
                <ul class="nav nav-stacked">
                    <li><a href="{{url('user/index/post/'.$user->id)}}">动态<span class="pull-right badge bg-blue">{{$user->posts_count}}</span></a></li>
                    <li><a href="{{url('user/index/message_board/'.$user->id)}}">留言<span class="pull-right badge bg-aqua">{{sizeof($user->messages)}}</span></a></li>
                </ul>
            </div>
        </div>
    </div>    
    -->
    @if($user->id!=\Auth::id()&&!isMyFriend($user->id))
        <div class="col-md-4">
            <button type="button" class="add-friend">加好友</button>
            <div class="add-friend-box" style="display: none;">
                <div class="form-group">
                    <label for="">申请理由</label>
                    <input type="" id="apply-message" class="form-control" id="" placeholder="">
                </div>
                <button type="button" data="{{$user->id}}" href="{{url('user/index/friend/apply')}}" class="apply-friend-btn">申请加好友</button>
            </div>
        </div>
    @endif
    @if($user->id!=\Auth::id()&&isMyFriend($user->id))
        <div class="col-md-4">
            <div>
                <button href="{{url('user/index/friend/delete')}}" class="delete-friend" data="{{getFriendUserById($user->id)->id}}" type="button">删除好友</button>
                <div class="form-group">
                    <label for="">备注</label>
                    <input type="" id="friend-card-name" class="form-control" value="{{getFriendUserById($user->id)->name==''?getFriendUserById($user->id)->user->name:getFriendUserById($user->id)->name}}">
                </div>
                <button type="button" data="{{getFriendUserById($user->id)->id}}" href="{{url('user/index/friend/edit_friend_card')}}" class="edit-friend-card">修改</button>
            </div>
        </div>
    @endif

    <div class="modal fade" id="editNameModal" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">修改姓名</h4>
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
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form class="avatar-form">
                    <div class="modal-header">
                        <button class="close" data-dismiss="modal" type="button">×</button>
                        <h4 class="modal-title" id="avatar-modal-label">上传图片</h4>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-body">
                            <div class="avatar-upload">
                                <input class="avatar-src" name="avatar_src" type="hidden">
                                <input class="avatar-data" name="avatar_data" type="hidden">
                                <label for="avatarInput" style="line-height: 35px;">图片上传</label>
                                <button class="btn btn-danger" type="button" style="height: 35px;" onclick="$('input[id=avatarInput]').click();">请选择图片</button>
                                <span id="avatar-name"></span>
                                <input class="avatar-input hide" id="avatarInput" name="avatar_file" type="file"></div>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="avatar-wrapper"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="avatar-preview preview-lg" id="imageHead"></div>
                                </div>
                            </div>
                            <div class="row avatar-btns">
                                <div class="col-md-4">
                                    <div class="btn-group">
                                        <button class="btn btn-danger fa fa-undo" data-method="rotate" data-option="-90" type="button" title="Rotate -90 degrees"> 向左旋转</button>
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn  btn-danger fa fa-repeat" data-method="rotate" data-option="90" type="button" title="Rotate 90 degrees"> 向右旋转</button>
                                    </div>
                                </div>
                                <div class="col-md-5" style="text-align: right;">
                                    <button class="btn btn-danger fa fa-arrows" data-method="setDragMode" data-option="move" type="button" title="移动">
							            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;setDragMode&quot;, &quot;move&quot;)">
							            </span>
                                    </button>
                                    <button type="button" class="btn btn-danger fa fa-search-plus" data-method="zoom" data-option="0.1" title="放大图片">
							            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, 0.1)">
							              <!--<span class="fa fa-search-plus"></span>-->
							            </span>
                                    </button>
                                    <button type="button" class="btn btn-danger fa fa-search-minus" data-method="zoom" data-option="-0.1" title="缩小图片">
							            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;zoom&quot;, -0.1)">
							              <!--<span class="fa fa-search-minus"></span>-->
							            </span>
                                    </button>
                                    <button type="button" class="btn btn-danger fa fa-refresh" data-method="reset" title="重置图片">
								            <span class="docs-tooltip" data-toggle="tooltip" title="" data-original-title="$().cropper(&quot;reset&quot;)" aria-describedby="tooltip866214">
								       </span></button>
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-danger btn-block avatar-save fa fa-save" type="button" data-dismiss="modal"> 保存修改</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--选择分组-->
    <div class="modal fade" id="selectListModal" tabindex="-1" role="dialog" aria-labelledby="">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">选择分组</h4>
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
                    <button type="button" class="btn btn-primary select-list-btn">确定</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{asset('js/avatar/cropper.js')}}"></script>
<script src="{{asset('js/avatar/sitelogo.js')}}"></script>
<script src="{{asset('js/avatar/html2canvas.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    $('.delete-friend').click(function(){
        var id = $(this).attr("data");
        var href = $(this).attr("href");
        $.ajax({
            url: href,
            data: {id:id},
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
    })
</script>
<script>
    //修改好友备注
    $('.edit-friend-card').click(function(){
        var href = $(this).attr('href');
        var friend_user_id = $(this).attr("data");
        var name = $('#friend-card-name').val();
        if(name==''){
            show_notice("false","备注不能为空");
            return false;
        }
        $.ajax({
            url: href,
            data: {friend_user_id:friend_user_id,name:name},
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

<script>
    $('.add-friend').click(function(){
       $('.add-friend-box').toggle();
    });
    var friend_id = '';
    var href = '';
    var message = '';
    var list_id = '';
    $('.apply-friend-btn').click(function(){
        friend_id = $(this).attr("data");
        href = $(this).attr("href");
        message = $('#apply-message').val();

        if(message==''){
            show_notice("false","申请理由不能为空");
            return false;
        }

        $('#selectListModal').modal('show');
    });

    $('.select-list-btn').click(function(){
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
            url: href,
            data: {friend_id:friend_id,message:message,list_id:list_id},
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

    $('.select-friend-item').click(function(){
        $('.select-friend-item').removeClass('select-friend-active');
        $(this).addClass('select-friend-active');
    });
</script>

<!--修改头像-->
<script type="text/javascript">
    //做个下简易的验证  大小 格式
    $('#avatarInput').on('change', function(e) {
        var filemaxsize = 1024 * 5;//5M
        var target = $(e.target);
        var Size = target[0].files[0].size / 1024;
        if(Size > filemaxsize) {
            show_notice("false","图片过大");
            $(".avatar-wrapper").childre().remove;
            return false;
        }
        if(!this.files[0].type.match(/image.*/)) {
            show_notice("false","请选择正确的图片");
        } else {
            var filename = document.querySelector("#avatar-name");
            var texts = document.querySelector("#avatarInput").value;
            var teststr = texts; //你这里的路径写错了
            testend = teststr.match(/[^\\]+\.[^\(]+/i); //直接完整文件名的
            filename.innerHTML = testend;
        }

    });
    $(".avatar-save").on("click", function() {
        var img_lg = document.getElementById('imageHead');
        // 截图小的显示框内的内容
        html2canvas(img_lg, {
            allowTaint: true,
            taintTest: false,
            onrendered: function(canvas) {
                canvas.id = "mycanvas";
                //生成base64图片数据
                var dataUrl = canvas.toDataURL("image/jpeg");
                var newImg = document.createElement("img");
                newImg.src = dataUrl;
                $('.user_pic img').attr('src',dataUrl );
                console.log(dataUrl);
                imagesAjax(dataUrl);
            }
        });
    })
    function imagesAjax(src) {
        var data = {};
        data.img = src;
        data.jid = $('#jid').val();
        $.ajax({
            url: "../edituseravatar",
            data: data,
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
    }
</script>

<!--修改姓名-->
<script>
    $('.edit-name').click(function(){
        $('#editNameModal').modal('show');
        $('.edit-ok').click(function(){
           var name = $('input[name="newName"]').val();
           if(name==''){
               show_notice("false","姓名不能为空");
           }else{
               $.ajax({
                   url:"../editusername",
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
           }
        });
    });
</script>
@endsection