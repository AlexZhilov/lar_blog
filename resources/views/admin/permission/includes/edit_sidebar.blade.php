@php /** @var $permission \App\Models\Permission\Permission */ @endphp
@if($permission->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $permission->created_at }}" disabled>

            @if( $permission->created_at != $permission->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $permission->updated_at }}" disabled>
            @endif

        </div>
    </div>

@endif

<div class="card {{ $permission->exists ? 'mt-3' : '' }}">

    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
