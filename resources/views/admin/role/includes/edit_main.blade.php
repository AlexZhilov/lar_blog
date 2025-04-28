@php /** @var $role \App\Models\Role\Role */ @endphp
<div class="card">
    <div class="card-header pb-2">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" href="#main-info" type="button" role="tab" aria-controls="home" aria-selected="true">Роль</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" href="#permissions" type="button" role="tab" aria-controls="profile" aria-selected="false">Разрешения</button>
            </li>
        </ul>
    </div>

    <div class="card-body">

        <div class="tab-content">
            <!-- Main info -->
            <div class="tab-pane fade show active" id="main-info" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class="col-md-6">
                        <label for="title" class="form-label @error('name') text-danger @enderror">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label for="title" class="form-label @error('slug') text-danger @enderror">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $role->slug) }}">
                        @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <x-admin.form.select for="select-users" name="users[]" title="Пользователи" multiple>
                            @foreach($users as $id => $name)
                                <option
                                        @foreach($role->users as $user)
                                            {{ $user->id == $id ? 'selected' : ''}}
                                        @endforeach
                                        value="{{ $id }}"
                                >{{ $name }}</option>
                            @endforeach
                        </x-admin.form.select>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label for="title" class="form-label @error('text') text-danger @enderror">Описание</label>
                        <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text">{{ old('text', $role->text) }}</textarea>
                        @error('text')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- END Main info -->
            </div>

            <div class="tab-pane fade" id="permissions" role="tabpanel" aria-labelledby="profile-tab">


                <div class="row">

                    <div class="col-md-12">

                        <label for="title" class="form-label @error('permissions') text-danger @enderror mb-2">Разрешения текущей роли</label>
                        @foreach($permissions as $id => $name)
                            <div class="form-check mb-1">
                                <input
                                        type="checkbox"
                                        class="form-check-input"
                                        id="permission_{{ $id }}"
                                        name="permissions[]"
                                        value="{{ $id }}"
                                        {{ in_array($id, old('permissions', [])) || $role->permissions->contains($id) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="permission_{{ $id }}">{{ $name }}</label>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>