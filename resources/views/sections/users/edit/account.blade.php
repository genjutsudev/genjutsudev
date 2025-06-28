@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="row">
        <div class="col">
            {{-- profilename --}}
            <div class="mb-3 w-50">
                <label for="user_profilename" class="form-label">Имя профиля</label>
                <div class="input-group">
                    <input
                        id="user_profilename"
                        class="form-control"
                        placeholder="{{ $user->profilename }}"
                        autocomplete="off"
                        disabled
                    >
                    <a
                        href="{{ route('users.edit.profilename', [$user->nid, $user->profilelink]) }}"
                        class="btn"
                        type="button"
                        title="Изменить"
                        style="width: 36px;"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-pencil m-0"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                            <path d="M13.5 6.5l4 4"></path>
                        </svg>
                    </a>
                </div>
            </div>
            {{-- profilelink --}}
            <div class="mb-3 w-50">
                <label for="user_profilelink" class="form-label">Ссылка профиля</label>
                <div class="input-group">
                    <input
                        id="user_profilelink"
                        class="form-control"
                        placeholder="{{ $user->profilelink }}"
                        autocomplete="off"
                        disabled
                    >
                    <a
                        href="{{ route('users.edit.profilelink', [$user->nid, $user->profilelink]) }}"
                        class="btn"
                        type="button"
                        title="Изменить"
                        style="width: 36px;"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-pencil m-0"
                            width="24" height="24"
                            viewBox="0 0 24 24"
                            stroke-width="2"
                            stroke="currentColor"
                            fill="none"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                            <path d="M13.5 6.5l4 4"></path>
                        </svg>
                    </a>
                </div>
            </div>
            {{-- others --}}
            <form action="" method="post" class="mb-3">
                @method('put')
                @csrf
                {{-- birthday --}}
                <div class="mb-3">
                    <div class="form-label">Дата рождения <b class="text-red">*</b></div>
                    <div class="row">
                        {{-- birthday.day --}}
                        <div class="col">
                            <select id="user_birthday_day" name="user_birthday[day]" class="form-control" required>
                                <option value="" selected disabled>День</option>
                                @for($day = 31; $day >= 1; $day--)
                                    <option
                                        value="{{ $day }}"
                                        @selected($user->birthday->format('d') == $day)
                                    >
                                        {{ $day }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        {{-- birthday.month --}}
                        <div class="col">
                            <select id="user_birthday_month" name="user_birthday[month]" class="form-control" required>
                                <option value="" selected disabled>Месяц</option>
                                @for($month = 12; $month >= 1; $month--)
                                    <option
                                        value="{{ $month }}"
                                        @selected($user->birthday->format('m') == $month)
                                    >
                                        {{ str_pad($month, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        {{-- birthday.year --}}
                        <div class="col">
                            <select id="user_birthday_year" name="user_birthday[year]" class="form-control" required>
                                <option value="" selected disabled>Год</option>
                                @for($year = date('Y'); $year >= 1971; $year--)
                                    <option
                                        value="{{ $year }}"
                                        @selected($user->birthday->format('Y') == $year)
                                    >
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                {{-- gender --}}
                <div class="mb-3 w-50">
                    <label for="user_gender" class="form-label">Пол</label>
                    <select id="user_gender" name="user_gender" class="form-control">
                        @foreach(\App\Enums\UserGenderEnum::cases() as $gender)
                            <option
                                value="{{ $gender }}"
                                @selected($gender->equals($user->gender->getGender()))
                            >
                                {{ __('user.gender.' . $gender->value) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- age --}}
                <div class="mb-3">
                    <label class="form-check form-switch form-switch-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="user_preferences[is_show_age]"
                            value="1"
                            @checked($preferences->is_show_age)
                        >
                        <span class="form-check-label">Отображать возраст в профиле</span>
                    </label>
                </div>
                {{-- content --}}
                <div class="mb-3">
                    <label class="form-check form-switch form-switch-3">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="user_preferences[is_view_censored]"
                            value="1"
                            @checked($preferences->is_view_censored)
                        >
                        <span class="form-check-label">Отображать 18+ контент</span>
                    </label>
                </div>
                <div class="form-group text-end">
                    <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
                </div>
            </form>
            {{-- security account --}}
            <x-ui.subheadline :label="__('Безопасность аккаунта')">
                {{-- email --}}
                <div class="mb-3 w-50">
                    <div class="form-label">
                        <label for="user_email">Эл. почта</label>
                        <div
                            class="form-label-description"
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Эл. почту и пароль"
                        >
                            <a href="https://kitaku.noilty.com/users/Noilty/edit/password">Изменить</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <input id="user_email" type="email" value="{{ $user->email }}" class="form-control" disabled>
                        <div
                            class="input-group-text p-2"
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="{{ $user->email_verified_at ? 'Подтверждено' : 'Подтвердить' }}"
                        >
                            @if($user->email_verified_at)
                                <span class="d-flex text-azure">
                                    <i style="font-size: 18px" class="fa-solid fa-circle-check"></i>
                                </span>
                            @else
                                <a href="" class="d-flex link-azure text-decoration-none">
                                    <i style="font-size: 18px" class="fa-solid fa-envelope"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- password --}}
                <div class="w-50">
                    <div class="form-label">
                        <label for="user_password">Пароль</label>
                        <div
                            class="form-label-description"
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Пароль по эл. почте"
                        >
                            <a href="/users/1/Noilty/edit/password">Сбросить</a>
                        </div>
                    </div>
                    <input id="user_password" class="form-control" type="password" placeholder="обновлён 1 год назад" disabled>
                </div>
            </x-ui.subheadline>
        </div>
        <div class="col">
            {{-- avatar, frame & cover --}}
            <div class="card mb-3">
                <div
                    class="card-cover d-flex rounded-0 text-start p-5"
                    style="background-image: url({{ asset('static/media/default-cover.jpg') }});"
                >
                    <div class="me-4 d-none d-sm-block">
                        <div
                            class="avatar avatar-xll rounded-circle align-items-end"
                            style="background-image: url({{ gravatar($user->email) }})"
                        >
                            <a
                                href="/users/1/Noilty/edit/avatar"
                                class="position-absolute btn btn-sm btn-primary rounded-circle border-0 p-2 m-1 disabled"
                                style="right: 0;"
                                data-bs-toggle="tooltip"
                                data-bs-placement="right"
                                data-bs-original-title="Сменить аватар"
                            >
                                <i class="fa fa-pencil" style="font-size:16px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a
                    href="/users/1/Noilty/edit/cover"
                    class="position-absolute btn btn-sm btn-primary border-0 p-2 m-3 disabled"
                    style="right:0; bottom:0;"
                    data-bs-toggle="tooltip"
                    data-bs-placement="left"
                    data-bs-original-title="Сменить обложку"
                >
                    <i class="fa fa-pencil" style="font-size:16px;"></i>
                </a>
            </div>
            <x-ui.subheadline :label="__('Привязанные социальные сети')">
                networks
            </x-ui.subheadline>
        </div>
    </div>
</x-layouts::users-edit>
