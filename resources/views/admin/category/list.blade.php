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
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Total: <span  style="color: red;">{{count($list)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Waiting: <span  style="color: gold;">20</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Censored: <span  style="color: green;">80</span></a>
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
                                    <tr class="text-center">
                                        <th class="center text-center hidden-xs">
                                            <label class="pos-rel">
                                                <input type="checkbox" class="ace"/>
                                                <span class="lbl"></span>
                                            </label>
                                        </th>
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center hidden-xs">Parrent</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if( isset($list) && $list )
                                        @foreach($list as $item)
                                            <tr class="text-center">
                                                <td class="center hidden-xs">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a href="#">{{$item->name}}</a>
                                                </td>
                                                <td class="hidden-xs">@if($item->parrent_id->result)
                                                        {!! $item->parrent_id->result->name !!}
                                                    @else

                                                    @endif
                                                </td>
                                                <td class="text-center">
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
                                                    <div class="btn-group">
                                                        <a href="{!! route('admin.cate.edit',['id'=>$item->id]) !!}"
                                                           class="btn btn-xs btn-info">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </a>
                                                        <a href="{!! route('admin.cate.delete',['id'=>$item->id]) !!}"
                                                           class="btn btn-xs btn-danger"
                                                           onclick="return confirm('Are you sure to delete this category?')">

                                                            <i class="ace-icon fa fa-trash-o bigger-120"
                                                            ></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h3>There no category here, wait...</h3>
                                    @endif

                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="paginate">
                                        <h5 class="pull-left">Total Pages : {{$list->lastPage()}}</h5>
                                        <ul class="pagination pull-right no-margin">
                                            <li class="">
                                                <a href="{{$list->url(1)}}">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="prev {{($list->currentPage() == 1) ? 'disabled' : ''}}">
                                                <a href="{{$list->url($list->currentPage() - 1)}}">Prev</a>
                                            </li>
                                            @for($i=1; $i<=$list->lastPage();$i++ )
                                                <li class="{{ ($list->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{$list->url($i)}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                            <li class="next {{($list->currentPage() == $list->lastPage()) ? 'disabled' : ''}}">
                                                <a href="{{$list->url($list->currentPage() + 1)}}">Next</a>
                                            </li>
                                            <li class="">
                                                <a href="{{$list->url($list->lastPage())}}">
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