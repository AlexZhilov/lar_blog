@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                <form action="{{ route('admin.blog.categories.store') }}" method="post" class="row g-3">
                    @csrf

                    <div class="col-12">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">City</label>
                        <textarea class="form-control" row="2" name="description" id="description" cols="30" rows="10">{{ old('description') }}</textarea>
                    </div>
                    <div class="col-6">
                        <label for="inputAddress2" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="inputAddress2" name="slug" value="{{ old('slug') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="inputState" class="form-label">Parent category</label>
                        <select id="inputState" class="form-select" name="category_id">
                            <option>Choose...</option>
                            @foreach($categories as $item)
                                @php /** @var $item \App\Models\Blog\BlogCategory*/ @endphp
                                <option {{ old('category_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
