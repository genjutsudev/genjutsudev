<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body class="d-flex flex-column">
<div class="page page-center">
    <div class="container container-tight py-4" style="max-width: 30rem;">
        <x-session-flash-messages class="mb-4"/>
        <div class="text-center mb-4">
            <a href="/" class="navbar-brand navbar-brand-autodark">
                <img
                    src="{{ asset('static/favicons/android-icon-192x192.png') }}"
                    width="110"
                    height="32"
                    alt="Favicon"
                    class="navbar-brand-image"
                >
            </a>
        </div>
        {{ $slot }}
    </div>
</div>
</body>
</html>
