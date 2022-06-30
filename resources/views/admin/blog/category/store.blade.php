@php /** @var $category \App\Models\Blog\BlogCategory */ @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <form action="{{ $category->exists ? route('admin.blog.categories.update', $category->id) : route('admin.blog.categories.store') }}" method="post" class="row g-3">
                    @csrf
                    @if($category->exists) @method('PATCH') @endif
                    <div class="col-8">
                        @include('admin.blog.category.includes.edit_main')
                    </div>

                    <div class="col-3">
                        @include('admin.blog.category.includes.edit_sidebar')
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
