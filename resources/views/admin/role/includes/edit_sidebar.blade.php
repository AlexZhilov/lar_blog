@php /** @var $role \App\Models\Role\Role */ @endphp
@if($role->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $role->created_at }}" disabled>

            @if( $role->created_at != $role->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $role->updated_at }}" disabled>
            @endif

        </div>
    </div>

@endif

<div class="card {{ $role->exists ? 'mt-3' : '' }}">

    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
