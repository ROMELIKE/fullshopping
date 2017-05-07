@extends('admin.master')
@section('title','add news')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>

                    <li>
                        <a href="#">Forms</a>
                    </li>
                    <li class="active">Wysiwyg &amp; Markdown</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input"
                                           id="nav-search-input" autocomplete="off"/>
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>
            <div class="page-content">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <h3 class="header blue clearfix" style="font-weight: bold;">
                            Add new post
                        </h3>
                        <form action="" method="" name="">

                        </form>
                        <div class="form-group">
                            <h4 class="header green clearfix">Title</h4>
                            <input type="text" id="form-field-1-1" placeholder="Enter the title" class="form-control">
                        </div>

                        <h4 class="header green clearfix">Intros</h4>
                        <textarea name="" id="intro"  cols="156"rows="8"></textarea>
                        <script type="text/javascript">CKEDITOR.replace('intro'); </script>


                        <h4 class="header green clearfix">Content</h4>
                        <textarea name="" id="content" cols="156" rows="20"></textarea>
                        <script type="text/javascript">CKEDITOR.replace('content'); </script>

                        <div class="hr hr-double dotted"></div>

                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="header green clearfix">
                                    Tags
                                </h4>
                                <div class="col-sm-12">
                                    <div class="inline">
                                        <div class="tags" style="width: 100%">
                                            <span class="tag">
                                                Tag Input Control
                                                <button type="button" class="close">×</button>
                                            </span>
                                            <span class="tag">
                                                Programmatically Added
                                                <button type="button" class="close">×</button>
                                            </span>
                                            <span class="tag">gfdg
                                                <button type="button" class="close">×</button>
                                            </span>
                                            <span class="tag">
                                                dfgdgg
                                                <button type="button" class="close">×</button>
                                            </span>
                                            <input type="text" name="tags" id="form-field-tags"
                                                   value="Tag Input Control" placeholder="Enter tags ..."
                                                   style="display: none;"><input type="text"
                                                                                 placeholder="Enter tags ...">
                                            <ul class="typeahead dropdown-menu"
                                                style="top: 85px; left: 19px; display: none;">
                                                <li data-value="Georgia" class="active"><a href="#"><strong>G</strong>eor<strong>g</strong>ia</a>
                                                </li>
                                                <li data-value="Michigan"><a href="#">Michi<strong>g</strong>an</a></li>
                                                <li data-value="Oregon"><a href="#">Ore<strong>g</strong>on</a></li>
                                                <li data-value="Virginia"><a href="#">Vir<strong>g</strong>inia</a></li>
                                                <li data-value="Washington"><a href="#">Washin<strong>g</strong>ton</a>
                                                </li>
                                                <li data-value="West Virginia"><a href="#">West Vir<strong>g</strong>inia</a>
                                                </li>
                                                <li data-value="Wyoming"><a href="#">Wyomin<strong>g</strong></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="header green clearfix">
                                    Category
                                </h4>
                                <select class="chosen-select form-control" id="form-field-select-3"
                                        data-placeholder="Choose a State...">
                                    <option value="">Categories</option>
                                    <option value="AL">Alabama</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="header green clearfix">
                                    Thumbnail
                                </h4>
                                <div class="col-xs-6">
                                    <div class="space"></div>
                                    <label class="ace-file-input ace-file-multiple"><input type="file"><span
                                                class="ace-file-container"
                                                data-title="Drop files here or click to choose"><span
                                                    class="ace-file-name" data-title="No File ..."><i
                                                        class=" ace-icon ace-icon fa fa-cloud-upload"></i></span></span><a
                                                class="remove" href="#"><i
                                                    class=" ace-icon fa fa-times"></i></a></label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="header green clearfix">Status</h4>
                                <input name="switch-field-1" class="ace ace-switch ace-switch-7" type="checkbox">
                                <span class="lbl"></span>
                            </div>
                        </div>
                    </div><!-- /.page-content -->
                </div>
                <div class="clearfix form-actions">
                    <div class="col-md-offset-3 col-md-9">
                        <button class="btn btn-info" type="button">
                            <i class="ace-icon fa fa-check bigger-110"></i>
                            Add new
                        </button>

                        &nbsp; &nbsp; &nbsp;
                        <button class="btn" type="reset">
                            <i class="ace-icon fa fa-undo bigger-110"></i>
                            Reset
                        </button>
                    </div>
                </div>
            </div><!-- /.main-content -->
        </div>
    </div>
    <script type="text/javascript" defer>
        jQuery(function($){

            $('textarea[data-provide="markdown"]').each(function(){
                var $this = $(this);

                if ($this.data('markdown')) {
                    $this.data('markdown').showEditor();
                }
                else $this.markdown()

                $this.parent().find('.btn').addClass('btn-white');
            })



            function showErrorAlert (reason, detail) {
                var msg='';
                if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
                else {
                    //console.log("error uploading file", reason, detail);
                }
                $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
            }

            //$('#editor1').ace_wysiwyg();//this will create the default editor will all buttons

            //but we want to change a few buttons colors for the third style
            $('#editor1').ace_wysiwyg({
                toolbar:
                        [
                            'font',
                            null,
                            'fontSize',
                            null,
                            {name:'bold', className:'btn-info'},
                            {name:'italic', className:'btn-info'},
                            {name:'strikethrough', className:'btn-info'},
                            {name:'underline', className:'btn-info'},
                            null,
                            {name:'insertunorderedlist', className:'btn-success'},
                            {name:'insertorderedlist', className:'btn-success'},
                            {name:'outdent', className:'btn-purple'},
                            {name:'indent', className:'btn-purple'},
                            null,
                            {name:'justifyleft', className:'btn-primary'},
                            {name:'justifycenter', className:'btn-primary'},
                            {name:'justifyright', className:'btn-primary'},
                            {name:'justifyfull', className:'btn-inverse'},
                            null,
                            {name:'createLink', className:'btn-pink'},
                            {name:'unlink', className:'btn-pink'},
                            null,
                            {name:'insertImage', className:'btn-success'},
                            null,
                            'foreColor',
                            null,
                            {name:'undo', className:'btn-grey'},
                            {name:'redo', className:'btn-grey'}
                        ],
                'wysiwyg': {
                    fileUploadError: showErrorAlert
                }
            }).prev().addClass('wysiwyg-style2');


            /**
             //make the editor have all the available height
             $(window).on('resize.editor', function() {
		var offset = $('#editor1').parent().offset();
		var winHeight =  $(this).height();

		$('#editor1').css({'height':winHeight - offset.top - 10, 'max-height': 'none'});
	}).triggerHandler('resize.editor');
             */


            $('#editor2').css({'height':'200px'}).ace_wysiwyg({
                toolbar_place: function(toolbar) {
                    return $(this).closest('.widget-box')
                            .find('.widget-header').prepend(toolbar)
                            .find('.wysiwyg-toolbar').addClass('inline');
                },
                toolbar:
                        [
                            'bold',
                            {name:'italic' , title:'Change Title!', icon: 'ace-icon fa fa-leaf'},
                            'strikethrough',
                            null,
                            'insertunorderedlist',
                            'insertorderedlist',
                            null,
                            'justifyleft',
                            'justifycenter',
                            'justifyright'
                        ],
                speech_button: false
            });




            $('[data-toggle="buttons"] .btn').on('click', function(e){
                var target = $(this).find('input[type=radio]');
                var which = parseInt(target.val());
                var toolbar = $('#editor1').prev().get(0);
                if(which >= 1 && which <= 4) {
                    toolbar.className = toolbar.className.replace(/wysiwyg\-style(1|2)/g , '');
                    if(which == 1) $(toolbar).addClass('wysiwyg-style1');
                    else if(which == 2) $(toolbar).addClass('wysiwyg-style2');
                    if(which == 4) {
                        $(toolbar).find('.btn-group > .btn').addClass('btn-white btn-round');
                    } else $(toolbar).find('.btn-group > .btn-white').removeClass('btn-white btn-round');
                }
            });




            //RESIZE IMAGE

            //Add Image Resize Functionality to Chrome and Safari
            //webkit browsers don't have image resize functionality when content is editable
            //so let's add something using jQuery UI resizable
            //another option would be opening a dialog for user to enter dimensions.
            if ( typeof jQuery.ui !== 'undefined' && ace.vars['webkit'] ) {

                var lastResizableImg = null;
                function destroyResizable() {
                    if(lastResizableImg == null) return;
                    lastResizableImg.resizable( "destroy" );
                    lastResizableImg.removeData('resizable');
                    lastResizableImg = null;
                }

                var enableImageResize = function() {
                    $('.wysiwyg-editor')
                            .on('mousedown', function(e) {
                                var target = $(e.target);
                                if( e.target instanceof HTMLImageElement ) {
                                    if( !target.data('resizable') ) {
                                        target.resizable({
                                            aspectRatio: e.target.width / e.target.height,
                                        });
                                        target.data('resizable', true);

                                        if( lastResizableImg != null ) {
                                            //disable previous resizable image
                                            lastResizableImg.resizable( "destroy" );
                                            lastResizableImg.removeData('resizable');
                                        }
                                        lastResizableImg = target;
                                    }
                                }
                            })
                            .on('click', function(e) {
                                if( lastResizableImg != null && !(e.target instanceof HTMLImageElement) ) {
                                    destroyResizable();
                                }
                            })
                            .on('keydown', function() {
                                destroyResizable();
                            });
                }

                enableImageResize();

                /**
                 //or we can load the jQuery UI dynamically only if needed
                 if (typeof jQuery.ui !== 'undefined') enableImageResize();
                 else {//load jQuery UI if not loaded
			//in Ace demo ./components will be replaced by correct components path
			$.getScript("assets/js/jquery-ui.custom.min.js", function(data, textStatus, jqxhr) {
				enableImageResize()
			});
		}
                 */
            }


        });
    </script>

@endsection