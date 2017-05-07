@extends('admin.master')
@section('title','edit user')
@section('content')
    <div class="main-content">
        <div class="main-content-inner" style="position: relative">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">User</a>
                    </li>
                    <li class="active">Edit</li>
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
                            Edit
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
                        <div>
                            <form action="{!! route('admin.user.edit',['id'=>$thisUser->id]) !!}" method="post"
                                  enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div id="user-profile-1" class="user-profile row">
                                    <div class="col-xs-12 col-sm-3 center">
                                        <div>
												<span class="profile-picture">
													<img id="avatar" class="editable img-responsive" alt="Alex's Avatar"
                                                         src="@if(isset($thisUser->avatar)&& $thisUser->avatar){!! asset('admin/images/avatars')."/".$thisUser->avatar!!}@else{!! asset('admin/images/avatars').'/profile-pic.jpg' !!}@endif"
                                                         name=""/>
                                                    <input type="hidden" name="current_avatar"
                                                           value="{!! $thisUser->avatar !!}">
												</span>
                                            <div class="space-4"></div>

                                            <label class="ace-file-input">
                                                <input type="file" name="avatar">
                                                <span class="ace-file-container" data-title="Choose">
                                                                <span class="ace-file-name"
                                                                      data-title="Choose a picture">
                                                                    <i class=" ace-icon fa fa-upload"></i>
                                                                </span>
                                                            </span>
                                                <a class="remove" href="#">
                                                    <i class=" ace-icon fa fa-times"></i>
                                                </a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-9">
                                        <div class="profile-user-info profile-user-info-striped">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Fullname</div>

                                                <div class="profile-info-value">
                                                <span class="editable" id="username">
                                                    <input type="text" name="fullname" value="{!! $thisUser->name !!}">
                                                </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"><i
                                                            class="fa fa-map-marker light-orange bigger-110"></i>
                                                    Address
                                                </div>

                                                <div class="profile-info-value">

                                                <span class="editable" id="country">
                                                    <input type="text" name="address"
                                                           value="{!! $thisUser->address !!}">
                                                </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Email</div>

                                                <div class="profile-info-value">
                                                <span class="editable" id="age">
                                                  <input type="text" name="email" value="{!! $thisUser->email !!}">
                                                </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Phone</div>

                                                <div class="profile-info-value">
                                                <span class="editable" id="signup">
                                                    <input type="number" name="phone" value="{!! $thisUser->phone !!}">
                                                </span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">Gender</div>
                                                <div class="profile-info-value">
                                                <span class="input-icon">
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
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="profile-info-row">
                                                <div class="profile-info-name"> Password</div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name">Status</div>
                                                <div class="profile-info-value">
                                                <span class="input-icon">
                                                        <label>
                                                            @if($thisUser->status)
                                                                <input name="status"
                                                                       class="ace ace-switch ace-switch-3"
                                                                       type="checkbox" name="status"
                                                                       checked value="1">
                                                            @else
                                                                <input name="status"
                                                                       class="ace ace-switch ace-switch-3"
                                                                       type="checkbox" name="status">
                                                            @endif

                                                            <span class="lbl"></span>
                                                    </label>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="profile-info-row">
                                                <div class="profile-info-name">Confirm</div>

                                                <div class="profile-info-value">
                                                <span class="editable" id="signup">
                                                     <button class="btn btn-sm btn-primary" type="submit">
                                                                    <i class="ace-icon fa fa-check"></i>
                                                                    Save
                                                                </button>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group" style="position: absolute;top: 65%;left: 37%;">
                                <h6 class="pink">
                                    <a href="#modal-form" role="button" class="blue"
                                       data-toggle="modal" style="text-decoration: none">&nbsp &nbsp
                                        Change Password... </a>
                                </h6>

                                <div id="modal-form" class="modal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close"
                                                        data-dismiss="modal">&times;</button>
                                                <h4 class="blue bigger">Change the password of this
                                                    User</h4>
                                            </div>
                                            <form action="{!! route('admin.user.edit_changepassword',['id'=>$thisUser->id]) !!}"
                                                  method="post">
                                                <input type="hidden" name="_token"
                                                       value="{!! csrf_token() !!}">
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <table>
                                                                <tr>
                                                                    <td>
                                                                        <label for="">New
                                                                            Password:&nbsp</label>
                                                                    </td>
                                                                    <td>
                                                                        <input type="password"
                                                                               placeholder="Enter your new password"
                                                                               name="newpw"
                                                                               size="30" class="form-group"/>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label for="">ReNew
                                                                            Password:&nbsp</label>
                                                                    </td>
                                                                    <td>
                                                                        <input type="password"
                                                                               placeholder="Enter your new password one time again"
                                                                               name="renewpw"
                                                                               size="30" class="form-group"/>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm" data-dismiss="modal"
                                                            type="reset">
                                                        <i class="ace-icon fa fa-times"></i>
                                                        Cancel
                                                    </button>

                                                    <button class="btn btn-sm btn-primary"
                                                            type="submit">
                                                        <i class="ace-icon fa fa-check"></i>
                                                        Save
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection