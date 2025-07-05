<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body class="d-flex flex-column">
<div class="page page-center">
    <div class="container container-tight py-4" style="max-width: 30rem;">
        <x-session-flash-messages class="mb-4"/>
        <div class="h1 mb-3">
            <a href="/" class="text-decoration-none text-uppercase" title="Домой">
                <div class="d-flex font-vina-sans" style="font-size: 36px;">
                    genjut
                    <img
                        style="width: 38px; margin: 0 5px;"
                        src="{{ asset('static/media/sharingan.svg') }}"
                        alt="Sharingan"
                    >
                    su
                </div>
            </a>
        </div>
        {{ $slot }}
    </div>
</div>
</body>
</html>
