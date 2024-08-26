@php /** @var $post \App\Models\Blog\Post */ @endphp
@if($post->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->created_at }}" disabled>

            @if( $post->created_at != $post->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->updated_at }}" disabled>
            @endif

            @if( $post->is_published )
                <label for="disabledTextInput" class="form-label">Опубликовано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->updated_at->diffForHumans() }}" disabled>
            @endif

            <label for="disabledTextInput" class="form-label">Просмотры:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $post->views }}" disabled>

            <x-admin.form.select class="mt-3" name="user_id" :title="__('Author')" required>
                <option>{{ __('Choose...') }}</option>
                @foreach($users as $id => $name)

                    {{ $UserId = $post->exists ? $post->user->id : old('user_id') }}
                    <option
                            {{ $UserId == $id ? 'selected' : ''}}
                            value="{{ $id }}"
                    >
                        {{ $name }}
                    </option>

                @endforeach
            </x-admin.form.select>


        </div>
    </div>

@endif

<div class="card {{ $post->exists ? 'mt-3' : '' }}">

    <div class="card-body text-center">

        <div class="mt-3 form-check">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" class="form-check-input switch-checkbox" id="is_published" name="is_published" {{ $post->is_published ? 'checked="checked"' : '' }} value="1">
            <label class="form-check-label" for="is_published">{{ $post->is_published ? 'Опубликовано' : 'Скрыто'}}</label>
        </div>
    </div>

    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
