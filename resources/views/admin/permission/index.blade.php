@php use App\Models\Permission\Permission; @endphp
@extends('adminlte::page')

@section('content')
    <div class="row p-2">

        <div class="card-body">

            <div class="col-12 card">
                <div class="card-body">

                    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary">Создать разрешение</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Слаг</th>
                            <th scope="col">Принадлежит роли</th>
                            <th scope="col">Принадлежит пользователям</th>
                            <th scope="col">Обновлено</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($permissions as $permission)
                            @php /** @var $permission Permission */ @endphp
                            <tr>
                                <th scope="row">{{ $permission->id }}.</th>
                                <td>
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}">{{ $permission->name }}</a>
                                </td>
                                <td>{{ $permission->slug }}</td>
                                <td>{{ $permission->roles->pluck('name')->implode(', ') }}</td>
                                <td>{{ $permission->users->pluck('name')->implode(', ') }}</td>
                                <td>{{ $permission->updated_at }}</td>
                                <td>
                                    <x-admin.form.btn-delete
                                            :route="route('admin.permissions.destroy', $permission->id)"
                                            :id="$permission->id"
                                            :name="$permission->name"
                                            :icon="true"
                                    />
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $permissions->onEachSide(1)->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection