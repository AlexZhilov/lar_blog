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
        </div>
    </div>

@endif

<div class="card {{ $post->exists ? 'mt-3' : '' }}">
    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
