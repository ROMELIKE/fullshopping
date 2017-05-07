@extends('user.master')
@section('title','contact')
@section('content')
    <div class="about">
        <div class="container">
            <div class="singel_right">
                <div class="col-md-8">
                    <div class="contact-form">
                        <form method="post" action="{{route('postcontact')}}">
                            @if(Auth::guard('simpleUser')->check())
                                <p class="comment-form-author"><label for="author">Your Name:</label>
                                    <input type="text" value="{{Auth::guard('simpleUser')->user()['name']}}" name="name" class="textbox"
                                           placeholder="Enter your name here...">
                                </p>
                                <p class="comment-form-author"><label for="author">Email:</label>
                                    <input type="text" value="{{Auth::guard('simpleUser')->user()['email']}}" name="email" class="textbox"
                                           placeholder="Enter your email here...">
                                </p>
                            @else
                                <p class="comment-form-author"><label for="author">Your Name:</label>
                                    <input type="text" value="{{old('name')}}" name="name" class="textbox"
                                           placeholder="Enter your name here...">
                                </p>
                                <p class="comment-form-author"><label for="author">Email:</label>
                                    <input type="text" value="{{old('email')}}" name="email" class="textbox"
                                           placeholder="Enter your email here...">
                                </p>
                            @endif
                                <p class="comment-form-author"><label for="author">Subject:</label>
                                    <input type="text" value="{{old('subject')}}" name="subject" class="textbox"
                                           placeholder="Enter your subject here...">
                                </p>
                            <p class="comment-form-author"><label for="author">Message:</label>
                                <textarea name="message">Enter your message here...</textarea>
                            </p>
                            <input name="submit" type="submit" id="submit" value="Submit">
                            {{csrf_field()}}
                        </form>
                    </div>
                </div>
                <div class="col-md-4 contact_right">
                    <h3>Address</h3>
                    <div class="address">
                        <i class="pin_icon"></i>
                        <div class="contact_address">
                            Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod
                            mazim placerat facer possim assum. Typi non
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="address">
                        <i class="phone"></i>
                        <div class="contact_address">
                            1-25-2568-897
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="address">
                        <i class="mail"></i>
                        <div class="contact_email">
                            <a href="malito:mail@demolink.org">mail(at)romecody.com</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3150859.767904157!2d-96.62081048651531!3d39.536794757966845!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1408111832978"></iframe>
            </div>
        </div>
    </div>
@endsection