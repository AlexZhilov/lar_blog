<div class="blog__sidebar">
    <div class="blog__sidebar__search">
        <form action="#">
            <input type="text" placeholder="Search...">
            <button type="submit"><span class="icon_search"></span></button>
        </form>
    </div>
    <div class="blog__sidebar__item">
        <h4>Categories</h4>
        <ul>
            @foreach($categories as $category)
                <li {{request()->route('category') && request()->route('category')->id == $category->id ? 'class=active' : '' }} ><a
                            href="{{ route('blog.category', $category) }}">{{ $category->title }}</a></li>
            @endforeach
        </ul>
    </div>
    @if ($tags->count())
    <div class="blog__sidebar__item">
        <h4>Tags</h4>
        <div class="blog__sidebar__item__tags">
            @foreach($tags as $tag)
                <a href="{{ route('blog.tag', $tag) }}" {{ request()->route('tag') && request()->route('tag')->id == $tag->id ? 'class=active' : '' }}>{{ $tag->title }} ({{ $tag->posts_count }})</a>
            @endforeach
        </div>
    </div>
    @endif
</div>
