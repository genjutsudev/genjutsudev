@section('title', $title = 'Восстановление пароля')

<x-layouts::users-password>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ $title }}</h2>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Для завершения процедуры сброса пароля укажите новый пароль и подтвердите его.') }}
            </div>

            <form method="post" action="{{ route('password.store') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}" autocomplete="off">

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="d-none">Эл. почта</label>
                    <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" class="form-control" placeholder="Эл. почта" required>
                    <x-ui.input-errors :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="d-none">Новый пароль</label>
                    <input id="password" type="password" name="password" class="form-control" placeholder="Новый пароль" required>
                    <x-ui.input-errors :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="d-none">Подтвердите новый пароль</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" placeholder="Подтвердите новый пароль" required>
                    <x-ui.input-errors :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <input type="submit" value="Сохранить новый пароль" class="btn btn-primary"/>
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>

