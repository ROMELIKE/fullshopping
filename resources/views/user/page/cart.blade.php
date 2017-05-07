@extends('user.master')
@section('title','Cart')
@section('content')
    <div class="about">
        <div class="container">
            <div class="panel panel-info" style="border-radius: 0px;">
                <div class="panel-heading">
                    <div class="panel-title">
                        <div class="row">
                            <div class="col-xs-6">
                                <h5><i class="fa fa-shopping-cart"></i> Cart's info</h5>
                            </div>
                            <div class="col-xs-6">
                                <a href="" type="button" class="btn btn-primary btn-sm btn-block"
                                   onclick="window.history.go(-1)">
                                    <i class="fa fa-shopping-bag"></i>&nbsp &nbsp (Keep Shopping)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if(isset($content) && count($content))
                        @foreach($content as $product)
                            <form action="{{route('updatecart',['id'=>$product->rowId])}}" method="POST">
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <div class="row">
                                    <div class="col-xs-2"><img class="img-responsive thumbnail"
                                                               src="{{asset('admin/images/products/').'/'.$product->options->image}}">
                                    </div>
                                    <div class="col-xs-4">
                                        <h4 class="product-name"><strong>{{$product->name}}</strong></h4>
                                        <h4>
                                            <small>{{$product->options->desciption}}</small>
                                        </h4>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="col-xs-4 text-right">
                                            <h4><strong style="color:#f00"><span class="text-muted">{{$product->price}}
                                                        ($)  </span></strong>x
                                            </h4>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="number" min="1" class="form-control" name="qty"
                                                   value="{{$product->qty}}"
                                                   style="border-radius: 0px;">
                                        </div>
                                        <div class="col-xs-2">

                                            <button type="submit" class="btn btn-primary"
                                                   style="border-radius: 0px;">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="col-xs-2">
                                            <a href="{{route('deletecart',['rowid'=>$product->rowId])}}" type="button"
                                               class="btn btn-block delete"
                                               style="border: 0px;color: red;;text-shadow: none;border-radius: 0px;font-size: 18px">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </form>
                            <hr>
                        @endforeach

                        <div class="row">
                            <div class="col-xs-6">
                                <input class="btn" type="submit" value="Update your cart" style="border-radius: 0px;">
                            </div>
                            <div class="col-xs-6">
                                <a href="{{route('deleteall')}}" type="button" class="btn btn-default"
                                   style="color: #2e6da4;text-shadow: none;float: right;border-radius: 0px;">Cancel all
                                      (<i class="fa fa-trash"></i>)
                                </a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                </div>

                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 class="text-right">Total : <strong style="color:#f00" name="total">{{$total}}$</strong>
                            </h4>
                        </div>
                        <div class="col-xs-3">
                            <a href="{{route('getcheckout')}}" type="button" class="btn btn-primary btn-block"
                               style="color: #fff;text-shadow: none;border-radius: 0px;"><i class="fa fa-money" aria-hidden="true"></i> &nbsp CheckOut</a>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-12 col-xs-12"><h4>There's no product, let shopping...</h4></div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
