@php use App\Models\Role\Role; @endphp
@extends('adminlte::page')

@section('content')
    <div class="row p-2">

        <div class="card-body">

            <div class="col-12 card">
                <div class="card-body">

                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary">Создать роль</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Имя</th>
                            <th scope="col">Слаг</th>
                            <th scope="col">Принадлежит пользователям</th>
                            <th scope="col">Обновлено</th>
                            <th scope="col">Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($roles as $role)
                            @php /** @var $role Role */ @endphp
                            <tr>
                                <th scope="row">{{ $role->id }}.</th>
                                <td>
                                    <a href="{{ route('admin.roles.edit', $role->id) }}">{{ $role->name }}</a>
                                </td>
                                <td>{{ $role->slug }}</td>
                                <td>
                                    {{ $role->users->count() < 10
                                            ? "(".$role->users->count() .") " . $role->users->pluck('name')->implode(', ')
                                            : "(".$role->users->count() .") "
                                    }}
                                </td>
                                <td>{{ $role->updated_at }}</td>
                                <td>
                                    <x-admin.form.btn-delete
                                            :route="route('admin.roles.destroy', $role->id)"
                                            :id="$role->id"
                                            :name="$role->name"
                                            :icon="true"
                                    />
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $roles->onEachSide(1)->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection