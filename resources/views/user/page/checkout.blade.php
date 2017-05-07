@extends('user.master')
@section('title','Checkout')
@section('content')
    <div class="about">
        <div class="container">

            <div class="register">
                <form action="{{route('postcheckout')}}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="register-top-grid">
                        <h3>CUSTOMER'S INFOS</h3>
                        <div>
                            <span>Name<label>*</label></span>
                            <input type="text" name="name" id="name"
                                   value="@if(Auth::guard('simpleUser')->check()){!! trim(Auth::guard('simpleUser')->user()->name) !!}@else{!! old('name') !!}@endif "
                                   placeholder="Insert your name">
                            @if(count($errors)>0)
                                @foreach($errors->get('name') as $error)
                                    <p style='color: #E08374'>{{$error}}</p>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <span>Email<label>*</label></span>
                            <input type="text" name="email" id="email"
                                   value="@if(Auth::guard('simpleUser')->check()){!! trim(Auth::guard('simpleUser')->user()->email) !!}@else{!! old('email') !!}@endif"
                                   placeholder="Insert your email">
                            @if(count($errors)>0)
                                @foreach($errors->get('email') as $error)
                                    <p style='color: #E08374'>{{$error}}</p>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <span>Phone<label>*</label></span>
                            <input type="text" name="phone" id="phone"
                                   value="@if(Auth::guard('simpleUser')->check()){!! trim(Auth::guard('simpleUser')->user()->phone) !!}@else{!! old('phone') !!}@endif"
                                   placeholder="Insert your phone">
                            @if(count($errors)>0)
                                @foreach($errors->get('phone') as $error)
                                    <p style='color: #E08374'>{{$error}}</p>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <span>Address<label>*</label></span>
                            <input type="text" name="address" id="address"
                                   value="@if(Auth::guard('simpleUser')->check()){!! trim(Auth::guard('simpleUser')->user()->address) !!}@else{!! old('address') !!}@endif"
                                   placeholder="Insert your address">
                            @if(count($errors)>0)
                                @foreach($errors->get('address') as $error)
                                    <p style='color: #E08374'>{{$error}}</p>
                                @endforeach
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                    <div>
                        <span style="color: #999;
    font: 300 14px/25px Lato, sans-serif;
    padding-bottom: 0.2em;
    display: block;
    text-transform: uppercase;">MESSAGES</span>
                        <textarea name="content" id="content"
                                  style="display: block; width: 95%; border: 1px solid #EEE;outline-color: #FF5B36;font-size: 1em;padding: 0.5em;"
                                  placeholder="Enter your massages">{{old('content')}}</textarea>
                    </div>
                    <div class="register-but">
                        <h4><span style="color: #999;
    font: 300 14px/25px Lato, sans-serif;
    padding-bottom: 0.2em;
    display: block;
    text-transform: uppercase;">TOTAL :<span style="color: #f00;font-weight: bold;font-size: larger"> {{$total}}</span> ($)</span>
                        </h4>
                        <input type="submit" value="CHECKOUT" name="submit" class="btn btn-success btn-block"
                               style="border-radius: 0px; color: #FFFFFF;width: 95% !important;">
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection