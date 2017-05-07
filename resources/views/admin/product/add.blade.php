@extends('admin.master')
@section('title','add product')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="{!! route('admin.dashboard') !!}">Home</a>
                    </li>

                    <li>
                        <a href="{!! route('admin.product.list') !!}">Product</a>
                    </li>
                    <li class="active"><a href="{!! route('admin.product.add') !!}">Add</a>
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
                        <a href="{!! route('admin.product.list') !!}">Product</a>
                        <small>
                            <i class="ace-icon fa fa-angle-double-right"></i>
                            <a href="{!! route('admin.product.add') !!}">Add</a>
                        </small>
                    </h1>
                </div><!-- /.page-header -->
                @include('admin.block.displayerrors')
                @if(count($errors)>0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-block alert-danger message-box">
                            <button type="button" class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                            <i class="ace-icon fa fa-times red"></i>
                            <strong class="red">
                                {{$error}}
                            </strong>
                        </div>
                    @endforeach
                @endif

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <form class="form-horizontal" role="form" action="{!! route('admin.product.add') !!}"
                              method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Product
                                    name </label>

                                <div class="col-sm-9">
                                    <input type="text" id="form-field-1" placeholder="Product name"
                                           class="col-xs-10 col-sm-5" name="name" value="{!! old('name') !!}"/>
                                </div>
                            </div>
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right"
                                       for="form-field-4">Categories</label>

                                <div class="col-sm-9">
                                    <select name="cat_id" id="">
                                        <option value="">Choose a Category</option>
                                        @foreach($categoryList as $item)
                                            <option value="{!! $item->id !!}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Product
                                    Price</label>

                                <div class="col-sm-9">
                                    <input type="number" id="form-field-1" placeholder="Product Price"
                                           class="col-xs-10 col-sm-5" name="price" value="{{old('price')}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Discount</label>

                                <div class="col-sm-9">
                                    <input type="number" id="form-field-1" placeholder="Percent discount"
                                           class="col-xs-10 col-sm-5" name="discount" value="{{old('discount')}}"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Count</label>

                                <div class="col-sm-9">
                                    <input type="number" id="form-field-1" placeholder="Number product"
                                           class="col-xs-10 col-sm-5" name="count" value="{{old('count')}}"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Descriptions</label>

                                <div class="col-sm-9">
											<span class="input-icon">
                                                <textarea name="description" id="form-field-icon-1" cols="46" rows="5">{{old('description')}}
                                                </textarea>
												<i class="ace-icon fa fa-leaf blue"></i>
											</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Thumbnail</label>
                                <div class="col-sm-9 col-md-4">
                                    <label class="ace-file-input">
                                        <input type="file" id="id-input-file-2" name="thumbnail">
                                        <span class="ace-file-container" data-title="Choose">
                                                                <span class="ace-file-name" data-title="No File ...">
                                                                    <i class=" ace-icon fa fa-upload"></i>
                                                                </span>
                                                            </span>
                                        <a class="remove" href="#">
                                            <i class=" ace-icon fa fa-times"></i>
                                        </a>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">More images</label>
                                <div class="col-xs-9 col-md-4">
                                    <label class="ace-file-input ace-file-multiple">
                                        <input multiple="" type="file" id="id-input-file-3" name="listimg[]">
                                        <span class="ace-file-container"
                                              data-title="Drop files here or click to choose">
                                            <span class="ace-file-name" data-title="No File ...">
                                                <i class=" ace-icon ace-icon fa fa-cloud-upload"></i>
                                            </span>
                                        </span>
                                        <a class="remove" href="#">
                                            <i class=" ace-icon fa fa-times"></i>
                                        </a>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label no-padding-right">Status</label>

                                <div class="col-sm-9">
											<span class="input-icon">
												<label>
                                                <input class="ace ace-switch ace-switch-3"
                                                       type="checkbox" name="status">
                                                <span class="lbl"></span>
                                            </label>
											</span>
                                </div>
                            </div>
                            <div class="clearfix form-actions">
                                <div class="col-md-offset-3 col-md-9">
                                    <button class="btn btn-info" type="submit">
                                        <i class="ace-icon fa fa-check bigger-110"></i>
                                        Submit
                                    </button>

                                    &nbsp; &nbsp; &nbsp;
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