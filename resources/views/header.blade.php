<header class="navbar navbar-expand-md py-2">
    <div class="container justify-content-start align-items-center">
        <button
            class="navbar-toggler mx-1 me-3 collapsed"
            style="font-size: 25px;"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbar-menu"
            aria-controls="navbar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="h1 navbar-brand navbar-brand-autodark d-none-navbar-horizontal p-0 pe-3">
            <a href="/" class="text-decoration-none text-uppercase" title="Домой">
                <div class="align-items-center">
                    <div class="d-flex font-vina-sans" style="font-size: 36px;">
                        genjut
                        <img
                            style="width: 38px; margin: 0 5px;"
                            src="{{ asset('static/media/sharingan.svg') }}"
                            alt="sharingan"
                        >
                        su
                    </div>
                </div>
            </a>
        </div>
        @if($boosty_url = env('BOOSTY_URL'))
        <div class="d-none d-md-block pe-2">
            <a
                href="{{ $boosty_url }}"
                class="btn py-2"
                target="_blank"
                rel="noreferrer"
                title="Внести свой вклад в развитие проекта"
            >
                <img
                    style="margin-right: 10px;"
                    src="{{ asset('static/media/boosty.png') }}"
                    width="18"
                    alt="Boosty"
                >
                <span class="text-uppercase">Стать спонсором</span>
            </a>
        </div>
        @endif
        <div class="flex-grow-1 d-none d-md-block pe-3">
            <a
                href="https://t.me/genjutsudev"
                class="btn p-0"
                target="_blank"
                rel="noreferrer"
                data-bs-toggle="tooltip"
                data-bs-placement="top"
                aria-label="Канал в Telegram"
                data-bs-original-title="Канал в Telegram"
            >
                <img
                    style="margin:5px;"
                    src="{{ asset('static/media/brands/telegram.svg') }}"
                    width="26"
                    alt="Telegram"
                >
            </a>
        </div>
        <div class="navbar-nav flex-row order-md-last align-items-center">
            @guest
                <a
                    href="#"
                    class="btn rounded text-uppercase"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-users-sing-in"
                >
                    <i class="fas fa-sign-in-alt me-2" style="font-size: 20px"></i>
                    Войти
                </a>
            @else
                @php($user = auth()->user())
                <div class="nav-item me-4 d-none d-md-flex">
                    <div class="btn-list justify-content-between" style="width: 80px;">
                        @foreach([
                            ['label' => 'Мои уведомления', 'icon' => 'fa fa-bell'],
                            ['label' => 'Мои сообщения', 'icon' => 'fa fa-envelope'],
                        ] as $link)
                            <a
                                href="/"
                                class="nav-link px-0 disabled"
                                title="{{ $link['label'] }}"
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                            >
                                <i class="{{ $link['icon'] }}" style="font-size: 30px;"></i>
                                <small class="badge badge-pill text-light bg-danger" style="top: 10px;">
                                    99
                                </small>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="nav-item me-4">
                    <a
                        href="{{ route('users.show', [$user->uid, $user->profilelink]) }}"
                        class="nav-link lh-1 text-reset p-0"
                    >
                        <span class="avatar avatar-sm" style="background-image: url(https://www.gravatar.com/avatar/9dcc550d0691ed1c0d52bf46ff7cb967?s=32&d=identicon&r=g)"></span>
                        <div class="d-none d-sm-block ps-2">
                            <div
                                @class([
                                    'fw-bold',
                                    'text-azure' => Route::isWith([
                                        'users.show', [$user->uid, $user->profilelink]
                                    ])
                                ])
                            >
                                {{ urldecode($user->profilename ?? $user->profilelink) }}
                            </div>{{-- TODO: components/ui --}}
                            <div class="mt-1 small text-muted text-uppercase">Профиль</div>
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <a
                        href="{{ route('logout') }}"
                        class="nav-link px-0"
                        title="Выйти"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="fas fa-sign-out-alt" style="font-size: 30px;"></i>
                        <form
                            id="logout-form"
                            action="{{ route('logout') }}"
                            method="POST"
                            class="d-none"
                        >
                            @csrf
                        </form>
                    </a>
                </div>
            @endguest
        </div>
        {{-- TODO: Modal --}}
        <x-ui.block
            :disabled="Auth::check()"
            class="modal modal-blur fade"
            id="modal-users-sing-in"
            tabindex="-1"
            style="display: none;"
            aria-hidden="true"
            data-bs-backdrop="static"
        >
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
                        {{-- <i class="fas fa-sign-in-alt me-2" style="font-size: 20px"></i> --}}
                        <div class="text-uppercase">
                            <div class="h1">
                                Вход
                            </div>
                            <div class="text-secondary">
                                Через социальные сети
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="disabled btn rounded w-100">
                                <img
                                    src="{{ asset('static/media/brands/shikimori.svg') }}"
                                    class="me-2" width="20"
                                    alt="Shikimori"
                                >
                                Shikimori
                            </a>
                        </div>
                    </div>
                    <div class="hr-text m-2">или</div>
                    <form method="post" action="{{-- {{ route('login.store') }} --}}">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label d-none" for="email">Email</label>
                                <input
                                    class="form-control"
                                    id="email"
                                    type="email"
                                    name="email"
                                    placeholder="Логин (Адрес эл. почты)"
                                    required="required"
                                    autocomplete="off"
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label d-none" for="password">Password</label>
                                <div class="input-group input-group-flat">
                                    <input
                                        class="form-control"
                                        id="password"
                                        type="password"
                                        name="password"
                                        placeholder="Пароль"
                                        required="required"
                                        autocomplete="new-password"
                                    >
                                    <span class="input-group-text">
                                        <a
                                            href="#"
                                            class="link-secondary disabled"
                                            data-bs-toggle="tooltip"
                                            aria-label="Show password"
                                            data-bs-original-title="Show password"
                                        >
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                                                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                                            </svg> --}}
                                        </a>
                                    </span>
                                    <a
                                        href="{{-- {{ route('password.request') }} --}}"
                                        class="btn p-2"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="left"
                                        data-bs-title="Забыли пароль?"
                                    >
                                        <i class="far fa-question-circle" style="font-size: 20px"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb1-2">
                                <label class="form-check m-0">
                                    <input type="checkbox" name="remember" class="form-check-input">
                                    <span class="form-check-label">
                                        {{-- Remember me on this device --}}
                                        Запомнить меня
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100 text-uppercase">
                                <div class="row">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sign-in-alt me-2" style="font-size: 20px"></i>
                                            Войти
                                        </button>
                                    </div>
                                    <div class="col">
                                        <a href="{{-- {{ route('register') }} --}}" class="btn w-100">
                                            Регистрация
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </x-ui.block>
    </div>
</header>
