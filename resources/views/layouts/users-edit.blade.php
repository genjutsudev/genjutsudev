<!DOCTYPE html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body data-bs-theme="light">
<div class="page">
    @include('header')
    <x-navbar.navbar-component />
    <div class="page-wrapper">
        {{-- <div class="page-header">page-header</div> --}}
        <div class="page-body">
            {{ $slot }}
        </div>
        @include('footer')
    </div>
</div>
{{-- Libs JS --}}
</body>
</html>
