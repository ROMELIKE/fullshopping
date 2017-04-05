

@extends('user.master')
@section('title','result for search')
@section('content')
    <div class="about">
        <div class="container">
            <h4 class="head">Tìm kiềm sản phẩm <span class="m_2">máy lọc nước</span></h4>
            <div class="top_grid2">
                <div class="col-md-4 top_grid1-box1">
                    <div class="grid_1 thumbnail">
                        <a href="">
                            <div class="b-link-stroke b-animate-go thickbox">
                                <div class="b-bottom-line"></div>
                                <div class="b-top-line"></div>
                                <img src="{{asset('user/images/p1.jpg')}}" class="img-responsive" alt="">
                            </div>
                        </a>
                        <div class="grid_2">
                            <p>lêu lêu</p>
                            <ul class="grid_2-bottom">
                                <li class="grid_2-left">
                                    <p>250000 K <small>25000</small></p>
                                </li>
                                <li class="grid_2-right">
                                    <a href=""><div class="btn btn-primary btn-normal btn-inline " target="_self" title="Mua">Mua</div></a>
                                </li>
                                <div class="clearfix"></div>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class='clearfix'></div>

            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
