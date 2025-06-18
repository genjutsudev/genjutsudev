@php($routes = [
    'terms' => 'Соглашение',
    'privacy' => 'Конфиденциальность',
    'copyright' => 'Для правообладателей'
])

<footer class="footer footer-transparent d-print-none">
    <div class="container">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item text-lowercase">&copy; {{ request()->host() }} {{ date('Y') }}</li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    @foreach($routes as $routeName => $routeTitle)
                        <li class="list-inline-item">
                            <a href="{{ route($routeName) }}?ref=footer" class="link-secondary">
                                {{ $routeTitle }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        {{--<div class="text-end">
            <a href="https://pr-cy.ru" target="_blank">
                <img src="https://s.pr-cy.ru/counters/genjut.su" width="88" height="31" alt="Анализ сайта" />
            </a>
        </div>--}}
    </div>
</footer>
