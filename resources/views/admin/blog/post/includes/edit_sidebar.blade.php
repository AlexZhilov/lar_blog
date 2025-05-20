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

            @if( $post->published_at )

                <x-admin.form.input
                    name="published_at"
                    class="datepicker-input"
                    :value="$post->published_at"
                    type="text"
                    :title="$post->getAttributeLabel('published_at')"/>
            @endif

            <x-admin.form.input
                name="views"
                type="number"
                :value="$post->views"
                title="Просмотры"/>


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
            <input type="hidden" name="status" value="0">
            <input type="checkbox" class="form-check-input switch-checkbox" id="status" name="status" {{ $post->status ? 'checked="checked"' : '' }} value="1">
            <label class="form-check-label" for="status">{{ $post->status ? 'Опубликовано' : 'Скрыто'}}</label>
        </div>
    </div>

    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
