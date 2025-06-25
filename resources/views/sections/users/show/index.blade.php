@props(['user'])

@section('title', $user->profilename)

<x-layouts::main>
    <div class="container">
        {{-- Card --}}
        <div class="card">
            <div
                class="card-cover text-start p-5 d-flex"
                style="background-image: url({{ asset('static/media/default-cover.jpg') }}); padding-bottom: 10rem !important;"
            >
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
                        </span>{{-- TODO: components/ui --}}
                        <small style="font-size: 14px;" class="text-lowercase">
                            {{ user_last_activity($user) }}
                        </small>
                    </div>
                    <div class="h4 m-0">
                        <ol class="breadcrumb text-lowercase">
                            @if(! $user->gender->isOther())
                                <li class="breadcrumb-item">{{ user_gender_title($user) }}</li>
                            @endif
                            <li class="breadcrumb-item">
                                <x-user-joined :user="$user"/>
                            </li>
                        </ol>
                    </div>
                </div>
                <div>
                    <button class="btn btn-primary" style="padding: 10px;" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show app menu" data-bs-auto-close="outside" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-menu-2 m-0">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 6l16 0"/>
                            <path d="M4 12l16 0"/>
                            <path d="M4 18l16 0"/>
                        </svg>
                    </button>
                    <style>.nav-segmented-fix { min-width: 0; margin-top: 5px !important; padding: 0; }</style>
                    <div class="dropdown-menu dropdown-menu-end nav-segmented-fix">
                        <nav class="nav nav-segmented nav-segmented-vertical nav-3" role="tablist">
                            @foreach([
                                'Друзья' => ['href' => '#', 'icon' => '<i class="fas fa-user-friends"></i>'],
                                'Комментарии' => ['href' => '#', 'icon' => '<i class="fa fa-comments"></i>'],
                                'Рецензии' => ['href' => '#', 'icon' => '<i class="fa fa-paint-brush"></i>'],
                                'Жалобы' => ['href' => '#', 'icon' => '<i class="fa fa-warning"></i>'],
                                'Настройки' => ['href' => '/', 'icon' => '<i class="fas fa-user-cog"></i>'],
                            ] as $title => $item)
                                <a
                                    href="{{ $item['href'] }}"
                                    @class(['nav-link', 'justify-content-center', 'p-1', 'disabled' => $item['href'] === '#'])
                                    style="font-size: 16px"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="left"
                                    data-bs-original-title="{{ $title }}"
                                >
                                    {!! $item['icon'] !!}
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
            <x-ui.block
                {{-- Проверяем, что текущий пользователь пытается редактировать себя --}}
                :disabled="$user && Auth::user()?->id !== $user->id"
                class="card-footer border-0 m-0">
                <div class="d-flex">
                    <div class="d-flex me-auto text-uppercase" style="font-size: 16px;">
                        @foreach([
                            'Главная' => ['href' => route('users.show', [$user->nid, $user->profilelink]), 'icon' => '<i class="fas fa-home text-green"></i>'],
                            'Коллекции' => ['href' => '/', 'icon' => '<i class="fa-solid fa-layer-group"></i>'],
                            'Коллекция' => ['href' => '/', 'icon' => '<i class="fa-solid fa-star text-yellow"></i>'],
                            'Следите' => ['href' => '/', 'icon' => '<i class="fa-solid fa-heart" style="color: red;"></i>'],
                        ] as $title => $item)
                            <a
                                href="{{ $item['href'] }}"
                                @class(['me-3', 'link-azure btn', 'text-decoration-none', 'disabled' => $item['href'] === '#'])
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                data-bs-original-title="{{ $title }}">
                                <span>{!! $item['icon'] !!} <small><b>{{ $title }}</b></small></span>
                            </a>
                        @endforeach
                    </div>{{-- TODO: components/ui --}}
                    <div class="d-flex align-items-center d-none d-sm-flex">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                            <path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7"></path>
                        </svg>
                        <form action="/" method="post" class="m-0">
                            @method('put')
                            @csrf
                            <label class="form-switch ps-3">
                                <input disabled type="checkbox" name="user_preferences[theme]" value="1" class="form-check-input m-0 me-3" style="cursor: pointer;" onchange="this.form.submit()">
                            </label>
                        </form>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z"></path>
                        </svg>
                    </div>
                </div>
            </x-ui.block>
        </div>
    </div>
</x-layouts::main>
