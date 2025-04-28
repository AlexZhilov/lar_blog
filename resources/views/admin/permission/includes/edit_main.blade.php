@php /** @var $permission \App\Models\Permission\Permission */ @endphp
<div class="card">

    <div class="card-body">

        <div class="tab-content">
            <!-- Main info -->
            <div class="tab-pane fade show active" id="main-info" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class="col-md-6">
                        <label for="title" class="form-label @error('name') text-danger @enderror">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $permission->name) }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        <label for="title" class="form-label @error('slug') text-danger @enderror">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $permission->slug) }}">
                        @error('slug')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">

                        <x-admin.form.select for="select-roles" name="roles[]" title="Роли" multiple>
                            @foreach($roles as $id => $name)
                                <option
                                        @foreach($permission->roles as $role)
                                            {{ $role->id == $id ? 'selected' : ''}}
                                        @endforeach
                                        value="{{ $id }}"
                                >{{ $name }}</option>
                            @endforeach
                        </x-admin.form.select>
                    </div>

                    <div class="col-md-6">

                        <x-admin.form.select for="select-users" name="users[]" title="Пользователи" multiple>
                            @foreach($users as $id => $name)
                                <option
                                        @foreach($permission->users as $user)
                                            {{ $user->id == $id ? 'selected' : ''}}
                                        @endforeach
                                        value="{{ $id }}"
                                >{{ $name }}</option>
                            @endforeach
                        </x-admin.form.select>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <label for="title" class="form-label @error('text') text-danger @enderror">Описание</label>
                    <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text">{{ old('text', $permission->text) }}</textarea>
                    @error('text')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <!-- END Main info -->
        </div>


    </div>
</div>