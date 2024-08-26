<div class="container">
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Главная') }}</a></li>
                    @isset( $pages )
                        @foreach( $pages as $page_title => $route_name )
                            <li class="breadcrumb-item"><a href="{{ route($route_name) }}">{{ $page_title }}</a></li>

                        @endforeach
                    @endisset
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Страница' }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
