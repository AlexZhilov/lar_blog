@extends('site.layouts.main')

@section('content')

    <!-- Hero Section Begin -->
    @include('site.inc.main.hero')
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    @include('site.inc.main.categories')
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    @include('site.inc.main.featured')
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    @include('site.inc.main.banner')
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    @include('site.inc.main.last_product')
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    @include('site.inc.main.blog')
    <!-- Blog Section End -->

@endsection