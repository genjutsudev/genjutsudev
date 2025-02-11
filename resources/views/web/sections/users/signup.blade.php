@section('title', $title = 'Регистрация')

<x-layouts::main>
    <div class="container">
        <x-ui.page-title
            :h1="$title"
            :desc="__('На данной странице вы сможете зарегистрироваться на нашем сайте')" \
        />
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
        <form method="post" class="mb-4">
            @csrf
            <div class="mb-3">
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
            </div>
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
            <div class="mb-3">
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
                        </div>{{-- TODO: --}}
                    </div>{{-- TODO: --}}
                </x-ui.input-form-label>
                <x-ui.input-error :messages="$errors->get('password')" class="ps-3" />
            </div>
            <div class="mb-3">
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
                        </div>{{-- TODO: --}}
                    </div>{{-- TODO: --}}
                </x-ui.input-form-label>
            </div>
            <input class="btn btn-success" type="submit" value="Зарегистрироваться" />
        </form>
        <div class="h2">Что дает регистрация?</div>
        <ol class="ps-3">
            <li>сможете вести свои списки<b class="text-danger">[1]</b> просмотренного, того, что смотрите сейчас или планируете в будущем;</li>
            <li>будете получать уведомления о добавлении новых серий или продолжений аниме;</li>
            <li>сможете оставлять комментарии/отзывы/рецензии/оценки и переписываться с другими пользователями;</li>
            <li>менять тему сайта на темную;</li>
            <li>экспортировать списки в JSON/XML файл;</li>
            <li>импортировать списки из других источников<b class="text-danger">[2]</b>.</li>
        </ol>
        <div><b class="text-danger">1</b> Аниме из списков помечаются на всех страницах сайта.</div>
        <div><b class="text-danger">2</b> Поддерживает Shikimori JSON/XML и MyAnimeList XML списки.</div>
    </div>
</x-layouts::main>
