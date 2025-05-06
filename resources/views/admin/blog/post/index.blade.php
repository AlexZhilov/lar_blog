@php
    use App\Models\Blog\Post;

    /**
     * @var Post[] $posts
     */

@endphp

@extends('adminlte::page')

@section('content')

    <div class="row p-2 pt-4">

        <div class="col-12">
            <div class="filter-form mb-4">
                <div class="card">
                    <div class="card-header">
                        <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="true">
                            <i class="fas fa-filter"></i> Фильтры
                        </a>
                    </div>
                    <div class="collapse show" id="filterCollapse">
                        <div class="card-body">
                            <form action="{{ route('admin.blog.post.index') }}" method="GET">
                                <div class="row">
                                    <!-- Поиск -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Поиск</label>
                                            <input type="text" name="filter[search]" class="form-control" placeholder="Поиск по названию, описанию, slug" value="{{ request('filter.search') }}">
                                        </div>
                                    </div>

                                    <!-- Пользователь -->
                                    <div class="col-md-2">
                                        <x-admin.form.select for="select-user" name="filter[user]" title="Пользователь">
                                            @foreach($users as $id => $name)
                                                <option value="">Все пользователи</option>
                                                <option value="{{ $id }}" {{ request('filter.user') === $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </x-admin.form.select>
                                    </div>

                                    <!-- Категория -->
                                    <div class="col-md-2">
                                        <x-admin.form.select for="select-category" name="filter[category]" title="Категория">
                                            @foreach($categories as $id => $name)
                                                <option value="">Все категории</option>
                                                <option value="{{ $id }}" {{ request('filter.category') === $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </x-admin.form.select>
                                    </div>

                                    <!-- Статус -->
                                    <div class="col-md-2">
                                        <x-admin.form.select for="select-status" name="filter[status]" title="Статус">
                                            <option value="">Все статусы</option>
                                            <option value="no" {{ request('filter.status') === 'no' ? 'selected' : '' }}>Скрыто</option>
                                            <option value="yes" {{ request('filter.status') === 'yes' ? 'selected' : '' }}>Опубликовано</option>
                                        </x-admin.form.select>
                                    </div>

                                </div>

                                <!-- Количество элементов на странице -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Элементов на странице</label>
                                            <select name="per_page" class="form-control select2">
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-9 text-right">
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i> Применить фильтры
                                            </button>
                                            <a href="{{ route('admin.blog.post.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-times"></i> Сбросить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-12 card">
            <div class="card-body">

                <a href="{{ route('admin.blog.post.create') }}" class="btn btn-primary">{{ __('Create') }}</a>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" width="10">#</th>
                        <th scope="col">Категория</th>
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
