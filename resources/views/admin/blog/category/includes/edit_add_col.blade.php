@php /** @var $category \App\Models\Blog\BlogCategory */ @endphp

<div class="card">
    <div class="card-body">
        <label for="disabledTextInput" class="form-label">Создано:</label>
        <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $category->created_at }}" disabled>

        @if( $category->created_at != $category->updated_at)
            <label for="disabledTextInput" class="form-label">Редактировано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $category->updated_at }}" disabled>
        @endif
    </div>
</div>

<div class="card mt-2">
    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
