@section('title', $title = 'Регистрация')

<x-layouts::main>
    <div class="container">
        <x-ui.page-title
            :h1="$title"
            desc="На данной странице вы сможете зарегистрироваться на нашем сайте"
        />
        <x-ui.block :disabled="true">
            <p>Условия регистраци:</p>
            <ol class="ps-3">
                <li>Все поля - обязательные.</li>
                <li>Вводите только рабочий корректный адрес эл. почты (email), он используется для восстановления пароля.</li>
                {{-- <li>Имя пользователя (Никнейм) должен быть уникальным в пределах сайта.</li> --}}
                {{-- <li>Не рекомендуем использовать в нике спецсимволы и совмещать латиницу и кириллицу (русские буквы).</li> --}}
            </ol>
            <p>Регистрируясь на нашем сайте вы автоматически соглашаетесь соблюдать <a href="{{ route('rules') }}?ref=register">правила</a>.</p>
            {{-- <p>После заполнения формы вам на адрес эл. почты (e-mail) придет письмо с подтверждением.</p> --}}
            {{-- <p>Отправка писем на сервера @ex.ua, @i.ua, @online.ua, @meta.ua не поддерживается, используйте другие почтовые сервисы.</p> --}}
        </x-ui.block>
        <form method="post" class="mb-4 col-6">
            @csrf
            {{-- <div class="mb-3">
                <x-ui.input-form-label>
                    <div class="form-label d-none">Адрес эл. почты (Логин)</div>
                    <x-ui.input-form-control
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Адрес эл. почты (Логин)"
                        autocomplete="off"
                        required
                    />
                </x-ui.input-form-label>
                <x-ui.input-error :messages="$errors->get('email')" class="ps-3" />
            </div> --}}
            <x-ui.form.email class="mb-3"/>
            {{-- <div class="mb-3">
                <x-ui.input-form-label>
                    <div class="form-label d-none">Nickname</div>
                    <x-ui.input-form-control
                        type="text"
                        name="nickname"
                        value="{{ old('nickname') }}"
                        placeholder="Ваш ник, под ним вас будут видеть другие пользователи"
                        autocomplete="off"
                        required
                    />
                </x-ui.input-form-label>
                <x-ui.input-error :messages="$errors->get('nickname')" class="ps-3" />
            </div> --}}
            {{-- <div class="mb-3">
                <x-ui.input-form-label>
                    <div class="form-label d-none">Password</div>
                    <div class="input-group input-group-flat">
                        <x-ui.input-form-control
                            type="password"
                            name="password"
                            placeholder="Пароль"
                            autocomplete="new-password"
                            required
                        />
                        <div class="input-group-text py-0">
                            <a href="#" class="link-secondary disabled" data-bs-toggle="tooltip" data-bs-original-title="Показать пароль">
                                <i class="far fa-eye" style="font-size: 20px;"></i>
                            </a>
                        </div>
                    </div>
                </x-ui.input-form-label>
                <x-ui.input-error :messages="$errors->get('password')" class="ps-3" />
            </div> --}}
            <x-ui.form.password class="mb-3"/>
            {{-- <div class="mb-3">
                <x-ui.input-form-label>
                    <div class="form-label d-none">Confirm Password</div>
                    <div class="input-group input-group-flat">
                        <x-ui.input-form-control
                            type="password"
                            name="password_confirmation"
                            placeholder="Повтор пароля"
                            autocomplete="new-password"
                            required
                        />
                        <div class="input-group-text py-0">
                            <a href="#" class="link-secondary disabled" data-bs-toggle="tooltip" data-bs-original-title="Показать пароль">
                                <i class="far fa-eye" style="font-size: 20px;"></i>
                            </a>
                        </div>
                    </div>
                </x-ui.input-form-label>
            </div> --}}
            <x-ui.form.password-confirm class="mb-3"/>
            <input class="btn btn-primary" type="submit" value="Зарегистрироваться" />
        </form>
        <div class="h2">Что дает регистрация?</div>
        <ol class="ps-3">
            <li>Возможность вести свои списки<b class="text-danger">[1]</b>: просмотренного, того, что смотрите сейчас, или запланированного на будущее.</li>
            <li>Оставлять комментарии, отзывы, рецензии, ставить оценки и общаться с другими пользователями.</li>
            <li>Подписываться на обновления интересующих аниме и манги.</li>
            <li>Получать уведомления о выходе новых серий или продолжениях аниме.</li>
            <li>Добавлять любимые произведения, персонажей и авторов в избранное.</li>
            <li>Создавать клубы по интересам и участвовать в совместных обсуждениях.</li>
            <li>Использовать систему достижений и получать награды за активность на сайте.</li>
            <li>Получать персональные рекомендации на основе ваших оценок и предпочтений.</li>
            <li>Менять тему оформления сайта на тёмную.</li>
            <li>Экспортировать списки в файлы форматов JSON или XML.</li>
            <li>Импортировать списки из других источников<b class="text-danger">[2]</b>.</li>
        </ol>
        <div><b class="text-danger">1</b> Аниме из ваших списков будут отмечаться на всех страницах сайта.</div>
        <div><b class="text-danger">2</b> Поддерживаются списки в форматах Shikimori (JSON/XML) и MyAnimeList (XML).</div>
    </div>
</x-layouts::main>
