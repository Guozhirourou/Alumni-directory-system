@extends('layout')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/wangEditor.min.css')}}">
@endsection

@section('title')
    <h1  style="z-index: 2;position: relative;">
        <a href="javascript:history.go(-1);" class="btn btn-social-icon btn-google add-group">
            <span class="glyphicon glyphicon-arrow-left"></span>
        </a>
    </h1>
@endsection

@section('content')
<div class="row"  style="z-index: 2;position: relative;">
    <div class="col-md-8">
        <form>
            {{csrf_field()}}
            <div class="form-group">
                <label>内容</label>
                <textarea id="content"  style="height:500px;" name="content" class="form-control" placeholder="这里是内容"></textarea>
            </div>
            <button type="button" class="btn btn-default ok">提交</button>
        </form>
    </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/wangEditor.min.js')}}"></script>
    <script>
        var editor = new wangEditor('content');
        // 配置服务器端地址
        editor.config.uploadImgUrl = 'addpost/uploadimage';
        // 设置 headers（举例）
        editor.config.uploadHeaders = {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        };
        // 自定义timeout事件
        editor.config.uploadImgFns.ontimeout = function (xhr) {
            // xhr 是 xmlHttpRequest 对象，IE8、9中不支持
            alert('上传超时');
        };
        // 自定义error事件
        editor.config.uploadImgFns.onerror = function (xhr) {
            // xhr 是 xmlHttpRequest 对象，IE8、9中不支持
            alert('上传错误');
        };
        editor.create();
    </script>
    <script>
        $('.ok').click(function(){
            var title = $("input[name='title']").val();
            var content = $("#content").val();
            $.ajax({
                url:"storepost",
                method:'post',
                dataType:'json',
                data:{title:title,content:content},
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
                    var errors = $.parseJSON(data.responseText);
                    var str = '';
                    if(errors.errors.title!=undefined){
                        str+=errors.errors.title+'<br>';
                    }
                    if(errors.errors.content!=undefined){
                        str+=errors.errors.content;
                    }
                    show_notice("false",str);
                }
            });
        });
    </script>
@endsection