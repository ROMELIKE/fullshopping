@extends('admin.master')
@section('title','list product')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{!! route('admin.dashboard') !!}">Home</a>

                    </li>

                    <li>
                        <a href="{!! route('admin.product.list') !!}">Product</a>

                    </li>
                    <li class="active"><a href="{!! route('admin.product.list') !!}">List</a>

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
                        <a href="{!! route('admin.product.list') !!}">Product</a>

                        <small>
                            <a href="{!! route('admin.product.list') !!}">list</a>
                        </small>


                        <small>
                            <a href="{!! route('admin.product.list') !!}">Total: <span  style="color: red;">{{count($productList)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Waiting: <span  style="color: red;">{{count($productList)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('admin.product.list') !!}">Censored: <span  style="color: red;">{{count($productList)}}</span></a>
                        </small>

                        <a href="{!! route('admin.product.add') !!}" class="btn btn-xs btn-success pull-right btn-lg">
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
                                        <th class="detail-col text-center">Thumbnail</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center hidden-xs">Category</th>

                                        <th class="text-center">Price</th>
                                        <th class="text-center">Discount</th>
                                        <th class="hidden-xs text-center">Count</th>

                                        <th class="text-center hidden-xs">
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Description
                                        </th>
                                        <th class="hidden-480 text-center">Status</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if( isset($productList) && $productList )
                                        @foreach($productList as $item)
                                            <tr class="text-center">
                                                <td class="center hidden-xs">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>

                                                <td class="center">
                                                    <div class="action-buttons">
                                                        @if($item->image)
                                                            <img src="{!! asset('admin/images/products').'/'.$item->image !!}"
                                                                 alt="" class="img-responsive" width="100em">
                                                        @else
                                                            <img src="{!! asset('admin/images/products/ ').'/'.$item->image !!}"
                                                                 alt="" class="img-responsive" width="100em">
                                                        @endif

                                                    </div>
                                                </td>

                                                <td class="text-capitalize" style="font-weight: bold">
                                                    <a href="#">{{$item->name}}</a>
                                                </td>
                                                <td class="hidden-xs">
                                                    <a href="#">{!! $item->category !!}</a>
                                                </td>
                                                <td style="color: #a94442">{!! $item->price !!}</td>
                                                <td style="color: #00BE67">@if($item->discount) {!! $item->discount !!}
                                                    %@else 0% @endif</td>
                                                <td class="hidden-xs" style="color: #1B6AAA">{!! $item->count !!}</td>
                                                <td class="hidden-xs">{!! substr($item->desciption,0,50) !!}...</td>
                                                @if($item->status == 1)
                                                    <td class="hidden-480 text-center">
                                                        <span class="label label-sm label-success">Censored</span>
                                                    </td>
                                                @else
                                                    <td class="hidden-480 text-center">
                                                        <span class="label label-sm label-warning">Waiting</span>
                                                    </td>
                                                @endif


                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-warning"
                                                           href="{!! route('productDetail',['id'=>$item->id]) !!}">
                                                            <i class="ace-icon fa fa-search-plus  bigger-120"></i>
                                                        </a>
                                                        <a class="btn btn-xs btn-info"
                                                           href="{!! route('admin.product.edit',['id'=>$item->id]) !!}">
                                                            <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                        </a>

                                                        <a class="btn btn-xs btn-danger"
                                                           href="{!! route('admin.product.delete',['id'=>$item->id]) !!}"
                                                           onclick="return confirm('Are you sure to delete this product?')">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h3>There no products here, wait...</h3>
                                    @endif

                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="paginate">
                                        <h5 class="pull-left">Total Pages : {{$productList->lastPage()}}</h5>
                                        <ul class="pagination pull-right no-margin">
                                            <li class="">
                                                <a href="{{$productList->url(1)}}">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="prev {{($productList->currentPage() == 1) ? 'disabled' : ''}}">
                                                <a href="{{$productList->url($productList->currentPage() - 1)}}">Prev</a>
                                            </li>
                                            @for($i=1; $i<=$productList->lastPage();$i++ )
                                                <li class="{{ ($productList->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{$productList->url($i)}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                            <li class="next {{($productList->currentPage() == $productList->lastPage()) ? 'disabled' : ''}}">
                                                <a href="{{$productList->url($productList->currentPage() + 1)}}">Next</a>
                                            </li>
                                            <li class="">
                                                <a href="{{$productList->url($productList->lastPage())}}">
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