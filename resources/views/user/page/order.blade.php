@extends('user.master')
@section('title','order')
@section('content')
    <div class="about">
        <div class="container">

            <div class="register">
                <form action="" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="register-top-grid">
                        <h3>CUSTOMER'S INFOS</h3>
                        <div>
                            <span>Name<label>*</label></span>
                            <input type="text" name="name" id="name"
                                   value="">
                        </div>
                        <div>
                            <span>Email<label>*</label></span>
                            <input type="text" name="email" id="email"
                                   value="">
                        </div>
                        <div>
                            <span>Phone<label>*</label></span>
                            <input type="text" name="phone" id="phone"
                                   value="">
                        </div>
                        <div>
                            <span>Address<label>*</label></span>
                            <input type="text" name="address" id="address"
                                   value="">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <span>CONTENT</span>
                        <textarea name="content" id="content" style="display: block; width: 95%"
                                  placeholder="Enter your massages"></textarea>
                    </div>
                    <div class="register-but">
                        <h4>TOTAL : <span style="color: #f00"></span>12000 $</h4>
                        <input type="submit" value="ORDER" name="submit">
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection