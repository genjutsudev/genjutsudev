@section('title', $title = 'Восстановление пароля')

<x-layouts::users-password>
    <div class="card card-md">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">{{ $title }}</h2>
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                Забыли пароль? Не проблема!
                Просто сообщите нам свой адрес электронной почты, и мы вышлем вам письмо с инструкцией по сбросу пароля.
                Оно позволит вам установить новый пароль.
            </div>
            <!-- status -->
            @if (session('status'))
                <div class="font-medium text-sm text-green-600 alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif
            <x-ui.form.index action="{{ route('password.email') }}">
                <!-- email -->
                <x-widgets.form.email label="Эл. почта" :value="request()->input('email')" required/>
                <div class="flex items-center justify-end mt-4 text-end">
                    <a href="{{ $user ? route('users.edit.account', [$user->nid, $user->profilelink]) : '/' }}" class="me-2">
                        Отмена
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             width="24"
                             height="24"
                             viewBox="0 0 24 24"
                             fill="none"
                             stroke="currentColor"
                             stroke-width="2"
                             stroke-linecap="round"
                             stroke-linejoin="round"
                             class="icon icon-2"
                        >
                            <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path>
                            <path d="M3 7l9 6l9 -6"></path>
                        </svg>
                        <span>Отправить инструкцию</span>
                    </button>
                </div>
            </x-ui.form.index>
        </div>
    </div>
    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>
