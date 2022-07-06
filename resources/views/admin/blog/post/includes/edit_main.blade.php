@php /** @var $post \App\Models\Blog\BlogPost */ @endphp
<div class="card">
    <div class="card-body">
        <div class="col">
            <label for="title" class="form-label @error('title') text-danger @enderror">Заголовок</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="row">

            <div class="col">
                <label for="text" class="form-label @error('slug') text-danger @enderror">URL</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="text" name="slug" value="{{ old('slug', $post->slug) }}">
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="category_id" class="form-label @error('category_id') text-danger @enderror">Категория</label>
                <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                    <option>Choose...</option>
                    @foreach($categories as $id => $title)
                        {{ $CategoryId = $post->exists ? $post->category->id : old('category_id') }}
                        <option {{ $CategoryId == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <label for="excerpt" class="form-label @error('excerpt') text-danger @enderror">Краткое Описание</label>
            <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt" cols="30" rows="10">{{ old('excerpt', $post->excerpt) }}</textarea>
            @error('excerpt')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="col">
            <label for="content_raw" class="form-label @error('content_raw') text-danger @enderror">Краткое Описание</label>
            <textarea class="form-control @error('content_raw') is-invalid @enderror" name="content_raw" id="content_raw" cols="30" rows="10">{{ old('content_raw', $post->content_raw) }}</textarea>
            @error('content_raw')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>