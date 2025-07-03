@section('title', $title = 'Введите пароль что-бы продолжить')

<x-layouts::users-password>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Пароль к вашей учетной записи</h2>

            <div class="mb-4 text-sm text-gray-600">
                Это защищенная область приложения. Пожалуйста, подтвердите свой пароль, прежде чем продолжить.
            </div>

            <form method="post" action="{{ route('password.confirm') }}">
                @csrf
                <!-- password -->
                <div class="mb-3">
                    <label for="user_password">Пароль</label>
                    <input id="user_password" type="password" name="user_password" class="form-control" autocomplete="current-password" required>
                </div>
                <div class="form-group text-end">
                    <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
                    <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
                </div>
            </form>
        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>
