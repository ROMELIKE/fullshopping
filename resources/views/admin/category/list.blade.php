@extends('admin.master')
@section('title','list category')
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
                        <a href="#">Category</a>
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
                        Category
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            List
                        </small>
                        <a href="{!! route('admin.cate.add') !!}" class="btn btn-xs btn-success pull-right btn-lg">
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
                                        <th class="center">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th>Category Name</th>
                                        <th>Parrent</th>
                                        <th class="hidden-480">Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace"/>
                                                    <span class="lbl"></span>
                                                </label>
                                            </td>
                                            <td>
                                                <a href="#">{!! $item->name !!}</a>
                                            </td>
                                            <td>@if($item->parrent_id->result)
                                                    {!! $item->parrent_id->result->name !!}
                                                @else

                                                @endif
                                            </td>
                                            <td class="hidden-480 text-center">
                                                @if(!$item->status==1)
                                                    <span class="label label-sm label-warning">
                                                       {!! 'Waiting' !!}
                                                </span>

                                                @else
                                                    <span class="label label-sm label-success">
                                                       {!! 'Registed' !!}
                                                </span>
                                                @endif

                                            </td>

                                            <td class="text-center">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a href="{!! route('admin.cate.edit',['id'=>$item->id]) !!}"
                                                       class="btn btn-xs btn-info">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                                                    <a href="{!! route('admin.cate.delete',['id'=>$item->id]) !!}"
                                                       class="btn btn-xs btn-danger"
                                                       onclick="confirm('You are Progressing to delete this category, do you want to continues ?')">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"
                                                           ></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /.span -->
                        </div><!-- /.row -->
                        <div id="modal-table" class="modal fade" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header no-padding">
                                        <div class="table-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <span class="white">&times;</span>
                                            </button>
                                            Results for "Latest Registered Domains
                                        </div>
                                    </div>

                                    <div class="modal-body no-padding">
                                        <table class="table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                                            <thead>
                                            <tr>
                                                <th>Domain</th>
                                                <th>Price</th>
                                                <th>Clicks</th>

                                                <th>
                                                    <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                                    Update
                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#">ace.com</a>
                                                </td>
                                                <td>$45</td>
                                                <td>3,330</td>
                                                <td>Feb 12</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <a href="#">base.com</a>
                                                </td>
                                                <td>$35</td>
                                                <td>2,595</td>
                                                <td>Feb 18</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <a href="#">max.com</a>
                                                </td>
                                                <td>$60</td>
                                                <td>4,400</td>
                                                <td>Mar 11</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <a href="#">best.com</a>
                                                </td>
                                                <td>$75</td>
                                                <td>6,500</td>
                                                <td>Apr 03</td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <a href="#">pro.com</a>
                                                </td>
                                                <td>$55</td>
                                                <td>4,250</td>
                                                <td>Jan 21</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="modal-footer no-margin-top">
                                        <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">
                                            <i class="ace-icon fa fa-times"></i>
                                            Close
                                        </button>

                                        <ul class="pagination pull-right no-margin">
                                            <li class="prev disabled">
                                                <a href="#">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>

                                            <li class="active">
                                                <a href="#">1</a>
                                            </li>

                                            <li>
                                                <a href="#">2</a>
                                            </li>

                                            <li>
                                                <a href="#">3</a>
                                            </li>

                                            <li class="next">
                                                <a href="#">
                                                    <i class="ace-icon fa fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
@endsection