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
                        <a href="#">Administrator</a>
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
                        Administrator
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
                        </small>
                        {{--<a href="{!! route('admin.user.add') !!}" class="btn btn-xs btn-success pull-right btn-lg">--}}
                        {{--<i class="ace-icon fa fa-plus-circle bigger-120"></i>--}}
                        {{--</a>--}}
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
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="hidden-480">Avatar</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Phone
                                        </th>
                                        <th>
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Address
                                        </th>
                                        <th class="hidden-480">Privilege</th>
                                        <th class="hidden-480">Status</th>

                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($listUser as $item)
                                        <tr>
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace"/>
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td class="hidden-480 " width="200">
                                                <img id="avatar" class="editable" alt="Alex's Avatar"
                                                     src="{!! asset('admin/images/avatars')."/$item->avatar" !!}"
                                                     class="img-responsive" width="100em"/>
                                            </td>
                                            <td>
                                                <a href="#">{!! $item->name !!}</a>
                                            </td>
                                            <td>{!! $item->email !!}</td>

                                            <td>{!! $item->phone !!}</td>
                                            <td>{!! $item->address !!}</td>
                                            @if( $item->accessible ==1)
                                                <td class="hidden-480">
                                                    <span class="label label-sm label-success">Admin</span>
                                                </td>
                                            @else
                                                <td class="hidden-480">
                                                    <span class="label label-sm label-info">Super Admin</span>
                                                </td>
                                            @endif

                                            @if( $item->status ==1)
                                                <td class="hidden-480">
                                                    <span class="label label-sm label-success">Registed</span>
                                                </td>
                                            @else
                                                <td class="hidden-480">
                                                    <span class="label label-sm label-warning">Waiting</span>
                                                </td>
                                            @endif

                                            <td class="text-center">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a class="btn btn-xs btn-info"
                                                       href="{!! route('admin.user.edit',['id'=>$item->id]) !!}">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>

                                                    <a class="btn btn-xs btn-danger"
                                                       href="{!! route('admin.user.delete',['id'=>$item->id]) !!}"
                                                       onclick="confirm('You are Progressing to delete this user, do you want to continues ?')">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div><!-- /.row -->
                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection