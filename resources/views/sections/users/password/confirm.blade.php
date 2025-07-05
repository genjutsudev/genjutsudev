@section('title', $title = 'Введите текущий пароль что-бы продолжить')

<x-layouts::users-password>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Введите текущий пароль</h2>
            <div class="mb-4 text-sm text-gray-600">
                Это защищенная область приложения. Пожалуйста, подтвердите свой пароль, прежде чем продолжить.
            </div>
            <x-ui.form.index action="{{ route('password.confirm') }}">
                <div class="mb-3">
                    <x-ui.form.label for="user_password" required>Пароль</x-ui.form.label>
                    <x-ui.form.input.password
                        id="user_password"
                        name="user_password"
                        autocomplete="current-password"
                        required
                        :is_invalid="$errors->has('password')"
                    />
                    <x-ui.input-errors :messages="$errors->get('password')"/>
                </div>
                <div class="form-group text-end">
                    <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
                    <input type="submit" value="Продолжить" class="btn btn-sm btn-secondary px-2 py-1">
                </div>
            </x-ui.form.index>
        </div>
    </div>
    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>
