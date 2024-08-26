@php

    use App\Models\Blog\Category;

    /**
    * @var Category[] $categories
    */
@endphp

@extends('adminlte::page')

@section('content')

    <div class="row p-2 pt-4">
        <div class="col-12 card">
            <div class="card-body">
                <a href="{{ route('admin.blog.category.create') }}" class="btn btn-primary">{{ __('Create') }}</a>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">updated</th>
                        <th scope="col">parent</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($categories as $category)

                        <tr>
                            <th scope="row">{{ $category->id }}.</th>
                            <td>
                                <a href="{{ route('admin.blog.category.edit', $category->id) }}">{{ $category->title }}</a>
                                <span class="badge bg-primary rounded-pill" data-toggle="tooltip" data-placement="right"
                                      title="{{ $category->posts_count }} постов в категории">{{ $category->posts_count }}</span>

                            </td>
                            <td>{{ $category->updated_at }}</td>
                            <td>{{ optional($category->parent)->title ?? '---' }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

                {{ $categories->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection