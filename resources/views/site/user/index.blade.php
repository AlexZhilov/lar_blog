@extends('site.layouts.main')

@section('content')

    @include('site.inc.partials.header-crumb', [
        'title' => 'Личный кабинет',
    ])

    <section class="blog pt-3">

        <div class="container">
            <div class="row">
                {{-- sidebar --}}
                @include('site.user.inc.left-sidebar')
                {{-- content --}}
                <div class="col-lg-8 col-md-7">
                    222
                </div>

            </div>
        </div>

    </section>



@endsection