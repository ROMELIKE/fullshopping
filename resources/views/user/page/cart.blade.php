@extends('user.master')
@section('title','Cart')
@section('content')
    <div class="about">
        <div class="container">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><span class="glyphicon glyphicon-shopping-cart"></span> Cart's info</h5>
                            </div>
                            <div class="col-xs-6">
                                <a href="" type="button" class="btn btn-primary btn-sm btn-block" onclick="window.history.go(-1)">
                                    <span class="glyphicon glyphicon-share-alt"></span> Keep Shopping
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">

                    {{--<div class="row">--}}
                    {{--<div class="col-md-12 col-xs-12"><h4>Chưa có sản phẩm nào trong giỏ hàng</h4></div>--}}
                    {{--</div>--}}
                        <form action="" method="POST">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="row">
                                <div class="col-xs-2"><img class="img-responsive" src="">
                                </div>
                                <div class="col-xs-4">
                                    <h4 class="product-name"><strong>sản phẩm 1</strong></h4><h4><small>chi tiết cho sản phẩm 1</small></h4>
                                </div>
                                <div class="col-xs-6">
                                    <div class="col-xs-6 text-right">
                                        <h4><strong style="color:#f00"><span class="text-muted">10000$  </span></strong>x</h4>
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="number" min="1" class="form-control" id="" name="qty" value="2">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="submit" value="refresh" class="btn">
                                    </div>
                                    <div class="col-xs-2">
                                        <a href="" type="button" class="btn btn-danger btn-block delete">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </form>
                    <div class="row">
                        <div class="col-xs-6">
                            <input  class="btn" type="submit" value="Update your cart">
                        </div>
                        <div class="col-xs-6">
                            <a href="" type="button" class="btn btn-danger" style="float: right">cancel all
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 class="text-right">Total : <strong style="color:#f00" name="total">1000$</strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <a href="" type="button" class="btn btn-success btn-block">CheckOut</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
