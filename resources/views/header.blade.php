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
                            alt="Sharingan"
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
                    style="margin: 5px;"
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
                    <i class="fas fa-sign-in-alt me-2" style="font-size: 20px;"></i>
                    Войти
                </a>
            @else
                @php($user = auth()->user())
                <div class="nav-item me-4 d-none d-md-flex">
                    <div class="btn-list justify-content-between">
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
                <div class="nav-item me-3">
                    <a
                        href="{{ route('users.show', [$user->nid, $user->profilelink]) }}"
                        @class(['nav-link', 'lh-1', 'p-2', 'bg-azure-lt' => $user && $user->id == request()->user?->id])
                    >
                        <span class="avatar avatar-sm" style="background-image: url({{ gravatar($user->email) }});"></span>
                        <div class="d-none d-sm-block ps-2">
                            <div
                                @class([
                                    'fw-bold',
                                    'text-azure' => false/*Route::isWith([
                                        'users.show', [$user->nid, $user->profilelink]
                                    ])*/
                                ])
                            >
                                {{ $user->profilename }}
                            </div>{{-- TODO: components/ui --}}
                            <div class="mt-1 small text-muted text-uppercase">Профиль</div>
                        </div>
                    </a>
                </div>
                <div class="nav-item">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button
                            type="submit"
                            class="nav-link p-2"
                            title="Выйти"
                            data-bs-toggle="tooltip"
                            data-bs-placement="bottom"
                        >
                            <i class="fas fa-sign-out-alt" style="font-size: 30px;"></i>
                        </button>
                    </form>
                </div>
            @endguest
        </div>
        {{-- TODO: Modal --}}
        <x-ui.block
            id="modal-users-sing-in"
            class="modal modal-blur fade"
            style="display: none;"
            tabindex="-1"
            aria-hidden="true"
            data-bs-backdrop="static"
            :disabled="Auth::check()"
        >
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-status bg-success"></div>
                    <div class="modal-body text-center py-4">
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
                    <form method="post" action="{{ route('login.store') }}">
                        @csrf
                        <div class="modal-body">
                            <x-ui.form.email class="mb-3"/>
                            <x-ui.form.password class="mb-3">
                                <div class="col-12 text-end mt-2">
                                    <a
                                        href="{{ route('password.request') }}"
                                        class="btn btn-sm btn-ghost-info"
                                    >
                                        Забыли пароль?
                                    </a>
                                </div>
                            </x-ui.form.password>
                            <x-ui.form.remember/>
                        </div>
                        <div class="modal-footer">
                            <div class="w-100">
                                <div class="row">
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-success">
                                            <i class="fas fa-sign-in-alt me-2" style="font-size: 20px;"></i>
                                            Войти
                                        </button>
                                    </div>
                                    <div class="col text-uppercase">
                                        <a href=" {{ route('register') }}" class="btn w-100">
                                            Новый аккаунт
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
