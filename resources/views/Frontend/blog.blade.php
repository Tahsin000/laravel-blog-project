@extends('Frontend.Layout.app')
@section('title', 'Blog | HHJN')
@section('content')
    @include('Frontend.Component.blog-page-top-banner')
    @include('Frontend.Component.all-blog')
@endsection
