<!DOCTYPE html>
<html lang="{{ $locale = str_replace('_', '-', app()->getLocale()) }}">
@include('head')
<body data-bs-theme="light">
<div class="page">
    @include('header')
    <x-navbar.navbar-component />
    <div class="page-wrapper">
         <div class="page-header">
             <div class="container">
                 <h1 class="text-uppercase m-0">
                     {{ $user->profilename }}
                     <small class="text-muted">{{ $user->profilelink }}</small>
                 </h1>
             </div>
         </div>
        <div class="page-body mt-2">
            <div class="container">
                <x-ui.subheadline :label="__('Настройки')">
                    <x-slot:options>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Аккаунт</li>
                            </ol>
                        </nav>
                    </x-slot:options>
                </x-ui.subheadline>
                {{ $slot }}
            </div>
        </div>
        @include('footer')
    </div>
</div>
{{-- Libs JS --}}
</body>
</html>
