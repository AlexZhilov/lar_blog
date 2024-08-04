@extends('site.layouts.main')

@section('content')

    <section class="blog pt-3">

        <div class="container">
            <div class="row">
                {{-- sidebar --}}
                @include('site.user.inc.left-sidebar')
                {{-- content --}}
                <div class="col-lg-8 col-md-7">


                    <div class="row">
{{--                        {{ dd($comments) }}--}}
                        @foreach($comments as $comment)
                            @php /** @var $comment \App\Models\Blog\Comment */@endphp
                            <div class="col-lg-12">
                                <div class="blog__item">
                                    <div class="blog__item__text">
                                        <p>{{ $comment->message }}</p>
                                        <ul>
                                            <li><i class="fa fa-calendar-o"></i> {{ $comment->created_at->diffForHumans() }}</li>
                                        </ul>
                                        <h5><a href="#">{{ $comment->post->title }}</a></h5>
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