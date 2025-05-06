@extends('adminlte::page')

@section('content')
    <div class="row p-2">

<div class="card-body">
            <!-- Форма фильтрации -->
            <div class="filter-form mb-4">
                <div class="card">
                    <div class="card-header">
                        <a data-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="true">
                            <i class="fas fa-filter"></i> Фильтры
                        </a>
                    </div>
                    <div class="collapse show" id="filterCollapse">
                        <div class="card-body">
                            <form action="{{ route('admin.user.index') }}" method="GET">
                                <div class="row">
                                    <!-- Поиск -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Поиск</label>
                                            <input type="text" name="filter[search]" class="form-control"
                                                placeholder="Поиск по имени или email"
                                                value="{{ request('filter.search') }}">
                                        </div>
                                    </div>

                                    <!-- Роль -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Роль</label>
                                            <select name="filter[role]" class="form-control select2">
                                                <option value="">Все роли</option>
                                                @foreach($roles as $value => $label)
                                                    <option value="{{ $value }}" {{ request('filter.role') == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
{{--                                    <!-- Верификация -->--}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Верификация email</label>
                                            <select name="filter[verified]" class="form-control select2">
                                                <option value="">Все</option>
                                                <option value="yes" {{ request('filter.verified') === 'yes' ? 'selected' : '' }}>Активен</option>
                                                <option value="no" {{ request('filter.verified') === 'no' ? 'selected' : '' }}>Неактивен</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Последний вход -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Последний вход</label>
                                            <select name="filter[last_login]" class="form-control select2">
                                                <option value="">Любое время</option>
                                                <option value="today" {{ request('filter.last_login') === 'today' ? 'selected' : '' }}>Сегодня</option>
                                                <option value="week" {{ request('filter.last_login') === 'week' ? 'selected' : '' }}>За неделю</option>
                                                <option value="month" {{ request('filter.last_login') === 'month' ? 'selected' : '' }}>За месяц</option>
                                                <option value="year" {{ request('filter.last_login') === 'year' ? 'selected' : '' }}>За год</option>
                                                <option value="never" {{ request('filter.last_login') === 'never' ? 'selected' : '' }}>Никогда</option>
                                            </select>
                                        </div>
                                    </div>

{{--                                    <!-- Количество постов -->--}}
{{--                                    <div class="col-md-3">--}}
{{--                                        <div class="form-group">--}}
{{--                                            <label>Количество постов</label>--}}
{{--                                            <select name="filter[post_count]" class="form-control">--}}
{{--                                                <option value="">Любое количество</option>--}}
{{--                                                <option value="0,0" {{ request('filter.post_count') === '0,0' ? 'selected' : '' }}>Нет постов</option>--}}
{{--                                                <option value="1,5" {{ request('filter.post_count') === '1,5' ? 'selected' : '' }}>1-5 постов</option>--}}
{{--                                                <option value="6,20" {{ request('filter.post_count') === '6,20' ? 'selected' : '' }}>6-20 постов</option>--}}
{{--                                                <option value="21,100" {{ request('filter.post_count') === '21,100' ? 'selected' : '' }}>21-100 постов</option>--}}
{{--                                                <option value="101,10000" {{ request('filter.post_count') === '101,10000' ? 'selected' : '' }}>Более 100</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <!-- Дата регистрации -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Дата регистрации</label>
                                            <div class="input-group">
                                                <input type="text" name="filter[created_between]" class="form-control"
                                                    value="{{ explode(',', request('filter.created_between', ','))[0] ?? '' }}"
                                                    placeholder="От">
                                                <input type="text" name="filter[created_between]" class="form-control"
                                                    value="{{ explode(',', request('filter.created_between', ','))[1] ?? '' }}"
                                                    placeholder="До">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Количество элементов на странице -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Элементов на странице</label>
                                            <select name="per_page" class="form-control select2">
                                                <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15</option>
                                                <option value="30" {{ request('per_page') == 30 ? 'selected' : '' }}>30</option>
                                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-9 text-right">
                                        <div class="form-group mt-4">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-search"></i> Применить фильтры
                                            </button>
                                            <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">
                                                <i class="fas fa-times"></i> Сбросить
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


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
                        <th scope="col">Роли</th>
                        <th scope="col">Последняя активность</th>
                        <th scope="col">Обновлено</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        @php /** @var $user \App\Models\User\User */ @endphp
                        <tr>
                            <th scope="row">{{ $user->id }}.</th>
{{--                            <td>{{ $user->roles->name ?? ''}}</td>--}}
                            <td {!! !$user->isActive() ? 'style="opacity:.3"' : '' !!}>
                                <a href="{{ route('admin.user.edit', $user->id) }}">
                                    {{ $user->name }}
                                    @unless ($user->isActive())
                                        <span class="badge badge-secondary">Неактивен</span>
                                    @endif
                                </a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                            <td>{{ $user->last_activity ? $user->last_activity_format : ' -- ' }}</td>
                            <td>{{ $user->updated_at_format }}</td>
                            <td>
                                <x-admin.form.btn-delete
                                        :route="route('admin.user.destroy', $user->id)"
                                        :id="$user->id"
                                        :name="$user->name"
                                        :icon="true"
                                />
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $users->onEachSide(1)->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection