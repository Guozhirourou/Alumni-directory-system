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
        <div class="col-md-12" style="z-index: 2;position: relative;" >
            <form action="{{url('user/index/friend/search_friend')}}" method="post" class="form-inline">
                {{csrf_field()}}
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="账号/姓名" required>
                </div>
                <button type="submit" class="btn btn-default">查找</button>
            </form>
        </div>
    </div>
    <div class="row" style="margin-top: 20px;" style="z-index: 2;position: relative;" >
        <div class="col-md-6" style="z-index: 2;position: relative;" >
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">{{sizeof($users)}}</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>
                                        <a href="{{url('user/index/profile/'.$user->id)}}">
                                            <img src="{{asset($user->avatar)}}" alt="头像" width="60px" height="60px" class="img-circle">
                                            <span style="font-size: 25px;">{{$user->name.'('.$user->account.')'}}</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection