
<section class="breadcrumb-section set-bg" data-setbg="{{ isset($image) ? asset($image) : 'assets/img/breadcrumb.jpg' }}" style="background-image: url({{ isset($image) ? asset($image) : 'assets/img/breadcrumb.jpg' }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>{{ $title ?? 'Страница' }}</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('home') }}">Главная</a>

                        @isset( $pages )
                            @foreach( $pages as $page_title => $route_name )
                                <a href="{{ route($route_name) }}">{{ $page_title }}</a>
                            @endforeach
                        @endisset

                        <span>{{ $title ?? 'Страница' }}</span>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>