@extends('user.master')
@section('title','Single')
@section('content')
    <div class="main">
        <div class="content_top">
            <div class="container">
                @include('user.block.sidebar')
                <div class="col-md-9 single_right">
                    <div class="single_top">
                        <div class="single_grid">
                            <div class="grid images_3_of_2">
                                <ul id="etalage">
                                    <li>
                                        <a href="optionallink.html">
                                            <img class="etalage_thumb_image"
                                                 src="{{asset('admin/images/products/').'/'.$thisProduct->image}}"
                                                 class="img-responsive"/>
                                            <img class="etalage_source_image"
                                                 src="{{asset('admin/images/products/').'/'.$thisProduct->image}}"
                                                 class="img-responsive" title=""/>
                                        </a>
                                    </li>
                                    @if($thisProduct->listimg)
                                        @foreach($thisProduct->listimg as $item)
                                            <li>
                                                <img class="etalage_thumb_image"
                                                     src="{{asset('admin/images/product_list').'/'.$item}}"
                                                     class="img-responsive"/>
                                                <img class="etalage_source_image"
                                                     src="{{asset('admin/images/product_list').'/'.$item}}"
                                                     class="img-responsive" title=""/>
                                            </li>
                                        @endforeach
                                    @else

                                    @endif

                                </ul>
                                <div class="clearfix"></div>
                            </div>
                            <div class="desc1 span_3_of_2">
                                <h1> {!! $thisProduct->name !!}</h1>
                                <p class="availability">Availability: <span class="color">@if($thisProduct->count) In
                                        stock @else Out of stock @endif</span></p>
                                <div class="price_single">
                                    <span class="reducedfrom">@if($thisProduct->discount)${!! $thisProduct->price + (($thisProduct->price*$thisProduct->discount)/100) !!}@else @endif</span>
                                    <span class="actual">${!! $thisProduct->price !!}</span>
                                </div>
                                <h2 class="quick">Quick Overview:</h2>
                                <p class="quick_desc">{!! $thisProduct->shorttext !!}</p>
                                <div class="wish-list">
                                    <ul>
                                        <li class="wish"><a href="#">Add to Wishlist</a></li>
                                        <li class="compare"><a href="#">Add to Compare</a></li>
                                    </ul>
                                </div>
                                <ul class="size">
                                    <h3>Length</h3>
                                    <li><a href="#">32</a></li>
                                    <li><a href="#">34</a></li>
                                </ul>
                                <div class="quantity_box">
                                    <ul class="product-qty">
                                        <span>Quantity:</span>
                                        <input type="number" name="quantity" value="1" style="width: 106px;">
                                    </ul>
                                    <ul class="single_social">
                                        <li><a href="#"><i class="fb1"> </i> </a></li>
                                        <li><a href="#"><i class="tw1"> </i> </a></li>
                                        <li><a href="#"><i class="g1"> </i> </a></li>
                                        <li><a href="#"><i class="linked"> </i> </a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <a href="reservation.html" title="Online Reservation"
                                   class="btn bt1 btn-primary btn-normal btn-inline " target="_self">Buy</a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="sap_tabs">
                        <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
                            <ul class="resp-tabs-list">
                                <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Product Description</span>
                                </li>
                                <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Additional Information</span>
                                </li>
                                <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Reviews</span>
                                </li>
                                <div class="clear"></div>
                            </ul>
                            <div class="resp-tabs-container">
                                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
                                    <div class="facts">
                                        <ul class="tab_list">
                                            <li>{!! $thisProduct->desciption !!}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
                                    <div class="facts">
                                        <ul class="tab_list">
                                            <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber
                                                    tempor cum soluta nobis eleifend option congue nihil imperdiet
                                                    doming id quod mazim placerat facer possim assum. Typi non habent
                                                    claritatem insitam; est usus legentis in iis qui facit eorum
                                                    claritatem. Investigatione</a></li>
                                            <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum
                                                    claritatem. Investigationes demonstraverunt lectores legere me lius
                                                    quod ii legunt saepius. Claritas est etiam processus dynamicus, qui
                                                    sequitur mutationem consuetudium lectorum. Mirum est notare quam
                                                    littera gothica</a></li>
                                            <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus
                                                    parum claram, anteposuerit litterarum formas humanitatis per seacula
                                                    quarta decima et quinta decima. Eodem modo typi, qui nunc nobis
                                                    videntur parum clari, fiant sollemnes in futurum.</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
                                    <ul class="tab_list">
                                        <li><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed
                                                diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat
                                                volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                                ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo
                                                consequat</a></li>
                                        <li><a href="#">augue duis dolore te feugait nulla facilisi. Nam liber tempor
                                                cum soluta nobis eleifend option congue nihil imperdiet doming id quod
                                                mazim placerat facer possim assum. Typi non habent claritatem insitam;
                                                est usus legentis in iis qui facit eorum claritatem. Investigatione</a>
                                        </li>
                                        <li><a href="#">claritatem insitam; est usus legentis in iis qui facit eorum
                                                claritatem. Investigationes demonstraverunt lectores leg</a></li>
                                        <li><a href="#">Mirum est notare quam littera gothica, quam nunc putamus parum
                                                claram, anteposuerit litterarum formas humanitatis per seacula quarta
                                                decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                                clari, fiant sollemnes in futurum.</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="single_head">Related Products</h3>
                    <div class="related_products">
                        @if($relatedProducts)
                            @foreach($relatedProducts as $item_Relate)
                                <div class="col-md-4 top_grid1-box1" style="margin-bottom: 19px">
                                    <a href="{!! route('productDetail',['id'=>$item_Relate->id]) !!}">
                                        <div class="grid_1" style="height: 16em;">
                                            <div class="b-animate-go  thickbox" style="height: 10em">
                                                <a href="{!! route('productDetail',['id'=>$item_Relate->id]) !!}">
                                                    <img src="{!! asset('admin/images/products/').'/'.$item_Relate->image !!}"
                                                         class="img" alt="" style="max-height:11em; width: 15.6em "/>
                                                </a>
                                            </div>
                                            <div class="grid_2">
                                                <a href="{!! route('productDetail',['id'=>$item_Relate->id]) !!}" style="display: block; margin-top: 10px">
                                                    <h4 class="text-center">{!! $item_Relate->name !!}</h4>
                                                </a>
                                                <ul class="grid_2-bottom">
                                                    <li class="grid_2-left">
                                                        <p>{!! $item_Relate->price !!}<span style="font-size: 15px!important;">$</span>
                                                            @if($item_Relate->discount)
                                                                <small style="color: red">-{!! $item_Relate->discount !!}%</small>
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
                        @endif
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection