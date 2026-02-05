@extends('front.layouts.app')

@section('title', 'Home')
@section('meta_description', 'Portfolio website of John Doe - Fullstack Developer specializing in modern web technologies')

@section('content')
    @include('front.components.hero')
    @include('front.components.about')
    @include('front.components.skills')
    @include('front.components.projects')
    @include('front.components.experience')
    @include('front.components.contact')
@endsection
