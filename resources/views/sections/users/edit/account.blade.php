@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="row flex-lg-row flex-column-reverse">
        {{-- left --}}
        <div class="col-12 col-lg-6">
            {{-- profilename --}}
            <div class="mb-3">
                <label for="user_profilename" class="form-label">Имя профиля</label>
                <div class="input-group">
                    <input
                        id="user_profilename"
                        class="form-control"
                        value="{{ $user->profilename }}"
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
            <div class="mb-3">
                <label for="user_profilelink" class="form-label">Ссылка профиля</label>
                <div class="input-group">
                    <input
                        id="user_profilelink"
                        class="form-control"
                        value="{{ $user->profilelink }}"
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
            {{-- birthday --}}
            <div class="mb-3">
                <label for="user_birthday" class="form-label">Дата рождения</label>
                <div class="input-group">
                    @if($birthday = $user->birthday)
                        @php($label = $birthday->isoFormat('D MMMM YYYY') . ' (' . user_age_title($user) . ')')
                        <input id="user_birthday" class="form-control" value="{{ $label }}" disabled>
                    @else
                        <input id="user_birthday" class="form-control" value="{{ 'Не указана' }}" disabled>
                    @endif
                    <a
                        href="{{ route('users.edit.birthday', [$user->nid, $user->profilelink]) }}"
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
            <x-ui.form.index method="put" class="mb-3">
                {{-- gender --}}
                <div class="mb-3">
                    <label for="user_gender" class="form-label">Пол</label>
                    <select id="user_gender" name="user_gender" class="form-select">
                        @foreach(\App\Enums\UserGenderEnum::cases() as $gender)
                            <option
                                value="{{ $gender }}"
                                @selected($gender->equals($user->gender->getGender()))
                            >
                                {{ __('user.gender.' . $gender->value) }}
                            </option>
                        @endforeach
                    </select>
                    <x-ui.input-errors :messages="$errors->get('user_gender')"/>
                </div>
                {{-- age --}}
                @if($user->birthday)
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
                @endif
                {{-- content --}}
                @if($user->birthday && ($user->birthday->age >= 18))
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
                @endif
                <div class="form-group text-end">
                    <input type="submit" value="Сохранить" class="btn btn-primary">
                </div>
            </x-ui.form.index>
            {{-- security account --}}
            <x-ui.subheadline :label="__('Безопасность аккаунта')">
                {{-- email --}}
                <div class="mb-3">
                    <div class="form-label">
                        <label for="user_email">Эл. почта</label>
                        <div
                            class="form-label-description"
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Эл. почту и пароль"
                        >
                            <a href="{{ route('users.edit.password', [$user->nid, $user->profilelink]) }}">Изменить</a>
                        </div>
                    </div>
                    <div class="input-group">
                        <input
                            id="user_email"
                            type="email"
                            value="{{ $user->email }}"
                            class="form-control"
                            placeholder="отсутствует"
                            disabled
                        >
                        @if($user->email)
                            @php($is_verified = ! is_null($user->email_verified_at))
                            @php($tag = $is_verified ? 'div' : 'a')
                            <{{ $tag }}
                            @unless($is_verified)
                                href="{{ route('verification.notice') }}"
                                @class(['input-group-text', 'p-2', 'text-decoration-none'])
                            @else
                                @class(['input-group-text', 'p-2'])
                            @endunless
                                data-bs-toggle="tooltip"
                                data-bs-placement="left"
                                data-bs-original-title="{{ $is_verified ? 'Подтверждено' : 'Подтвердить' }}"
                            >
                                <span @class(['d-flex', 'text-success' => $is_verified, 'text-primary' => ! $is_verified])>
                                    <i style="font-size: 17px" @class([
                                        'fa-solid',
                                        'fa-circle-check' => $is_verified,
                                        'fa-envelope' => ! $is_verified
                                    ])></i>
                                </span>
                            </{{ $tag }}>
                        @endif
                    </div>{{-- @todo move to component --}}
                </div>
                {{-- password --}}
                <div>
                    @php($changed_at = $user->password_changed_at ?? $user->created_at)
                    <div class="form-label">
                        <label for="user_password">Пароль</label>
                        <div
                            class="form-label-description"
                            data-bs-toggle="tooltip"
                            data-bs-placement="left"
                            data-bs-original-title="Пароль по эл. почте"
                        >
                            <a href="{{ route('password.request', ['email' => $user->email]) }}">Сбросить</a>
                        </div>
                    </div>
                    <input
                        id="user_password"
                        class="form-control"
                        type="password"
                        placeholder="обновлён {{ $changed_at->diffForHumans() }}"
                        disabled
                    >
                </div>
            </x-ui.subheadline>
        </div>
        {{-- right --}}
        <div class="col-12 col-lg-6 mb-3">
            {{-- avatar, frame & cover --}}
            <div class="card mb-3">
                <div
                    class="card-cover d-flex rounded-0 text-start p-5"
                    style="background-image: url({{ asset('static/media/default-cover.jpg') }});"
                >
                    <div
                        class="avatar avatar-xll rounded-circle align-items-end"
                        style="background-image: url({{ user_avatar_url($user) }})"
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
                Нет данных
            </x-ui.subheadline>
        </div>
    </div>
</x-layouts::users-edit>
