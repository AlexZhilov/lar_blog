@php

    use App\Models\Blog\Post;
    use App\Models\Blog\Category;

    /**
     * @var Post $post
     * @var Category[] $categories
     */

@endphp

@extends('site.layouts.main')

@section('content')
    <section class="blog-details spad">
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-5 order-md-1 order-2">
                    @include('site.blog.inc.sidebar')
                </div>

                <div class="col-lg-8 col-md-7 order-md-2 order-1">
                    <div class="blog__details__text">
                        <h1>{{ $post->title }}</h1>
                        @if($post->image)
                            <div class="blog__details__text__pic">
                                <img src="{{ image($post->image) }}" alt="">
                            </div>
                        @endif
                        <div class="blog__details__text__content">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <div class="blog__details__info">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="blog__details__author">
                                    <div class="blog__details__author__pic">
                                        <img src="img/blog/details/details-author.jpg" alt="">
                                    </div>
                                    <div class="blog__details__author__text">
                                        <h6>{{ $post->user->name }}</h6>
                                        <span>{{ $post->user->getMainRole()->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="blog__details__widget">
                                    <ul>
                                        <li class="blog__details__widget__category"><span>Category:</span> <a href="{{ route('blog.category', $post->category) }}">{{ $post->category->title }}</a></li>
                                        <li class="blog__details__widget__tags">
                                            <span>Tags:</span>
                                            <span class="blog__details__widget__tags__items">
                                                @foreach($post->tags as $tag)
                                                    <a href="{{ route('blog.tag', $tag) }}">{{ $tag->title }}</a>
                                                @endforeach
                                            </span>

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection