@extends('admin.master')
@section('title','Transaction')
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
                        <a href="{!! route('transaction.list') !!}">Transaction</a>

                    </li>
                    <li class="active"><a href="{!! route('transaction.list') !!}">List</a>

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
                        <a href="{!! route('transaction.list') !!}">Transaction</a>

                        <small>
                            <a href="{!! route('transaction.list') !!}">list</a>
                        </small>


                        <small>
                            <a href="{!! route('transaction.list') !!}">Total: <span  style="color: red;">{{count($transactionList)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('transaction.list') !!}">Unpaid: <span  style="color: red;">{{count($transactionList)}}</span></a>
                        </small>
                        <small>
                            <a href="{!! route('transaction.list') !!}">Paid: <span  style="color: red;">{{count($transactionList)}}</span></a>
                        </small>
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
                                        <th class="text-center hidden-xs">Email</th>
                                        <th class="text-center">Amount ($)</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center hidden-xs">
                                            <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                            Message
                                        </th>
                                        <th class="hidden-480 text-center">Date</th>
                                        <th class="hidden-480 text-center">Status</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @if( isset($transactionList) && $transactionList )
                                        @foreach($transactionList as $transaction)
                                            <tr class="text-center">
                                                <td class="center hidden-xs">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" class="ace"/>
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>

                                                <td class="center">
                                                    <div class="action-buttons">
                                                        @if($transaction->user_id)
                                                            <img src="{!! asset('admin/images/avatars').'/'.$transaction->user_id !!}"
                                                                 alt="" class="img-responsive" width="100em">
                                                        @else
                                                            <img src="{!! asset('admin/images/products/').'/user.jpg'!!}"
                                                                 alt="" class="img-responsive" width="100em">
                                                        @endif

                                                    </div>
                                                </td>

                                                <td class="text-capitalize" style="font-weight: bold">
                                                    <a href="#">{{$transaction->username}}</a>
                                                </td>
                                                <td class="hidden-xs">
                                                    <a href="#">{!! $transaction->useremail !!}</a>
                                                </td>
                                                <td style="color: #a94442">{!! $transaction->amount !!}</td>
                                                <td style="color: #a94442">{!! $transaction->userphone !!}</td>
                                                <td style="color: #00BE67">{{ $transaction->useraddress }}</td>
                                                <td class="hidden-xs">{!! substr($transaction->message,0,50) !!}...</td>
                                                <td class="hidden-xs"
                                                    style="color: #1B6AAA">{!! $transaction->created_at !!}</td>
                                                @if($transaction->status == 1)
                                                    <td class="hidden-480 text-center">
                                                        <a href="{!! route('transaction.update',['id'=>$transaction->id]) !!}">
                                                            <span class="label label-sm label-success">Paid</span>
                                                        </a>
                                                    </td>
                                                @elseif($transaction->status == 0)
                                                    <td class="hidden-480 text-center">
                                                        <a href="{!! route('transaction.update',['id'=>$transaction->id]) !!}">
                                                            <span class="label label-sm label-warning">Unpaid</span>
                                                        </a>
                                                    </td>
                                                @else
                                                    <td class="hidden-480 text-center">
                                                        <a href="">
                                                            <span class="label label-sm label-danger">Empty</span>
                                                        </a>
                                                    </td>
                                                @endif


                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <a class="btn btn-xs btn-warning"
                                                           href="{{route('order.list',['id'=>$transaction->id])}}">
                                                            <i class="ace-icon fa fa-search-plus  bigger-120"></i>
                                                        </a>
                                                        <a class="btn btn-xs btn-danger"
                                                           href="{!! route('transaction.delete',['id'=>$transaction->id]) !!}"
                                                           onclick="return confirm('Are you sure, to delete this transaction?')">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h3>There's no Transaction...</h3>
                                    @endif
                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                                <br>
                                <div class="col-md-12">
                                    <div class="paginate">
                                        <h5 class="pull-left">Total Pages : {{$transactionList->lastPage()}}</h5>
                                        <ul class="pagination pull-right no-margin">
                                            <li class="">
                                                <a href="{{$transactionList->url(1)}}">
                                                    <i class="ace-icon fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                            <li class="prev {{($transactionList->currentPage() == 1) ? 'disabled' : ''}}">
                                                <a href="{{$transactionList->url($transactionList->currentPage() - 1)}}">Prev</a>
                                            </li>
                                            @for($i=1; $i<=$transactionList->lastPage();$i++ )
                                                <li class="{{ ($transactionList->currentPage() == $i) ? 'active' : '' }}">
                                                    <a href="{{$transactionList->url($i)}}">{{$i}}</a>
                                                </li>
                                            @endfor
                                            <li class="next {{($transactionList->currentPage() == $transactionList->lastPage()) ? 'disabled' : ''}}">
                                                <a href="{{$transactionList->url($transactionList->currentPage() + 1)}}">Next</a>
                                            </li>
                                            <li class="">
                                                <a href="{{$transactionList->url($transactionList->lastPage())}}">
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