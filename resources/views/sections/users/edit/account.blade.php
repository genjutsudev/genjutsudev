@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="row">
        <div class="col">
            {{-- profilename --}}
            <div class="mb-3 w-50">
                <label for="user_profilename" class="form-label">Имя профиля</label>
                <div class="input-group">
                    <input id="user_profilename" class="form-control" placeholder="{{ $user->profilename }}" autocomplete="off" disabled>
                    <a href="/users/1/Noilty/edit/profilename" class="btn" type="button" title="Изменить" style="width: 36px;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                            <path d="M13.5 6.5l4 4"></path>
                        </svg>
                    </a>
                </div>
            </div>
            {{-- profilelink --}}
            <form action="" method="post" class="mb-3">
                @method('put')
                @csrf
                <div class="mb-3 w-50">
                    <label for="user_profilelink" class="form-label">Ссылка профиля</label>
                    <div class="input-group">
                        <input id="user_profilelink" class="form-control" placeholder="{{ $user->profilelink }}" autocomplete="off" disabled>
                        <a href="/users/1/Noilty/edit/profilelink" class="btn" type="button" title="Изменить" style="width: 36px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil m-0" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                                <path d="M13.5 6.5l4 4"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- birthday --}}
                <div class="mb-3">
                    <div class="form-label">Дата рождения <b class="text-red">*</b></div>
                    <div class="row">
                        {{-- birthday.day --}}
                        <div class="col">
                            <select id="user_birthday_day" class="form-control">
                                <option value="" selected disabled>День</option>
                                @for($day = 31; $day >= 1; $day--)
                                    <option value="{{ $day }}">{{ $day }}</option>
                                @endfor
                            </select>
                        </div>
                        {{-- birthday.month --}}
                        <div class="col">
                            <select id="user_birthday_month" class="form-control">
                                <option value="" selected disabled>Месяц</option>
                                @for($month = 12; $month >= 1; $month--)
                                    <option value="{{ $month }}">
                                        {{ str_pad($month, 2, '0', STR_PAD_LEFT) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                        {{-- birthday.year --}}
                        <div class="col">
                            <select id="user_birthday_year" class="form-control">
                                <option value="" selected disabled>Год</option>
                                @for($year = date('Y'); $year >= 1971; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                {{-- gender --}}
                <div class="mb-3 w-50">
                    <label for="user_gender" class="form-label">Пол</label>
                    <select id="user_gender" class="form-control">
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
                        <input class="form-check-input" type="checkbox" value="1">
                        <span class="form-check-label">Отображать возраст в профиле</span>
                    </label>
                </div>
                {{-- content --}}
                <div class="mb-3">
                    <label class="form-check form-switch form-switch-3">
                        <input class="form-check-input" type="checkbox" value="1">
                        <span class="form-check-label">Отображать 18+ контент</span>
                    </label>
                </div>
                <div class="form-group text-end">
                    <input type="submit" value="Сохранить" class="btn btn-primary">
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
                            data-bs-original-title="Изменить e-mail и пароль"
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
                            data-bs-original-title="Сбросить пароль по e-mail"
                        >
                            <a href="/users/1/Noilty/edit/password">Сбросить</a>
                        </div>
                    </div>
                    <input id="user_password" class="form-control" type="password" placeholder="обновлён 1 год назад" disabled>
                </div>
            </x-ui.subheadline>
        </div>
        <div class="col">2</div>
    </div>
</x-layouts::users-edit>
