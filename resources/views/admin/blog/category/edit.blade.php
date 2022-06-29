@php /** @var $category \App\Models\Blog\BlogCategory */ @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <form action="{{ route('admin.blog.categories.update', $category->id) }}" method="post" class="row g-3">
                    @csrf
                    @method('patch')

                    <div class="col-8">
                        @include('admin.blog.category.includes.edit_main_col')
                    </div>

                    <div class="col-3">
                        @include('admin.blog.category.includes.edit_add_col')
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
