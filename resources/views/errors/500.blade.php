@extends('user.master')
@section('title','404 page not found!')
@section('content')
    <div class="about">
        <div class="container">
            <div class="page-not-found">
                <h1>500</h1>
                <a href="{!! route('gethome') !!}">Back </a>
            </div>
        </div>
    </div>
@endsection