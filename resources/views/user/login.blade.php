<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录</title>

    <link href="{{asset('css/login_css/style.css')}}" rel="stylesheet"  ><!--ADD-->



<style>
body{height:100%;background:#16a085;overflow:hidden;}

a {  margin-left:217px; 
    color: #ffffff;
    text-decoration: none;
    outline: 0;
}
dd.h11 {
     height: 20px;
}
dd.h12{
    height: 18px;
}
canvas{z-index:-1;position:absolute;}

</style>



<script src="{{asset('js/jquery.min.js')}}"></script>  

<script src="{{asset('js/login_js/verificationNumbers.js')}}" ></script>
<script src="{{asset('js/login_js/jquery.js')}}"></script>

<script src="{{asset('js/login_js/Particleground.js')}}" ></script>

</head>
<body>


<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
 //验证码
  createCode();

});


</script>



<!--
<div class="container">
    <div class="" style="margin-top: 30px;">
        <form action="{{url('user/login')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <h3 style="text-align: center">登录平台1234</h3>
                </div>
            </div>
            <div class="row" style="margin-top: 0px;">
                <div class="col-md-4 col-md-offset-4">
                    @include('user.messgae')
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <input type="text" class="form-control" name="account" value="{{old('account') ? old('account'):''}}" placeholder="账号">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <input type="password" class="form-control" name="password" placeholder="密码">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-4 col-xs-9" style="padding-right: 0px;">
                    <input type="text" name="code" class="form-control" placeholder="验证码">
                </div>
                <div  class="col-md-1 col-xs-3" style="padding-left: 0px;">
                    <img class="code" src="{{ url('/captcha') }}" style="width: 100%" height="34px" onclick="this.src='{{ url('/captcha') }}?r='+Math.random();" alt="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <label>
                        <input type="checkbox" value="1" name="is_remember"> 记住我
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <label>
                        <button type="submit" class="btn btn-info login_btn">登录</button>
                    </label>
                </div>
            </div>
        </form>
    </div>
</div>
-->


<form action="{{url('user/login')}}" method="post">
    {{csrf_field()}}
    <dl class="admin_login">
        <dt>
            <strong>请登录</strong>
            <em>校友通讯管理系统</em>
        </dt>
        <div align="center" >
            @include('user.messgae')
        </div>
        <dd class="user_icon">
            <input type="text" placeholder="账号" class="col-md-4 col-md-offset-4 login_txtbx form-control"    name="account" value="{{old('account') ? old('account'):''}}"/>
        </dd>
        <dd class="pwd_icon">
            <input type="password" placeholder="密码" name="password"class="col-md-4 col-md-offset-4 login_txtbx form-control"/>
        </dd>
        <dd class="val_icon">
            <div class="checkcode">
                  <input type="text" id="J_codetext" name="code" style="width: 100px;"  placeholder="验证码" maxlength="4" class="login_txtbx form-control">

                    <canvas class="J_codeimg" id="myCanvas"  onclick="createCode()">显示验证码</canvas>   
             
            </div>
                  <input type="button" value="验证码核验" class="ver_btn" onClick="validate();">

        </dd>
        <dd class="h11">
           <label>
                  <input type="checkbox" value="1" name="is_remember"> 记住我
                   
           </label>
        </dd>
                <dd class="h12" >
           <label>
                  <a href="{{url('user/register')}}"> regiser now</a>
                   
           </label>
        </dd>
        

        <dd>
           <label>
                  <input  type="submit"  value="立即登陆" class="submit_btn" onClick="validate();"/>
           </label>
        </dd>
 <dd>
  <p>组长：韦喆艺</p>
  <p>组员：郭芷柔、赖永杏</p>

 </dd>
</dl>
</form>


</body>
</html>
