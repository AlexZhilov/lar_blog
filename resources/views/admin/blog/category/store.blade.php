@php /** @var $category \App\Models\Blog\Category */ @endphp
@extends('adminlte::page')

@section('content')

        <div class="row p-2 pt-4">
            <div class="col-12">

                <form action="{{ $category->exists ? route('admin.blog.category.update', $category->id) : route('admin.blog.category.store') }}" method="post" class="row g-3">
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
            @include('admin.blog.category.includes.delete_bar')
        </div>
{{--    </div>--}}
@endsection
