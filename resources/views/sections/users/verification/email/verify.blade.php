@section('title', $title = 'Подтвердите свою эл. почту')

<x-layouts::users-password>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">
                {{ $title }}
            </h2>

            <div class="mb-4 text-sm text-gray-600">
                <b>Спасибо за регистрацию!</b>
                Прежде чем начать, не могли бы вы подтвердить свою эл. почту, нажав на ссылку,
                которую мы только что отправили вам по эл. почте?
                Если вы не получили письмо, мы с радостью отправим вам другое.
            </div>

            <div class="mt-4 flex items-center justify-between">
                <x-ui.form.index action="{{ route('verification.send') }}">
                    <div class="form-group text-end">
                        <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}"
                           class="me-3"
                        >
                            Отмена
                        </a>
                        <input type="submit"
                               value="Повторно отправить письмо с подтверждением"
                               class="btn btn-sm btn-secondary px-2 py-1"
                        >
                    </div>
                </x-ui.form.index>
            </div>

        </div>
    </div>

    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>
