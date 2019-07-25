@extends('layout')

@section('title')
    <div style="z-index: 2;position: relative;" >
    <h1>
        <a href="javascript:history.go(-1);" class="btn btn-social-icon btn-google add-group">
            <span class="glyphicon glyphicon-arrow-left"></span>
        </a>
        查询到{{sizeof($groups)}}个班群
    </h1>
    </div>
@endsection

@section('content') 
    <div class="row look-result" style="display: none;" style="z-index: 2;position: relative;" >
        <div class="col-md-12">
            <div class="box box-widget widget-user-2">
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle look-groupimg" src="" alt="User Avatar">
                    </div>
                    <h3 class="widget-user-username"></h3>
                    <h5 class="widget-user-desc"></h5>
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
@endsection

@section('js')

@endsection