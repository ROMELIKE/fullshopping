@extends('admin.master')
@section('title','list user')
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
                    <li class="active">List</li>
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
                <div class="ace-settings-container" id="ace-settings-container">
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1>
                        User
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Total: <span  style="color: red;">{{count($listUser)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Waiting: <span  style="color: red;">{{count($listUser)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Censored: <span  style="color: red;">{{count($listUser)}}</span></a>
                        </small>
                        <a href="{!! route('admin.user.add') !!}" class="btn btn-xs btn-success pull-right btn-lg">
                            <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                        </a>
                    </h1>
                </div><!-- /.page-header -->
                @include('admin.block.displayerrors')

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="center hidden-xs">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="">Avatar</th>
                                        <th class="hidden-xs">Full Name</th>
                                        <th>Username</th>
                                        <th class="hidden-xs">Email</th>
                                        <th class="hidden-xs">
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Phone
                                        </th>
                                        <th class="hidden-xs">
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Address
                                        </th>
                                        <th class="">Status</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if( isset($listUser) && $listUser )
                                        @foreach($listUser as $item)
                                            <tr class="text-center">
                                                <td class="center hidden-xs">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td class="" width="200">
                                                    {{--<img id="avatar" class="editable" alt="Alex's Avatar"--}}
                                                    {{--src="{!! asset('admin/images/avatars/profile-pic.jpg') !!}" width="25%"/>--}}
                                                    <img id="avatar" class="editable img-responsive" alt="Alex's Avatar"
                                                         src="@if(isset($item->avatar)&& $item->avatar){!! asset('admin/images/avatars/')."/".$item->avatar!!}@else{!! asset('admin/images/avatars').'/profile-pic.jpg' !!}@endif"
                                                         name="avatar"  class="img-responsive" width="100em"/>
                                                    <input type="hidden" name="current_avatar" value="{!! $item->avatar !!}">
                                                </td>
                                                <td class="hidden-xs">
                                                    <a href="#">{!! $item->name !!}</a>
                                                </td>
                                                <td>
                                                    <a href="#">{!! $item->username !!}</a>
                                                </td>
                                                <td class="hidden-xs">{!! $item->email !!}</td>

                                                <td class="hidden-xs">{!! $item->phone !!}</td>
                                                <td class="hidden-xs">{!! $item->address !!}</td>
                                                @if( $item->status ==1)
                                                    <td class="">
                                                        <span class="label label-sm label-success">Registed</span>
                                                    </td>
                                                @else
                                                    <td class="">
                                                        <span class="label label-sm label-warning">Waiting</span>
                                                    </td>
                                                @endif

                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-info"
                                                           href="{!! route('admin.user.edit',['id'=>$item->id]) !!}">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </a>

                                                        <a class="btn btn-xs btn-danger"
                                                           href="{!! route('admin.user.delete',['id'=>$item->id]) !!}"
                                                           onclick="return confirm('Are you sure to delete this user?')">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h3>There no user here, wait...</h3>
                                    @endif

                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="paginate">
                                        <h5 class="pull-left">Total Pages : {{$listUser->lastPage()}}</h5>
                                        <ul class="pagination pull-right no-margin">
                                            <li class="">
                                                <a href="{{$listUser->url(1)}}">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="prev {{($listUser->currentPage() == 1) ? 'disabled' : ''}}">
                                                <a href="{{$listUser->url($listUser->currentPage() - 1)}}">Prev</a>
                                            </li>
                                            @for($i=1; $i<=$listUser->lastPage();$i++ )
                                                <li class="{{ ($listUser->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{$listUser->url($i)}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                            <li class="next {{($listUser->currentPage() == $listUser->lastPage()) ? 'disabled' : ''}}">
                                                <a href="{{$listUser->url($listUser->currentPage() + 1)}}">Next</a>
                                            </li>
                                            <li class="">
                                                <a href="{{$listUser->url($listUser->lastPage())}}">
                                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- /.span -->
                        </div><!-- /.row -->
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection