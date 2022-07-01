@php /** @var $category \App\Models\Blog\BlogCategory */ @endphp
<div class="card">
    <div class="card-body">
        <div class="col">
            <label for="title" class="form-label @error('title') text-danger @enderror">Заголовок</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $category->title) }}">
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="row">

            <div class="col">
                <label for="text" class="form-label @error('slug') text-danger @enderror">URL</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="text" name="slug" value="{{ old('slug', $category->slug) }}">
                @error('slug')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <label for="category_id" class="form-label @error('parent_id') text-danger @enderror">Родитель</label>
                <select id="category_id" class="form-select @error('parent_id') is-invalid @enderror" name="parent_id">
                    <option>Choose...</option>
                    @foreach($categories as $id => $title)
                        <option {{ $category->parent_id == $id || old('parent_id') == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <label for="description" class="form-label @error('description') text-danger @enderror">Описание</label>
            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="10">{{ old('description', $category->description) }}</textarea>
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>