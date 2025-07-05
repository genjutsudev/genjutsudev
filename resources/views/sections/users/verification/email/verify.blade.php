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
                    <div class="flex items-center justify-end mt-4">
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
    </div>
    <div class="text-center text-secondary mt-3">
        <span>Забудьте об этом, <a href="{{ route('login') }}">верните меня</a> на экран входа.</span>
    </div>
</x-layouts::users-password>
