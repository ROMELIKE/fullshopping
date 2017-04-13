@extends('user.master')
@section('title','GIFTS SHOP')
@section('content')
    @include('user.block.slide')
    <div class="main">
        <div class="content_top">
            <div class="container">
                @include('user.block.sidebar')
                <div class="col-md-9 content_right">
                    <!-- .......................................................... -->
                    <h4 class="head"><span class="m_2">Lastest</span> product</h4>
                    <div class="top_grid2">
                        @foreach($newProducts as $item_new)
                            <div class="col-md-4 top_grid1-box1" style="margin-bottom: 19px">
                                <a href="{!! route('productDetail',['id'=>$item_new->id]) !!}">
                                    <div class="grid_1" style="height: 16em;">
                                        <div class="b-animate-go  thickbox" style="height: 10em">
                                            <a href="{!! route('productDetail',['id'=>$item_new->id]) !!}">
                                                <img src="{!! asset('admin/images/products/').'/'.$item_new->image !!}"
                                                     class="img" alt="" style="max-height:11em; width: 15.6em "/>
                                            </a>
                                        </div>
                                        <div class="grid_2">
                                            <a href="{!! route('productDetail',['id'=>$item_new->id]) !!}" style="display: block; margin-top: 10px">
                                                <h4 class="text-center">{!! $item_new->name !!}</h4>
                                            </a>
                                            <ul class="grid_2-bottom">
                                                <li class="grid_2-left">
                                                    <p>{!! $item_new->price !!}<span style="font-size: 15px!important;">$</span>
                                                        @if($item_new->discount)
                                                            <small style="color: red">-{!! $item_new->discount !!}%</small>
                                                        @else
                                                        @endif
                                                    </p>
                                                </li>
                                                <li class="grid_2-right">
                                                    <a href="">
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
                    </div>
                    <br>
                    <div class="load-more text-center">
                        <a href="">
                            <div class="btn btn-primary btn-normal btn-inline "
                                 target="_self"
                                 title="Mua">See more
                            </div>
                        </a>
                    </div>

                    <!-- .......................................................... -->
                    <!-- .......................................................... -->
                    <h4 class="head"><span class="m_2">Discount</span> product</h4>
                    <div class="top_grid2">
                        @foreach($newDiscountProducts as $item_discount)
                            <div class="col-md-4 top_grid1-box1" style="margin-bottom: 19px">
                                <a href="{!! route('productDetail',['id'=>$item_discount->id]) !!}">
                                <div class="grid_1"style="height:16em;">
                                        <div class="b-animate-go thickbox" style="height: 10em">
                                            <a href="{!! route('productDetail',['id'=>$item_discount->id]) !!}">
                                            <img src="{!! asset('admin/images/products/').'/'.$item_discount->image !!}"
                                                     class="img" alt="" style="max-height:11em; width: 15.6em "/>
                                            </a>
                                        </div>
                                        <div class="grid_2">
                                            <a href="" style="display: block; margin-top: 10px">
                                                <h4 class="text-center">{!! $item_discount->name !!}</h4>
                                            </a>
                                            <ul class="grid_2-bottom">
                                                <li class="grid_2-left">
                                                    <p>{!! $item_discount->price !!}<span style="font-size: 15px!important;">$</span>
                                                        @if($item_discount->discount)
                                                            <small style="color: red">-{!! $item_discount->discount !!}%</small>
                                                        @else
                                                        @endif
                                                    </p>
                                                </li>
                                                <li class="grid_2-right">
                                                    <a href="{!! route('productDetail',['id'=>$item_discount->id]) !!}">
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
                    </div>
                    <br>
                    <div class="load-more text-center">
                        <a href="">
                            <div class="btn btn-primary btn-normal btn-inline "
                                 target="_self"
                                 title="Mua">See more
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
