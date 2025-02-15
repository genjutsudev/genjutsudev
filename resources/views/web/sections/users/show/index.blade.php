@props(['user'])

@section('title', 'users')

<x-layouts::main>
    <div class="container">
        {{-- Card --}}
        <div class="card">
            <div class="card-cover text-start p-5 d-flex" style="background-image: url(https://kitaku.noilty.com/static/media/default-cover.jpg); padding-bottom: 10rem !important;">
                <div class="d-none d-sm-block">
                    <div class="avatar avatar-xll" style="background-image: url(https://www.gravatar.com/avatar/9dcc550d0691ed1c0d52bf46ff7cb967?s=160&amp;d=identicon&amp;r=g)"></div>
                </div>
                <div class="text-light  ms-4" style="z-index: 999;">
                    <div class="h1 m-0">
                        <span>
                            {{ urldecode($user->profilename ?? $user->profilelink) }}
                        </span>{{-- TODO: components/ui --}}
                        <small style="font-size: 14px;" class="text-lowercase">
                            {{ $user->lastActivity() }}
                        </small>
                    </div>
                    <div class="h4 m-0">
                        <ol class="breadcrumb text-lowercase">
                            <li class="breadcrumb-item">Мужской</li>
                            <li class="breadcrumb-item">
                                <div class="d-flex">
                                    <div class="ms-1">
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="Участник 6 месяцев, 17 часов">на сайте с 2024 г.</span>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <x-ui.block
                {{-- Проверяем, что текущий пользователь пытается редактировать себя --}}
                :disabled="$user && Auth::user()?->id !== $user->id"
                class="card-footer d-flex align-items-center">
                <div class="flex-grow-1" style="font-size: 24px;">
                    @foreach([
                        'Друзья' => ['href' => '#', 'icon' => '<i class="fas fa-user-friends"></i>'],
                        'Подписки' => ['href' => '#', 'icon' => '<i class="fa fa-rss"></i>'],
                        'Комментарии' => ['href' => '#', 'icon' => '<i class="fa fa-comments"></i>'],
                        'Рецензии' => ['href' => '#', 'icon' => '<i class="fa fa-paint-brush"></i>'],
                        'Заявки' => ['href' => '#', 'icon' => '<i class="fa fa-ticket"></i>'],
                        'Жалобы' => ['href' => '#', 'icon' => '<i class="fa fa-warning"></i>'],
                        'Настройки' => ['href' => '/'/* route('users.show.edit.account', [$user->uid, $user->profilelink]) */, 'icon' => '<i class="fas fa-user-cog"></i>'],
                    ] as $title => $item)
                    <a
                        href="{{ $item['href'] }}"
                        @class(['me-3', 'link-azure', 'disabled' => $item['href'] === '#'])
                        class="pe-3 link-azure"
                        data-bs-toggle="tooltip"
                        data-bs-placement="bottom"
                        data-bs-original-title="{{ $title }}">
                        {!! $item['icon'] !!}
                    </a>
                    @endforeach
                </div>{{-- TODO: components/ui --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
                </svg>
                <form id="form-search" action="/" method="post" class="m-0">
                    @csrf
                    @method('put')
                    <label class="form-switch ps-3">
                        <input disabled type="checkbox" name="user_preferences[theme]" value="1" class="form-check-input m-0 me-3" style="cursor: pointer;" onchange="this.form.submit()">
                    </label>
                </form>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                </svg>
            </x-ui.block>
        </div>
    </div>
</x-layouts::main>
