<div class="col-md-3 sidebar_box">
    <div class="sidebar">
        <div class="menu_box">
            <h3 class="menu_head">Danh Mục Sản Phẩm</h3>
            <ul class="menu">
                <li class="item1"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/> Man</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item2"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Women</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item3"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Fashion 2015</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails</a></li>
                    </ul>
                </li>
                <li class="item4"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Kids</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item5"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Jeans</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item6"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Tshirt</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item7"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Top Fashion</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item8"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Summer Collection</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
                <li class="item9"><a href="#"><img class="arrow-img" src="{{asset('user/images/f_menu.png')}}" alt=""/>Special Offer</a>
                    <ul class="cute">
                        <li class="subitem1"><a href="#">Cute Kittens </a></li>
                        <li class="subitem2"><a href="#">Strange Stuff </a></li>
                        <li class="subitem3"><a href="#">Automatic Fails </a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--initiate accordion-->
        <script type="text/javascript">
            $(function() {
                var menu_ul = $('.menu > li > ul'),
                        menu_a  = $('.menu > li > a');
                menu_ul.hide();
                menu_a.click(function(e) {
                    e.preventDefault();
                    if(!$(this).hasClass('active')) {
                        menu_a.removeClass('active');
                        menu_ul.filter(':visible').slideUp('normal');
                        $(this).addClass('active').next().stop(true,true).slideDown('normal');
                    } else {
                        $(this).removeClass('active');
                        $(this).next().stop(true,true).slideUp('normal');
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
        <h4>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae.</h4>
        <ul class="user">
            <i class="user_icon"></i>
            <li class="user_desc"><a href="#"><p>John Doe, Company Info</p></a></li>
            <div class="clearfix"> </div>
        </ul>
    </div>
</div>