@extends('Frontend.Layout.app')

@section('title', 'Home | HHJN')
@section('content')
    {{-- home-service.blade --}}
    @include('Frontend.Component.home-banner')
    @include('Frontend.Component.home-service')
    @include('Frontend.Component.home-course')
    @include('Frontend.Component.home-project')
    @include('Frontend.Component.home-contact-us')
    @include('Frontend.Component.home-recent-blog')
    @include('Frontend.Component.home-review')
@endsection
