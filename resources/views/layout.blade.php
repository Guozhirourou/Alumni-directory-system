<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>校友通讯录</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('admin/dist/css/skins/_all-skins.min.css')}}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <style>
        .table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td{vertical-align: middle;}
    </style>
	
    @yield('css')


</head>
<body class="hold-transition skin-blue sidebar-mini">
<canvas id="c" style="background: rgba(255,255,155,0); position: absolute; z-index: 1"  ></canvas> 
<div class="wrapper" >
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset(\Auth::user()->avatar)}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{\Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset(\Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url('user/index/profile/'.\Auth::user()->id)}}" class="btn btn-default btn-flat">个人信息</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{url('user/logout')}}" class="btn btn-default btn-flat">退出</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
	
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset(\Auth::user()->avatar)}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{\Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">菜单</li>
                <li class="treeview {{Request::path()=='user/index/group/search'?'active':''}}{{Request::path()=='user/index/friend'?'active':''}}{{Request::path()=='user/index/group'?'active':''}}{{Request::is('user/index/group/detail/*')?'active':''}}">
                    <a href="#">
                        <i class="fa fa-dashboard"></i>
                        <span>校友</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::path()=='user/index/friend'?'active':''}}"><a href="{{url('user/index/friend')}}"><i class="fa fa-circle-o"></i>校友</a></li>
                        <li class="{{Request::path()=='user/index/group'?'active':''}}"><a href="{{url('user/index/group')}}"><i class="fa fa-circle-o"></i>班群</a></li>
                    </ul>
                </li>
                <li class="treeview {{Request::path()=='user/index/message_board/'.\Auth::id()?'active':''}}{{Request::path()=='user/index/school'?'active':''}}{{Request::path()=='user/index/post/'.\Auth::id()?'active':''}}{{Request::path()=='user/index/addpost'?'active':''}}">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>空间</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{Request::path()=='user/index/school'?'active':''}}">
                            <a href="{{url('user/index/school')}}"><i class="fa fa-circle-o"></i>校友动态</a>
                        </li>
                        <li class="{{Request::path()=='user/index/message_board/'.\Auth::id()?'active':''}}">
                            <a href="{{url('user/index/message_board/'.\Auth::id())}}"><i class="fa fa-circle-o"></i>留言板</a>
                        </li>
                        <li class="{{Request::path()=='user/index/post/'.\Auth::id()?'active':''}}{{Request::path()=='user/index/addpost'?'active':''}}">
                            <a href="{{asset(url('user/index/post/'.\Auth::id()))}}"><i class="fa fa-circle-o"></i>我的动态</a>
                        </li>
                    </ul>
                </li>
                <li class="{{Request::path()=='user/index/profile/'.\Auth::id()?'active':''}}">
                    <a href="{{url('user/index/profile/'.\Auth::id())}}">
                        <i class="fa fa-files-o"></i>
                        <span>个人信息</span>
                    </a>
                </li>
                <li class="{{Request::path()=='user/index/message'?'active':''}}">
                    <a href="{{url('user/index/message')}}">
                        <i class="fa fa-envelope-o"></i>
                        <span>通知</span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            @yield('title')
        </section>
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        <!-- Main content end-->
    </div>

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0.0
        </div>
        <strong>校友通讯录</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark" style="opacity: 0;">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab">
            </div>
            <div class="tab-pane" id="control-sidebar-stats-tab"></div>
            <div class="tab-pane" id="control-sidebar-settings-tab">
            </div>
        </div>
    </aside>

    <div class="control-sidebar-bg"></div>

    
</div> 
   
@include('user.notice')
<!-- jQuery 3 -->
    <script src="{{asset('admin/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('admin/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
    

<!--ADDD-->
<script type="text/javascript" src="{{asset('js/title_menu_js/maps.js')}}"></script>
<script type="text/javascript" src="{{asset('js/title_menu_js/google.js')}}"></script>
<script type="text/javascript">$(document).ready(function(){$().maps();});</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
{{--<!-- AdminLTE for demo purposes -->--}}
<script src="{{asset('admin/dist/js/demo.js')}}"></script>

<!--beijinghuabu-->
<script type="text/javascript"  src="{{asset('js/beijing_js/ban.js')}}"></script>  <!--
<script type="text/javascript"  src="{{asset('js/beijing_js/jquery.min.js')}}"></script>   -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function show_notice(flag,msg)
    {
        if(flag=="true"){
            $('#myMessageModal').modal('show');
            $('.message-modal-body').html(msg);
            setTimeout(function(){
                $('#myMessageModal').modal('hide');
            },1500);
        }else if(flag=="false"){
            $('#myMessageModal').modal('show');
            $('.message-modal-body').html(msg);
        }
    }
</script>
@yield('js')
</body>
</html>
