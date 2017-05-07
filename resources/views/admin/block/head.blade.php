<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>@yield('title')</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/font-awesome/4.5.0/css/font-awesome.min.css')}}" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="{{asset('admin/css/fonts.googleapis.com.css')}}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{asset('admin/css/ace.min.css')}}" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="{{asset('admin/css/jquery-ui.custom.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/ace-part2.min.css')}}" class="ace-main-stylesheet" />

    <link rel="stylesheet" href="{{asset('admin/css/ace-skins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/ace-rtl.min.css')}}" />

    <link rel="stylesheet" href="{{asset('admin/css/ace-ie.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}" />

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{asset('admin/js/ace-extra.min.js')}}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
    <script src="{{asset('admin/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('admin/js/respond.min.js')}}"></script>

    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{asset('admin/js/jquery.mobile.custom.min.js')}}'>"+"<"+"/script>");
    </script>
    <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>

    <!-- page specific plugin scripts -->
    <script src="{{asset('admin/js/jquery.nestable.min.js')}}"></script>

    <!-- ace scripts -->
    <script src="{{asset('admin/js/ace-elements.min.js')}}"></script>
    <script src="{{asset('admin/js/ace.min.js')}}"></script>
    <script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($){

            $('.dd').nestable();

            $('.dd-handle a').on('mousedown', function(e){
                e.stopPropagation();
            });

            $('[data-rel="tooltip"]').tooltip();

        });
    </script>
</head>