@extends('Frontend.Layout.app')
@section('content')
    {{-- home-service.blade --}}
    @include('Frontend.Component.home-banner')
    @include('Frontend.Component.home-service')
    @include('Frontend.Component.home-course')
@endsection
