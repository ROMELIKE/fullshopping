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
                    <h4 class="head"><span class="m_2">Lastest</span> Product</h4>
                    <div class="top_grid2">
                        <div class="col-md-4 top_grid1-box1">
                            <a href="">
                                <div class="grid_1">
                                    <div class="b-link-stroke b-animate-go  thickbox">
                                        <img src=""
                                             class="img-responsive" alt=""/></div>
                                    <div class="grid_2">
                                        <a href="">
                                            <p>sản phẩm 1</p>
                                        </a>
                                        <ul class="grid_2-bottom">
                                            <li class="grid_2-left">
                                                <p>20000$
                                                    <small>-20%</small>
                                                </p>
                                            </li>
                                            <li class="grid_2-right">
                                                <div class="btn btn-primary btn-normal btn-inline " target="_self"
                                                     title="Mua">add
                                                </div>
                                            </li>
                                            <div class="clearfix"></div>
                                        </ul>
                                    </div>
                                </div>
                            </a></div>
                        <div class="clearfix"></div>
                    </div>
                    <!-- .......................................................... -->
                </div>
            </div>
        </div>
    </div>

@endsection