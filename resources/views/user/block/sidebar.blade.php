<div class="col-md-3 sidebar_box">
    <div class="sidebar">
        <div class="menu_box">
            <h3 class="menu_head">Categories</h3>
            <ul class="menu">
                @if(isset($menuLevel1) && $menuLevel1)
                    @foreach($menuLevel1 as $item)
                        @if(!$item->children)
                            <li class="item1">
                                <a href="{{route('usergetcategory',['id'=>$item->id])}}"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}"
                                                                                              alt=""/>{!! $item->name !!}</a>
                            </li>
                        @else
                            <li class="item1"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}"
                                                               alt=""/>{!! $item->name !!}</a>
                                @if($item->children)
                                    <ul class="cute">
                                        @foreach($item->children as $itemChild)
                                            <li class="subitem1">
                                                <a href="{!! route('usergetcategory',['id'=>$itemChild->id]) !!}">{!! $itemChild->name !!}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                @endif
                            </li>
                        @endif
                    @endforeach
                @endif

            </ul>
        </div>
        <!--initiate accordion-->
        <script type="text/javascript">
            $(function () {
                var menu_ul = $('.menu > li > ul'),
                        menu_a = $('.menu > li > a');
                menu_ul.hide();
                menu_a.click(function (e) {
                    e.preventDefault();
                    if (!$(this).hasClass('active')) {
                        menu_a.removeClass('active');
                        menu_ul.filter(':visible').slideUp('normal');
                        $(this).addClass('active').next().stop(true, true).slideDown('normal');
                    } else {
                        $(this).removeClass('active');
                        $(this).next().stop(true, true).slideUp('normal');
                    }
                });

            });
        </script>
    </div>
    <div class="delivery">
        <img src="{{asset('user/images/delivery.jpg')}}" class="img-responsive" alt=""/>
        <h3>Delivering</h3>
        <h4>World Wide</h4>
    </div>
    <div class="">
    </div>
    <div class="clients">
        <h3>Our Happy Clients</h3>
        <h4>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
            aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</h4>
        <ul class="user">
            <i class="user_icon"></i>
            <li class="user_desc"><a href="#"><p>John Doe, Company Info</p></a></li>
            <div class="clearfix"></div>
        </ul>
    </div>
</div>