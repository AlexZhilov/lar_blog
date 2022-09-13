@php /** @var $user \App\Models\User\User */ @endphp
@if($user->exists)

    <div class="card">
        <div class="card-body">
            <label for="disabledTextInput" class="form-label">Создано:</label>
            <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->created_at }}" disabled>

            @if( $user->created_at != $user->updated_at)
                <label for="disabledTextInput" class="form-label">Редактировано:</label>
                <input type="text" id="disabledTextInput" class="form-control" placeholder="{{ $user->updated_at }}" disabled>
            @endif
        </div>
    </div>

@endif

<div class="card {{ $user->exists ? 'mt-3' : '' }}">

    <div class="card-body text-center">

        <div class="mt-3 form-check">
            <input type="hidden" name="active" value="0">
            <input type="checkbox" class="form-check-input switch-checkbox" id="active" name="active" {{ $user->active ? 'checked="checked"' : '' }} value="1">
            <label class="form-check-label" for="active">{{ $user->active ? 'Активен' : 'Деактивирован'}}</label>
        </div>
    </div>

    <div class="card-body text-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</div>
