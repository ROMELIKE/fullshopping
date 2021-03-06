@extends('admin.master')
@section('title','media')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Gallery</li>
                </ul><!-- /.breadcrumb -->
                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div>
                            <form action="./dummy.html" class="dropzone well" id="dropzone">
                                <div class="fallback">
                                    <input name="file" type="file" multiple="" />
                                </div>
                            </form>
                        </div>

                        <div id="preview-template" class="hide">
                            <div class="dz-preview dz-file-preview">
                                <div class="dz-image">
                                    <img data-dz-thumbnail="" />
                                </div>

                                <div class="dz-details">
                                    <div class="dz-size">
                                        <span data-dz-size=""></span>
                                    </div>

                                    <div class="dz-filename">
                                        <span data-dz-name=""></span>
                                    </div>
                                </div>

                                <div class="dz-progress">
                                    <span class="dz-upload" data-dz-uploadprogress=""></span>
                                </div>

                                <div class="dz-error-message">
                                    <span data-dz-errormessage=""></span>
                                </div>

                                <div class="dz-success-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-check fa-stack-1x fa-inverse green"></i>
											</span>
                                </div>

                                <div class="dz-error-mark">
											<span class="fa-stack fa-lg bigger-150">
												<i class="fa fa-circle fa-stack-2x white"></i>

												<i class="fa fa-remove fa-stack-1x fa-inverse red"></i>
											</span>
                                </div>
                            </div>
                        </div><!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->


            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div>
                            <ul class="ace-thumbnails clearfix">
                                <li>
                                    <a href="{{asset('admin/images/medias/image-1.jpg')}}" title="Photo Title" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-1.jpg')}}" />
                                    </a>

                                    <div class="tags">
												<span class="label-holder">
													<span class="label label-info">breakfast</span>
												</span>

                                        <span class="label-holder">
													<span class="label label-danger">fruits</span>
												</span>

                                        <span class="label-holder">
													<span class="label label-success">toast</span>
												</span>

                                        <span class="label-holder">
													<span class="label label-warning arrowed-in">diet</span>
												</span>
                                    </div>

                                    <div class="tools">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-2.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-2.jpg')}}" />
                                        <div class="text">
                                            <div class="inner">Sample Caption on Hover</div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-3.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-3.jpg')}}" />
                                        <div class="text">
                                            <div class="inner">Sample Caption on Hover</div>
                                        </div>
                                    </a>

                                    <div class="tools tools-bottom">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-4.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-4.jpg')}}" />
                                        <div class="tags">
													<span class="label-holder">
														<span class="label label-info arrowed">fountain</span>
													</span>

                                            <span class="label-holder">
														<span class="label label-danger">recreation</span>
													</span>
                                        </div>
                                    </a>

                                    <div class="tools tools-top">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-5.jpg')}}" />
                                        <div class="text">
                                            <div class="inner">
                                                <span>Some Title!</span>

                                                <br />
                                                <a href="{{asset('admin/images/medias/image-5.jpg')}}" data-rel="colorbox">
                                                    <i class="ace-icon fa fa-search-plus"></i>
                                                </a>

                                                <a href="#">
                                                    <i class="ace-icon fa fa-user"></i>
                                                </a>

                                                <a href="#">
                                                    <i class="ace-icon fa fa-share"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-6.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-6.jpg')}}" />
                                    </a>

                                    <div class="tools tools-right">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-1.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-1.jpg')}}" />
                                    </a>

                                    <div class="tools">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>

                                <li>
                                    <a href="{{asset('admin/images/medias/image-2.jpg')}}" data-rel="colorbox">
                                        <img width="150" height="150" alt="150x150" src="{{asset('admin/images/medias/thumb-2.jpg')}}" />
                                    </a>

                                    <div class="tools tools-top in">
                                        <a href="#">
                                            <i class="ace-icon fa fa-link"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-paperclip"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-pencil"></i>
                                        </a>

                                        <a href="#">
                                            <i class="ace-icon fa fa-times red"></i>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </div><!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>
    {{--medias--}}
    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{'admin/js/jquery.mobile.custom.min.js'}}'>"+"<"+"/script>");
    </script>

    <!-- page specific plugin scripts -->
    <script src="{{asset('admin/js/jquery.colorbox.min.js')}}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            var $overflow = '';
            var colorbox_params = {
                rel: 'colorbox',
                reposition:true,
                scalePhotos:true,
                scrolling:false,
                previous:'<i class="ace-icon fa fa-arrow-left"></i>',
                next:'<i class="ace-icon fa fa-arrow-right"></i>',
                close:'&times;',
                current:'{current} of {total}',
                maxWidth:'100%',
                maxHeight:'100%',
                onOpen:function(){
                    $overflow = document.body.style.overflow;
                    document.body.style.overflow = 'hidden';
                },
                onClosed:function(){
                    document.body.style.overflow = $overflow;
                },
                onComplete:function(){
                    $.colorbox.resize();
                }
            };

            $('.ace-thumbnails [data-rel="colorbox"]').colorbox(colorbox_params);
            $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon


            $(document).one('ajaxloadstart.page', function(e) {
                $('#colorbox, #cboxOverlay').remove();
            });
        })
    </script>


    <script type="text/javascript">
        if('ontouchstart' in document.documentElement) document.write("<script src='{{'admin/js/jquery.mobile.custom.min.js'}}'>"+"<"+"/script>");
    </script>
    <script src="{{'admin/js/bootstrap.min.js'}}"></script>

    <!-- page specific plugin scripts -->
    <script src="{{'admin/js/dropzone.min.js'}}"></script>

    <!-- ace scripts -->
    <script src="{{'admin/js/ace-elements.min.js'}}"></script>
    <script src="{{'admin/js/ace.min.js'}}"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($){

            try {
                Dropzone.autoDiscover = false;

                var myDropzone = new Dropzone('#dropzone', {
                    previewTemplate: $('#preview-template').html(),

                    thumbnailHeight: 120,
                    thumbnailWidth: 120,
                    maxFilesize: 0.5,

                    //addRemoveLinks : true,
                    //dictRemoveFile: 'Remove',

                    dictDefaultMessage :
                            '<span class="bigger-150 bolder"><i class="ace-icon fa fa-caret-right red"></i> Drop files</span> to upload \
                            <span class="smaller-80 grey">(or click)</span> <br /> \
                            <i class="upload-icon ace-icon fa fa-cloud-upload blue fa-3x"></i>'
                    ,

                    thumbnail: function(file, dataUrl) {
                        if (file.previewElement) {
                            $(file.previewElement).removeClass("dz-file-preview");
                            var images = $(file.previewElement).find("[data-dz-thumbnail]").each(function() {
                                var thumbnailElement = this;
                                thumbnailElement.alt = file.name;
                                thumbnailElement.src = dataUrl;
                            });
                            setTimeout(function() { $(file.previewElement).addClass("dz-image-preview"); }, 1);
                        }
                    }

                });


                //simulating upload progress
                var minSteps = 6,
                        maxSteps = 60,
                        timeBetweenSteps = 100,
                        bytesPerStep = 100000;

                myDropzone.uploadFiles = function(files) {
                    var self = this;

                    for (var i = 0; i < files.length; i++) {
                        var file = files[i];
                        totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

                        for (var step = 0; step < totalSteps; step++) {
                            var duration = timeBetweenSteps * (step + 1);
                            setTimeout(function(file, totalSteps, step) {
                                return function() {
                                    file.upload = {
                                        progress: 100 * (step + 1) / totalSteps,
                                        total: file.size,
                                        bytesSent: (step + 1) * file.size / totalSteps
                                    };

                                    self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
                                    if (file.upload.progress == 100) {
                                        file.status = Dropzone.SUCCESS;
                                        self.emit("success", file, 'success', null);
                                        self.emit("complete", file);
                                        self.processQueue();
                                    }
                                };
                            }(file, totalSteps, step), duration);
                        }
                    }
                }


                //remove dropzone instance when leaving this page in ajax mode
                $(document).one('ajaxloadstart.page', function(e) {
                    try {
                        myDropzone.destroy();
                    } catch(e) {}
                });

            } catch(e) {
                alert('Dropzone.js does not support older browsers!');
            }

        });
    </script>
@endsection