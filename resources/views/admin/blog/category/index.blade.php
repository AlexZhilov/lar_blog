@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row card">
            <div class="col-12 card-body">

                <a href="{{ route('admin.blog.category.create') }}" class="btn btn-primary">Create category</a>
                
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
                        @php /** @var $category \App\Models\Blog\BlogCategory */ @endphp
                        <tr>
                            <th scope="row">{{ $category->id }}.</th>
                            <td>
                                <a href="{{ route('admin.blog.category.edit', $category->id) }}">{{ $category->title }}</a>
                                <span class="badge bg-primary rounded-pill">---</span>
                            </td>
                            <td>{{ $category->updated_at }}</td>
                            <td>{{ $category->parent->title }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {{ $categories->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection