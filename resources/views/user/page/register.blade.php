@extends('user.master')
@section('title','Register')
@section('content')
    <div class="about">
        <div class="container">
            <div class="register">
                <form action="{!! route('userpostregister') !!}" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <div class="register-top-grid">
                        <h3>PERSONAL INFORMATION</h3>
                        <div>
                            <span>Full Name<label>*</label> @if(count($errors)>0)
                                    @foreach($errors->get('fullname') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>
                            <input type="text" name="fullname" value="{!! old('fullname') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Username<label>*</label> @if(count($errors)>0)
                                    @foreach($errors->get('username') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>
                            <input type="text" name="username" value="{!! old('username') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Email<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('email') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>
                            <input type="email" name="email" class="input-email" value="{!! old('email') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Phone<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('phone') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>
                            <input type="text" name="phone" class="input-email" value="{!! old('phone') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div>
                            <span>Address<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('address') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>
                            <input type="text" name="address" value="{!! old('address') !!}">
                        </div>

                        <div>
                            <span>Avatar<label>*</label>@if(count($errors)>0)
                                    @foreach($errors->get('avatar') as $error)
                                        <p class="display-errors">{!! $error !!}</p>
                                    @endforeach
                                @endif
                            </span>

                            <input type="file" name="avatar" value="{!! old('avatar') !!}">
                        </div>

                        {{-------------------------------------------------}}
                        <div class="clearfix"></div>
                        <a class="news-letter" href="#">
                            <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i>Sign Up
                                for Newsletter</label>
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="register-but">
                        <input name="submit" type="submit" class="submitregister" value="Submit">
                        <div class="clearfix"></div>
                    </div>
                </form>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection