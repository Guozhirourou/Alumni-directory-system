<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
<title>后台登录</title>
<meta name="author" content="DeathGhost" />
<link href="{{asset('css/login_css/style.css')}}" rel="stylesheet"  >

<style>
body{height:100%;background:#16a085;overflow:hidden;}
a {  margin-left:256px; 
    color: #ffffff;
    text-decoration: none;
    outline: 0;
}
canvas{z-index:-1;position:absolute;}
</style>

<script src="{{asset('js/jquery.min.js')}}"></script> 

{{--<script src="{{asset('js/login_js/verificationNumbers.js')}}" ></script>--}}
{{--<script src="{{asset('js/login_js/jquery.js')}}"></script>--}}
<script src="{{asset('js/login_js/Particleground.js')}}" ></script>

<script>
$(document).ready(function() {
  //粒子背景特效
  $('body').particleground({
    dotColor: '#5cbdaa',
    lineColor: '#5cbdaa'
  });
});
</script>

<script>

</script>
</head>

<body>

<dl class="admin_login">
 <dt>
  <strong>校友通讯录注册界面</strong>
  <em>Management System</em>
 </dt>
	<form action="" method="get">
		<dd class="user_icon">
			<input type="text" placeholder="账号" class="login_txtbx account" name="username" />
		</dd>
		<dd class="pwd_icon">
			<input type="password" placeholder="密码" class="login_txtbx password1" name="passwd" />
		</dd>
		<dd class="pwd_icon">
			<input type="password" placeholder="确认密码" class="login_txtbx password2" name="" />
		</dd>
		<dd>
			<input type="button" data="{{url('user/auth_register')}}" value="立即注册" class="submit_btn" name="register" />
		</dd>
        <dd>
            <a href={{url('user/login')}}>login</a>
        </dd>
	</form>
</dl>
<span data="{{url('user/login')}}" class="login"></span>
</body>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.submit_btn').click(function(){
        var href = $(this).attr("data");
        var account = $('.account').val();
        var password1 = $('.password1').val();
        var password2 = $('.password2').val();
        if(account==""){
            alert("账号不能为空");
            return false;
		}
        if(password1==""){
            alert("密码不能为空");
            return false;
        }
        if(password1!=password2){
            alert("两次密码不一致");
            return false;
        }

        console.log(account+","+password1);

        $.ajax({
            url:href,
            method:'post',
            dataType:'json',
            data:{account:account,password1:password1,password2:password2},
            success:function(data){
                if(data.status=="1"){
                    alert("注册成功");
                    window.location.href = $('.login').attr("data");
                }else{
                    alert(data.msg);
                }
            },
            error: function(data) {
                alert("服务器错误");
            }
        });
	});
</script>
</html>



