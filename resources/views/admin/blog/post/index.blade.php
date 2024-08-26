@php
    use App\Models\Blog\Post;

    /**
     * @var Post[] $posts
     */

@endphp

@extends('adminlte::page')

@section('content')

    <div class="row p-2 pt-4">

        <div class="col-12 card">
            <div class="card-body">

                <a href="{{ route('admin.blog.post.create') }}" class="btn btn-primary">{{ __('Create') }}</a>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" width="10">#</th>
                        <th scope="col" >Категория</th>
                        <th scope="col">Заголовок</th>
                        <th scope="col">Пользователь</th>
                        <th scope="col">Просмотры</th>
                        <th scope="col">Создано</th>
                        <th scope="col">Отредактировано</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($posts as $post)
                        <tr {!! !$post->is_published ? 'style="opacity:.3"' : '' !!}>
                            <th scope="row">{{ $post->id }}.</th>
                            <td>{{ $post->category->title }}</td>
                            <td><a href="{{ route('admin.blog.post.edit', $post->id) }}">{{ $post->title }}</a></td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->views }}</td>
                            <td>{{ $post->created_at->format('d.m.Y H:m:s') }}</td>
                            <td>{{ $post->updated_at->format('d.m.Y H:m:s') }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {{ $posts->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>

@endsection
