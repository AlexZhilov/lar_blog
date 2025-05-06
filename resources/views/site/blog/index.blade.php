@php

    use App\Models\Blog\Post;
    use App\Models\Blog\Category;

    /**
     * @var Post[] $posts
     * @var Category[] $categories
     */

@endphp

@extends('site.layouts.main')

@section('content')
    <section class="blog mt-3">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    @include('site.blog.inc.sidebar')
                </div>

                <div class="col-lg-8 col-md-7 order-md-2 order-1">

                    @if ($title = Breadcrumbs::generate()->last()->title)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title">
                                <h2>{{ $title }}</h2>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row">

                        @foreach($posts as $post)
                            <x-blog.post-item :post="$post"/>
                        @endforeach

                        {{ $posts->onEachSide(1)->withQueryString()->links('vendor.pagination.site') }}

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection