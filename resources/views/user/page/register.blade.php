@extends('user.master')
@section('title','Register')
@section('content')
    <div class="about">
        <div class="container">
            <div class="register">
                <form action="{!! url('dang-ky') !!}" method="POST">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="register-top-grid">
                        <h3>PERSONAL INFORMATION</h3>
                        <div>
                            <span>First Name<label>*</label> @if(count($errors)>0)
                                    @foreach($errors->get('first_name') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="text" name="first_name" value="{!! old('first_name') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Last Name<label>*</label> @if(count($errors)>0)
                                    @foreach($errors->get('last_name') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="text" name="last_name" value="{!! old('last_name') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Email<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('email') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="email" name="email" class="input-email" value="{!! old('email') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Phone<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('phone') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="text" name="phone" class="input-email" value="{!! old('phone') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Address<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('address') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="text" name="address" value="{!! old('address') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div class="clearfix"> </div>
                        <a class="news-letter" href="#">
                            <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up for Newsletter</label>
                        </a>
                    </div>
                    <div class="register-bottom-grid">
                        <h3>LOGIN INFORMATION</h3>
                        <div>
                            <span>Password<label>*</label> @if(count($errors)>0)
                                    @foreach($errors->get('password') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="password" name="password">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Confirm Password<label>*
                                </label>@if(count($errors)>0)
                                    @foreach($errors->get('repassword') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif</span>
                            <input type="password" name="repassword">
                        </div>

                        {{-------------------------------------------------}}
                        <div class="clearfix"> </div>
                    </div>
                    <div class="register-but">
                        <input name="submit" type="submit" class="submitregister" value="Submit">
                        <div class="clearfix"> </div>
                    </div>
                </form>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection