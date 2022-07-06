@php /** @var $post \App\Models\Blog\BlogPost */ @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <form action="{{ $post->exists ? route('admin.blog.post.update', $post->id) : route('admin.blog.post.store') }}" method="post" class="row g-3">
                    @csrf
                    @if( $post->exists ) @method('PUT') @endif
                    <div class="col-8">
                        @include('admin.blog.post.includes.edit_main')
                    </div>

                    <div class="col-3">
                        @include('admin.blog.post.includes.edit_sidebar')
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
