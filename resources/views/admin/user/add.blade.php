@extends('admin.master')
@section('title','add user')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">User</a>
                    </li>
                    <li class="active">Add</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"
                                           id="nav-search-input" autocomplete="off"/>
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        User
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                @include('admin.block.displayerrors')

                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-block alert-danger message-box">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <i class="ace-icon fa fa-times red"></i>
                            <strong class="red">
                                {{$error}}
                            </strong>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" action="{!! route('admin.user.add') !!}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Full
                                    Name </label>

                                <div class="col-sm-9">
                                    <input type="text" placeholder="Fullname"
                                           class="col-xs-10 col-sm-5" name="fullname" value="{!! old('fullname') !!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Username </label>

                                <div class="col-sm-9">
                                    <input type="text" placeholder="Username"
                                           class="col-xs-10 col-sm-5 " name="username" value="{!! old('username') !!}" maxlength="50"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Email </label>

                                <div class="col-sm-9">
                                    <input type="text" placeholder="Email" class="col-xs-10 col-sm-5"
                                           name="email" value="{!! old('email') !!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Phone </label>

                                <div class="col-sm-9">
                                    <input type="number" placeholder="Phone" class="col-xs-10 col-sm-5"
                                           name="phone" value="{!! old('phone') !!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Address </label>

                                <div class="col-sm-9">
                                    <input type="text" placeholder="address"
                                           class="col-xs-10 col-sm-5" name="address" value="{!! old('address') !!}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Password </label>

                                <div class="col-sm-9">
                                    <input type="password" id="form-field-1" placeholder="password"
                                           class="col-xs-10 col-sm-5" name="password"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">
                                    Repassword </label>

                                <div class="col-sm-9">
                                    <input type="password" id="form-field-1" placeholder="repassword"
                                           class="col-xs-10 col-sm-5" name="repassword"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Avatar</label>
                                <div class="col-sm-9 col-md-4">
                                    <label class="ace-file-input">
                                        <input type="file" id="id-input-file-2" name="avatar">
                                        <span class="ace-file-container" data-title="Choose">
                                                                <span class="ace-file-name" data-title="No File ...">
                                                                    <i class=" ace-icon fa fa-upload"></i>
                                                                </span>
                                                            </span>
                                        <a class="remove" href="#">
                                            <i class=" ace-icon fa fa-times"></i>
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-xs-12 col-sm-3 no-padding-right">Gender</label>

                                <div class="col-xs-12 col-sm-9">
                                    <div>
                                        <label class="line-height-1 blue">
                                            <input name="gender" value="1" type="radio" class="ace" />
                                            <span class="lbl"> Male</span>
                                        </label>
                                    </div>

                                    <div>
                                        <label class="line-height-1 blue">
                                            <input name="gender" value="2" type="radio" class="ace" />
                                            <span class="lbl"> Female</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Status</label>
                                <div class="col-xs-9">
                                    <label>
                                        <input name="status" class="ace ace-switch ace-switch-7" type="checkbox">
                                        <span class="lbl"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>

                        <div class="hr hr-18 dotted hr-double"></div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
@endsection