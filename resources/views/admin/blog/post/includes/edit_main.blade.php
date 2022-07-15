@php /** @var $post \App\Models\Blog\Post */ @endphp
<div class="card">

    <div class="card-header pb-2">


        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" href="#main-info" type="button" role="tab" aria-controls="home" aria-selected="true">Основные</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" href="#add-info" type="button" role="tab" aria-controls="profile" aria-selected="false">Дополнительные</button>
            </li>
            <li>
                @if($post->exists)
                    @if($post->is_published)
                        <div class="badge bg-success text-white m-2 mt-3">Опубликовано</div>
                    @else
                        <div class="badge bg-secondary text-white m-2 mt-3">Скрыто</div>
                    @endif
                @endif

            </li>
        </ul>
    </div>
    <div class="card-body">


        <div class="tab-content" id="myTabContent">
            <!-- Main info -->
            <div class="tab-pane fade show active" id="main-info" role="tabpanel" aria-labelledby="home-tab">


                <label for="title" class="form-label @error('title') text-danger @enderror">Заголовок</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $post->title) }}">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror

                <label for="content" class="form-label @error('content') text-danger @enderror">Текст</label>
                <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" cols="30"
                          rows="10">{{ old('content', $post->content) }}</textarea>
                @error('content')
                <p class="text-danger">{{ $message }}</p>
                @enderror


            </div>
            <!-- END Main info -->
            <!-- Addition info -->
            <div class="tab-pane fade" id="add-info" role="tabpanel" aria-labelledby="profile-tab">

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
                        <select id="category_id" class="browser-default custom-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option>Choose...</option>
                            @foreach($categories as $id => $title)
                                {{ $CategoryId = $post->exists ? $post->category->id : old('category_id') }}
                                <option {{ $CategoryId == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <label for="excerpt" class="form-label @error('excerpt') text-danger @enderror">Краткое Описание</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" id="excerpt" cols="30" rows="10">{{ old('excerpt', $post->excerpt) }}</textarea>
                @error('excerpt')
                <p class="text-danger">{{ $message }}</p>
                @enderror


                <div class="col">
                    <div class="mt-3 form-check">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" class="form-check-input" id="is_published" name="is_published" {{ $post->is_published ? 'checked="checked"' : '' }} value="1">
                        <label class="form-check-label" for="is_published">Опубликовано</label>
                    </div>
                </div>

            </div>
            <!-- END Addition info -->
        </div>


    </div>
</div>