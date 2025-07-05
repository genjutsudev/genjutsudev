@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="alert alert-info">
        Изменение эл. почты потребует повторного подтверждения через письмо.<br/>
        Это необходимо для подтверждения, что новый адрес электронной почты действительно принадлежит вам.
    </div>
    <x-ui.form.index method="put" class="w-50">
        {{-- email --}}
        <div class="mb-3">
            <x-ui.form.label for="email" class="form-label" required>
                Эл. почта
            </x-ui.form.label>
            <x-ui.form.input.email
                id="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                placeholder="{{ $user->email }}"
                autocomplete="off"
                required
                :is_invalid="$errors->has('email')"
            />
            <x-ui.input-errors :messages="$errors->get('email')"/>
        </div>
        {{-- new password --}}
        <div class="mb-3">
            <x-ui.form.label for="password" class="form-label">
                Новый пароль
            </x-ui.form.label>
            <div class="input-group input-group-flat">
                <x-ui.form.input.password
                    id="password"
                    name="password"
                    autocomplete="new-password"
                    :is_invalid="$errors->has('password')"
                />
                <span class="input-group-text">
                    <a href="/"
                       class="disabled link-secondary"
                       data-bs-toggle="tooltip"
                       data-bs-original-title="Показать пароль"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon"
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
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                        </svg>
                    </a>
                </span>
            </div>
            <small>Чувствителен к регистру</small>
            <x-ui.input-errors :messages="$errors->get('password')"/>
        </div>
        {{-- confirm new password --}}
        <div class="mb-3">
            <x-ui.form.label for="password_confirmation" class="form-label">
                Повторите новый пороль
            </x-ui.form.label>
            <div class="input-group input-group-flat">
                <x-ui.form.input.password
                    id="password_confirmation"
                    name="password_confirmation"
                />
                <span class="input-group-text">
                    <a href="#"
                       class="disabled link-secondary"
                       data-bs-toggle="tooltip"
                       data-bs-original-title="Показать пароль"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="icon"
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
                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
