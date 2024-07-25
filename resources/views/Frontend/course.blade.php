@extends('Frontend.Layout.app')

@section('title', 'Course | HHJN')
@section('content')
    @include('Frontend.Component.course-page-top-banner')
    @include('Frontend.Component.all-course')
@endsection
