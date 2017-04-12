@extends('admin.master')
@section('title','add category')
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
                        <a href="#">Categories</a>
                    </li>
                    <li class="active">Add</li>
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
                <div class="page-header">
                    <h1>
                        Categories
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            Add
                        </small>
                    </h1>
                </div><!-- /.page-header -->

                @include('admin.block.displayerrors')

                <div class="row upslide">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form"
                              action="{!! route('admin.cate.edit',['id'=>$thisCategory->id]) !!}" method="post">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Category
                                    Name</label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" placeholder="Category Name"
                                           class="col-xs-10 col-sm-5" value="{!! $thisCategory->name !!}"
                                           name="catename"/>
                                    {{--@if(count($errors)>0)--}}
                                    {{--@foreach($errors->get('catename') as $error)--}}
                                    {{--<p style='color: red'>{{$error}}</p>--}}
                                    {{--@endforeach--}}
                                    {{--@endif--}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right"
                                       for="form-field-1-1">Parrent</label>

                                <div class="col-sm-9">
                                    <select name="parrent" id="">
                                        <option value="" class="disabled">Choose a parrent category</option>
                                        @foreach($list as $item)
                                            @if($item->id == $thisCategory->parrent_id)
                                                <option value="{!! $item->id !!}" selected>{!! $item->name !!}</option>
                                            @else
                                                <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Status</label>

                                <div class="col-sm-9">
                                    @if($thisCategory->status)
                                        <span class="input-icon">
												<label>
                                                <input name="switch_field_1" class="ace ace-switch ace-switch-3"
                                                       type="checkbox" checked>
                                                <span class="lbl"></span>
                                            </label>
											</span>
                                    @else
                                        <span class="input-icon">
												<label>
                                                <input name="switch_field_1" class="ace ace-switch ace-switch-3"
                                                       type="checkbox">
                                                <span class="lbl"></span>
                                            </label>
											</span>
                                    @endif
                                </div>
                            </div>

                            <div class="space-4"></div>

                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>
                                    <button class="btn" type="reset">
                                        <i class="ace-icon fa fa-undo bigger-110"></i>
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div>

@endsection