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
                        <a href="#">Order</a>
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
                                        <th class="text-center">Thumbnail</th>
                                        <th class="text-center hidden-xs">Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Amount</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if( isset($listOrder) && $listOrder )
                                        @foreach($listOrder as $order)
                                            <tr class="text-center">
                                                <td class="center hidden-xs">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <img src="{{asset('admin/images/products').'/'.$order->image}}" alt="" class="img-responsive thumbnail" width="100em">
                                                </td>
                                                <td>
                                                    <a href="#">{{$order->name}}</a>
                                                </td>
                                                <td class="hidden-xs">{{$order->quantity}}</td>
                                                <td class="hidden-xs">{{$order->amount}}</td>
                                                <td class="hidden-xs">{{$order->created_at}}</td>
                                                <td class="text-center">
                                                    @if($order->status)
                                                        <a href="{{route('order.update',['id'=>$order->id])}}">
                                                            <span class="label label-sm label-success">{!! 'Delivered' !!}</span>
                                                        </a>
                                                    @else
                                                        <a href="{{route('order.update',['id'=>$order->id])}}">
                                                            <span class="label label-sm label-warning">{!! 'Undelivered' !!}</span>
                                                        </a>
                                                    @endif

                                                </td>

                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a href="{!! route('order.delete',['id'=>$order->id]) !!}"
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
                                        <h3>There's no Order in here...</h3>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="paginate">
                                        <h5 class="pull-left">Total Pages : {{$listOrder->lastPage()}}</h5>
                                        <ul class="pagination pull-right no-margin">
                                            <li class="">
                                                <a href="{{$listOrder->url(1)}}">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="prev {{($listOrder->currentPage() == 1) ? 'disabled' : ''}}">
                                                <a href="{{$listOrder->url($listOrder->currentPage() - 1)}}">Prev</a>
                                            </li>
                                            @for($i=1; $i<=$listOrder->lastPage();$i++ )
                                                <li class="{{ ($listOrder->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{$listOrder->url($i)}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                            <li class="next {{($listOrder->currentPage() == $listOrder->lastPage()) ? 'disabled' : ''}}">
                                                <a href="{{$listOrder->url($listOrder->currentPage() + 1)}}">Next</a>
                                            </li>
                                            <li class="">
                                                <a href="{{$listOrder->url($listOrder->lastPage())}}">
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