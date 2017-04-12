@extends('user.master')
@section('title','login')
@section('content')
    <div class="about">
        <div class="container">
            <div class="register">
                <div class="col-md-6 login-left">
                    <h3>NEW CUSTOMERS</h3>
                    <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                    <a class="acount-btn" href="{!! url('register') !!}">Create an Account</a>
                    <a href="auth/facebook" class="btn btn-info" role="button">Login with Facebook</a>
                </div>
                <div class="col-md-6 login-right">
                    <h3>REGISTERED CUSTOMERS</h3>
                    <p>If you have an account with us, please log in.</p>
                    @if(Session::has('message'))
                        {{Session::get('message')}}
                    @endif
                    <form action="" method="post">
                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                        <div>
                            <span>Email Address<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('email') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="email" name="email" placeholder="Enter your Email here">
                        </div>
                        <div>
                            <span>Password<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('password') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="password" name="password" placeholder="Enter your Password here">
                        </div>
                        <a class="forgot" href="#">Forgot Your Password?</a>
                        <input type="submit" value="Login">
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection