<div class="col-lg-4 col-md-5">
    <div class="blog__sidebar">

        <div class="blog__sidebar__item">
            <h4>Панель управления</h4>
            <ul>
                <li><a href="{{ route('user.index') }}">{{ __('User account') }}</a></li>
            </ul>
        </div>

        <div class="blog__sidebar__item">
            <h4>{{ __("Posts") }}</h4>
            <ul>
                <li {{ request()->routeIs('user.blog.post') ? 'class=active' : '' }}><a href="{{ route('user.blog.post') }}">{{ __('My posts') }}</a></li>
                <li><a href="{{ route('user.blog.comment') }}">{{ __('My comments') }}</a></li>
                <li><a href="{{ route('user.blog.like') }}">{{ __('Liked posts') }}</a></li>
            </ul>
        </div>
        <div class="blog__sidebar__item">
            <h4>Управление аккаунтом</h4>
            <ul>
                <li><a href="#">Настройки профиля</a></li>
                <li><a href="#">Изменить пароль</a></li>
            </ul>
        </div>
    </div>

</div>