@props([
    'id',
    'name',
    'icon' => false,
    'route',
])

<form action="{{ $route }}" method="post">
    @method('delete')
    @csrf

    @if($icon)
        <button type="button" class="btn btn-danger p-1 " data-toggle="modal" data-target="#deleteUserModal_{{ $id }}"><i class="fa fa-trash"></i></button>
    @else
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal_{{ $id }}">Удалить</button>
    @endif
    @include('admin.includes.modal', [
        'modal_id' => 'deleteUserModal_' . $id,
        'modal_body' => "Удалить <b>{$name}</b>?",
    ])
</form>