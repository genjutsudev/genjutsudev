<!DOCTYPE html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body data-bs-theme="light">
<div class="page">
    @include('header')
    <x-navbar.navbar-component />
    <div class="page-wrapper">
        {{-- <div class="page-header">page-header</div> --}}
        <div class="page-body">
            <div class="container">
                <div class="card-cover text-start p-5 d-flex" style="background-image: url({{ asset('static/media/default-cover.jpg') }}); padding-bottom: 9.5rem !important;">
                    <div class="gjsu-avatar-frame d-none d-sm-block me-4">
                        <div class="gjsu-avatar avatar avatar-xll rounded-circle">
                            <img class="rounded-circle" alt="{{ $user->profilename }}" src="{{ gravatar($user->email) }}">
                            <span class="gjsu-avatar-right-icon gjsu-avatar-icon-premium"></span>
                        </div>
                    </div>
                    <div class="text-light me-auto" style="z-index: 999;">
                        <div class="h1 m-0">
                        <span>
                            {{ $user->profilename }}
                        </span>
                        <small style="font-size: 14px;" class="text-lowercase">
                            {{ user_last_activity($user) }}
                        </small>
                        </div>
                        <div class="h4 m-0">
                            <ol class="breadcrumb text-lowercase">
                                @if(! $user->gender->isOther())
                                    <li class="breadcrumb-item">
                                        {{ user_gender_title($user) }}
                                    </li>
                                @endif
                                @if($user->birthday && $preferences->is_show_age)
                                    <li class="breadcrumb-item">
                                        {{ user_age_title($user) }}
                                    </li>
                                @endif
                                <li class="breadcrumb-item">
                                    <x-user-joined :user="$user"/>
                                </li>
                            </ol>
                        </div>
                    </div>
                    @auth
                        <div>
                            <button
                                class="btn btn-primary"
                                style="padding: 10px;"
                                data-bs-toggle="dropdown"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2 m-0"
                                >
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <path d="M4 6l16 0"/>
                                    <path d="M4 12l16 0"/>
                                    <path d="M4 18l16 0"/>
                                </svg>
                            </button>
                            <style>.nav-segmented-fix { min-width: 0; margin-top: 5px !important; padding: 0; }</style>
                            <div class="dropdown-menu dropdown-menu-end nav-segmented-fix">
                                <nav class="nav nav-segmented nav-segmented-vertical nav-3" role="tablist">
                                    {{-- Проверяем, что текущий пользователь пытается редактировать себя --}}
                                    @if($user && Auth::user()?->id === $user->id)
                                        @foreach([
                                            'Друзья' => ['routeName' => '#', 'icon' => '<i class="fas fa-user-friends"></i>'],
                                            'Комментарии' => ['routeName' => '#', 'icon' => '<i class="fa fa-comments"></i>'],
                                            'Рецензии' => ['routeName' => '#', 'icon' => '<i class="fa fa-paint-brush"></i>'],
                                            'Жалобы' => ['routeName' => '#', 'icon' => '<i class="fa fa-warning"></i>'],
                                            'Настройки' => ['routeName' => 'users.edit.account', 'icon' => '<i class="fas fa-user-cog"></i>'],
                                        ] as $title => $item)
                                            <a
                                                href="{{ $item['routeName'] !== '#' ? route($item['routeName'], [$user->nid, $user->profilelink]) : '/' }}"
                                                @class(['nav-link', 'justify-content-center', 'p-1', 'disabled' => $item['routeName'] === '#'])
                                                style="font-size: 16px"
                                                data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                data-bs-original-title="{{ $title }}"
                                            >
                                                <span>{!! $item['icon'] !!}</span>
                                            </a>
                                        @endforeach
                                    @else
                                        <a
                                            href="/"
                                            @class(['nav-link', 'justify-content-center', 'p-1'])
                                            style="font-size: 16px"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="left"
                                            data-bs-original-title="Заблокировать"
                                        >
                                            <i class="fa-solid fa-ban"></i>
                                        </a>
                                    @endif
                                </nav>
                            </div>
                        </div>
                    @endauth
                </div>
                <div class="card rounded-top-0">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs text-uppercase rounded-0 p-0" style="flex-wrap: nowrap; overflow-y: hidden;">
                            @foreach([
                                'Главная' => ['routeName' => 'users.show', 'activeClass' => 'bg-green-lt', 'icon' => '<i class="fas fa-home text-green"></i>'],
                                'Списки' => ['routeName' => 'users.show.lists.anime', 'activeClass' => 'bg-blue-lt', 'icon' => '<i class="fa fa-list text-azure" aria-hidden="true"></i>'],
                                'Коллекции' => ['routeName' => 'users.show.collections', 'activeClass' => 'bg-blue-lt', 'icon' => '<i class="fa-solid fa-layer-group text-azure"></i>'],
                                'Избранное' => ['routeName' => 'users.show.featured', 'activeClass' => 'bg-yellow-lt', 'icon' => '<i class="fa-solid fa-star text-yellow"></i>'],
                                'Следите' => ['routeName' => 'users.show.tracked', 'activeClass' => 'bg-red-lt', 'icon' => '<i class="fa-solid fa-heart" style="color: red;"></i>'],
                            ] as $title => $item)
                                <li class="nav-item">
                                    <a
                                        href="{{ $item['routeName'] !== '#' ? route($item['routeName'], [$user->nid, $user->profilelink]) : '/' }}"
                                        @class([
                                            'nav-link',
                                            'border-0',
                                            'rounded-0',
                                            'border-end',
                                            'p-3',
                                            "{$item['activeClass']}" => request()->routeIs($item['routeName']),
                                            'disabled' => $item['routeName'] === '#',
                                        ])
                                    >
                                        <span style="display: flex; align-items: center;">
                                            {!! $item['icon'] !!} <b style="margin-left: 8px;">{{ $title }}</b>
                                        </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div @class(['card-body', 'p-0' => request()->routeIs('*lists*')])>
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @include('footer')
    </div>
</div>
{{-- Libs JS --}}
</body>
</html>
