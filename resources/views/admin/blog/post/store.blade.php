@php /** @var $post \App\Models\Blog\Post */ @endphp
@extends('adminlte::page')

@section('content')

        <div class="row p-2 pt-4">
            <div class="col-12">

                <form action="{{ $post->exists ? route('admin.blog.post.update', $post->id) : route('admin.blog.post.store') }}" method="post" class="row g-3">
                    @csrf
                    @if( $post->exists ) @method('PATCH') @endif
                    <div class="col-8">
                        @include('admin.blog.post.includes.edit_main')
                    </div>
                    <div class="col-3">
                        @include('admin.blog.post.includes.edit_sidebar')
                    </div>
                </form>

            </div>
            @include('admin.blog.post.includes.delete_bar')
        </div>

@endsection
