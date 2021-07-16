<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">{{ __('Документооборот V2.0') }}
            <img src="{{ asset('storage/logo_white.png') }}" width="30" height="30" alt="" loading="lazy">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Меню
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">{{ __('Задачи') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{ __('Документы') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">{{ __('Журнал') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('Категории') }}</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
                        {{ __('Панель управления') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('users') }}">{{ __('Пользователи') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('role') }}">{{ __('Роли') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('permissions') }}">{{ __('Права') }}</a></li>
                        <li><a class="dropdown-item" href="#">{{ __('Логи') }}</a></li>
                    </ul>
                </li>
            </ul>

            @if(!Route::is('login'))
                <ul class="navbar-nav mb-2 mb-lg-0">
                    @guest
                        <a class="btn btn-outline-light" href="{{ route('login') }}" role="button">{{ __('Войти') }}</a>
                    @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        {{ __('Личный кабинет') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Выйти') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                    @endguest
                </ul>
            @endif
        </div>
    </div>
</nav>