@php /** @var $user \App\Models\User\User */ @endphp
<div class="card">

    <div class="card-header pb-2">


        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" href="#main-info" type="button" role="tab" aria-controls="home" aria-selected="true">Основные</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" href="#add-info" type="button" role="tab" aria-controls="profile" aria-selected="false">Дополнительные</button>
            </li>
            <li>
                @if($user->exists)
                    @if($user->isActive())
                        <div class="badge bg-success text-white m-2 mt-3">Активен</div>
                    @else
                        <div class="badge bg-secondary text-white m-2 mt-3">Неактивен</div>
                    @endif
                @endif

            </li>
        </ul>
    </div>
    <div class="card-body">

        <div class="tab-content" id="myTabContent">
            <!-- Main info -->
            <div class="tab-pane fade show active" id="main-info" role="tabpanel" aria-labelledby="home-tab">

                <div class="row">
                    <div class="col-md-6">
                        <label for="title" class="form-label @error('name') text-danger @enderror">{{ __('Name') }}</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="title" class="form-label @error('email') text-danger @enderror">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        <x-admin.form.select for="select-roles" name="roles[]" title="Роли" multiple>
                            @foreach($roles as $id => $name)
                                <option @foreach($user->roles as $role) {{ $role->id === $id ? 'selected' : ''}} @endforeach value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </x-admin.form.select>
                    </div>

                    <div class="col-md-6">
                        <x-admin.form.select for="select-permissions" name="permissions[]" title="Права" multiple>
                            @foreach($permissions as $id => $name)
                                <option @foreach($user->permissions as $permission) {{ $permission->id === $id ? 'selected' : ''}} @endforeach value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </x-admin.form.select>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="main_image" class="@error('avatar') text-danger @enderror">{{ __('value.avatar') }}</label>
{{ d(image("$user->avatar")) }}
                            @if($user->exists && $user->avatar)
                                <div class="card image-wrap m-1 mb-3" style="width: 18rem;">
                                    <a href="{{ image("$user->avatar") }}" data-fancybox="gallery" data-caption="{{ $user->avatar }}">
                                        <img class="card-img-top" src="{{ image("$user->avatar") }}" alt="">
                                    </a>
                                    <div class="card-body">
                                        <p class="card-text">
                                            <span id="delete-image"
                                                  data-url="{{ route('admin.user.delete-image') }}"
                                                  data-id="{{ $user->id }}"
                                                  class="badge badge-warning">
                                                Удалить
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            @endif
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('avatar') is-invalid @enderror" id="main_image" name="avatar">
                                    <label class="custom-file-label" for="main_image">Выберите файл</label>
                                </div>
                            </div>
                            @error('image')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="accordion" id="accordionExample">
                          <div class="card">
                            <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                  Сменить пароль
                                </button>
                              </h2>
                            </div>

                            <div id="collapseOne" class="collapse @error('password') show @enderror" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">

                                <label for="title" class="form-label @error('password') text-danger @enderror">Пароль</label>
                                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror

                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Main info -->
            <!-- Addition info -->
            <div class="tab-pane fade" id="add-info" role="tabpanel" aria-labelledby="profile-tab">




            </div>
            <!-- END Addition info -->
        </div>


    </div>
</div>