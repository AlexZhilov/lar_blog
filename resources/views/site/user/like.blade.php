@extends('site.layouts.main')

@section('content')

    @include('site.inc.partials.header-crumb', [
        'title' => __('Personal account'),
        'pages' => [
            'Категория' => 'admin.blog.post.index'
        ]
    ])


    <section class="blog pt-3">

        <div class="container">
            <div class="row">
                {{-- sidebar --}}
                @include('site.user.inc.left-sidebar')
                {{-- content --}}
                <div class="col-lg-8 col-md-7">



                    <div class="row">
                        @foreach($posts as $post)
                            @php /** @var $post \App\Models\Blog\Post */ @endphp
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="blog__item">
{{--                                    @empty(!$post->image)--}}
                                    <div class="blog__item__pic">
                                        <a href="">
                                            <img src="{{ image($post->image) }}" alt="{{ $post->title }}">
                                        </a>
                                    </div>
{{--                                    @endempty--}}
                                    <div class="blog__item__text">
                                        <h5><a href="#">{{ $post->title }}</a></h5>
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{$post->published_at->diffForHumans()}}</li>
                                            <li><i class="fa fa-comment-o"></i> 5</li>
                                            <li data-toggle="tooltip" data-placement="bottom" title="Не нравится">
                                                <form action="{{ route('lk.blog.unlike', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button><i class="fa fa-heart-o"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                        <p>{{ $post->excerpt }}</p>
                                        <a href="#" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

{{--                        <div class="col-lg-12">--}}
{{--                            <div class="product__pagination blog__pagination">--}}
{{--                                <a href="#">1</a>--}}
{{--                                <a href="#">2</a>--}}
{{--                                <a href="#">3</a>--}}
{{--                                <a href="#"><i class="fa fa-long-arrow-right"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                    </div>




                </div>

            </div>
        </div>

    </section>



@endsection