<!DOCTYPE html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('web.layout.head')
<body data-bs-theme="light">
<div class="page">
    @include('web.layout.header')
    <x-navbar.navbar-component />
    <div class="page-wrapper">
        {{-- <div class="page-header">page-header</div> --}}
        <div class="page-body">
            {{ $slot }}
        </div>
        @include('web.layout.footer')
    </div>
</div>
{{-- Libs JS --}}
</body>
</html>
