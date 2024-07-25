@extends('Frontend.Layout.app')

@section('title', 'Project | HHJN')
@section('content')
    @include('Frontend.Component.project-page-top-banner')
    @include('Frontend.Component.all-projects')
@endsection
