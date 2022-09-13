@php /** @var $user \App\Models\User\User */ @endphp

@if($user->exists)

    <div class="col-md-8">
        <div class="card mt-2">
            <div class="card-body d-flex justify-content-end">
                <span class="auth-user btn btn-info mr-3" data-id="{{ $user->id }}" data-url="{{ route('admin.user.auth-user') }}">Авторизация</span>
                <form action="{{ route('admin.blog.post.destroy', $user->id) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteUserModal">Удалить</button>
                    @include('admin.includes.modal', [
                        'modal_id' => 'deleteUserModal',
                        'modal_body' => "Удалить пользователя <b>{$user->name}</b>?",
                    ])
                </form>
            </div>
        </div>
    </div>

@endif