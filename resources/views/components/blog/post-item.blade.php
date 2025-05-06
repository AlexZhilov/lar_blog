@php
    use App\Models\Blog\Post;

    /**
     * @var $post Post
     */
@endphp

@props(['post'])

<div class="col-lg-6 col-md-6 col-sm-6">
    <div class="blog__item">
{{--        {{ dump(image($post->image)) }}--}}
        @if($post->image)
        <div class="blog__item__pic">
            <a href="{{ route('blog.post', [$post->category, $post]) }}">
                <img src="{{ image($post->image) }}" alt="">
            </a>
        </div>
        @endif
        <div class="blog__item__text">
            <ul>
                <li><i class="fa fa-calendar-o"></i> {{ $post->created_at->format('M d, Y') }}</li>
                {{--                                        <li><i class="fa fa-comment-o"></i> 5</li>--}}
            </ul>
            <h5><a href="{{ route('blog.post', [$post->category, $post]) }}">{{ $post->title }}</a></h5>
            <p>{{ $post->excerpt }}</p>
            <a href="{{ route('blog.post', [$post->category, $post]) }}" class="blog__btn">READ MORE <span class="arrow_right"></span></a>
        </div>
    </div>
</div>