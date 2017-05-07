@extends('user.master')
@section('title','discount')
@section('content')
    {{--@include('user.block.slide')--}}
    <div class="main">
        <div class="content_top">
            <div class="container">
                @include('user.block.sidebar')
                <div class="col-md-9 content_right">
                    <!-- .......................................................... -->
                    <h4 class="head"><span class="m_2" style="color: red">Discount</span> Product</h4>
                    <div class="top_grid2">
                        @if(isset($listDiscount ) && $listDiscount )
                            @foreach($listDiscount as $product)
                                <div class="col-md-4 top_grid1-box1" style="margin-bottom: 19px">
                                    <a href="{!! route('productDetail',['id'=>$product->id]) !!}">
                                        <div class="grid_1" style="height:16em;">
                                            <div class="b-animate-go thickbox" style="height: 10em">
                                                <a href="{!! route('productDetail',['id'=>$product->id]) !!}">
                                                    <img src="{!! asset('admin/images/products/').'/'.$product->image !!}"
                                                         class="img" alt="" style="max-height:11em; width: 15.6em "/>
                                                </a>
                                            </div>
                                            <div class="grid_2">
                                                <a href="" style="display: block; margin-top: 10px">
                                                    <h4 class="text-center">{!! $product->name !!}</h4>
                                                </a>
                                                <ul class="grid_2-bottom">
                                                    <li class="grid_2-left">
                                                        <p>{!! $product->price !!}<span
                                                                    style="font-size: 15px!important;">$</span>
                                                            @if($product->discount)
                                                                <small style="color: red">-{!! $product->discount !!}%
                                                                </small>
                                                            @else
                                                            @endif
                                                        </p>
                                                    </li>
                                                    <li class="grid_2-right">
                                                        <a href="{{route('getshopping',['id'=>$product->id])}}">
                                                            <div class="btn btn-primary btn-normal btn-inline "
                                                                 target="_self"
                                                                 title="Mua">add
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <div class="clearfix"></div>
                                                </ul>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            @endforeach
                                <div class="clearfix"></div>
                                <div class="paginate">
                                    <h4 class="pull-left">Total Pages : {{$listDiscount->lastPage()}}</h4>
                                    <ul class="pagination pull-right no-margin">
                                        <li class="">
                                            <a href="{{$listDiscount->url(1)}}">
                                                <i class="ace-icon fa fa-angle-double-left"></i>
                                            </a>
                                        </li>
                                        <li class="prev {{($listDiscount->currentPage() == 1) ? 'disabled' : ''}}">
                                            <a href="{{$listDiscount->url($listDiscount->currentPage() - 1)}}">Prev</a>
                                        </li>
                                        @for($i=1; $i<=$listDiscount->lastPage();$i++ )
                                            <li class="{{ ($listDiscount->currentPage() == $i) ? 'active' : '' }}">
                                                <a href="{{$listDiscount->url($i)}}">{{$i}}</a>
                                            </li>
                                        @endfor
                                        <li class="next {{($listDiscount->currentPage() == $listDiscount->lastPage()) ? 'disabled' : ''}}">
                                            <a href="{{$listDiscount->url($listDiscount->currentPage() + 1)}}">Next</a>
                                        </li>
                                        <li class="">
                                            <a href="{{$listDiscount->url($listDiscount->lastPage())}}">
                                                <i class="ace-icon fa fa-angle-double-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                             @else
                            <h3>There no lastest products, we will update later...</h3>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <!-- .......................................................... -->
                </div>
            </div>
        </div>
    </div>

@endsection