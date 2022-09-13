@extends('adminlte::page')

@section('content')
    <div class="row p-2 pt-4">

        <div class="col-12 card">
            <div class="card-body">

                <a href="{{ route('admin.user.create') }}" class="btn btn-primary">Создать пользователя</a>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
{{--                        <th scope="col">Роль</th>--}}
                        <th scope="col">Имя</th>
                        <th scope="col">email</th>
                        <th scope="col">Обновлено</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        @php /** @var $user \App\Models\User\User */ @endphp
                        <tr {!! !$user->active ? 'style="opacity:.3"' : '' !!}>
                            <th scope="row">{{ $user->id }}.</th>
{{--                            <td>{{ $user->roles->name ?? ''}}</td>--}}
                            <td><a href="{{ route('admin.user.edit', $user->id) }}">{{ $user->name }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('d.m.Y H:m:s') }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                {{ $users->onEachSide(1)->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection