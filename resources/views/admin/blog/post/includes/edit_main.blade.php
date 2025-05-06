@php

    use App\Models\Blog\Post;
    use App\Models\Blog\Tag;

 /**
   * @var $post Post
    *@var $tags Tag[]
   */

@endphp
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

                <div class="row">

                    <x-admin.form.input
                            required
                            class="col-md-6"
                            name="title"
                            :value="$post->title"
                            :title="__('value.title')"/>

                    <x-admin.form.select class="col-md-6" name="category_id" :title="__('value.category')" required>
                        <option>{{ __('Choose...') }}</option>
                        @foreach($categories as $id => $title)
                            {{ $CategoryId = $post->exists ? $post->category->id : old('category_id') }}
                            <option {{ $CategoryId == $id ? 'selected' : ''}} value="{{ $id }}">{{ $title }}</option>
                        @endforeach
                    </x-admin.form.select>

                </div>

                <div class="row">

                    <x-admin.form.textarea
                            class="col-md-12"
                            required
                            summernote
                            name="content"
                            :value="$post->content"
                            :title=" __('value.content')"
                    />

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="main_image" class="@error('image') text-danger @enderror">Изображение</label>

                            @if($post->exists && $post->image)
                                <div class="card image-wrap m-1 mb-3" style="width: 18rem;">
                                    <a href="{{ image("$post->image") }}" data-fancybox="gallery" data-caption="{{ $post->image }}">
                                        <img class="card-img-top" src="{{ image("$post->image", 'preview') }}" alt="">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <span id="delete-image"
                                                  data-url="{{ route('admin.blog.post.delete-image') }}"
                                                  data-id="{{ $post->id }}"
                                                  class="badge badge-warning">
                                                Удалить
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="main_image" name="image">
                                    <label class="custom-file-label" for="main_image">Выберите файл</label>
                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
            <!-- END Main info -->
            <!-- Addition info -->
            <div class="tab-pane fade" id="add-info" role="tabpanel" aria-labelledby="profile-tab">

                <div class="row">


                    <x-admin.form.input
                            class="col-md-6"
                            name="slug"
                            :value="$post->slug"
                            title="URL"/>

                    @php  $postTags = old('tag') ?? $post->tags->pluck('id')->all() @endphp

                    <x-admin.form.select
                            id="select-tags"
                            class="col-md-6"
                            name="tag[]"
                            title="Теги"
                            multiple
                            tags
                    >
                        @foreach($tags as $id => $tag)
                            <option
                                    {{ in_array($id, $postTags) ? 'selected' : ''}}
                                    value="{{ $id }}">{{ $tag }}
                            </option>
                        @endforeach
                    </x-admin.form.select>

                </div>

                <x-admin.form.textarea
                        name="excerpt"
                        :value="$post->excerpt"
                        title="Краткое Описание"
                        required
                />

            </div>
            <!-- END Addition info -->
        </div>


    </div>
</div>