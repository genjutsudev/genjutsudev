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
                                @foreach([
                                    ['title' => 'Аккаунт', 'routeName' => 'users.edit.account']
                                ] as $bcItem)
                                    @if(! request()->routeIs($bcItem['routeName']))
                                        <li class="breadcrumb-item">
                                            <a href="{{ route($bcItem['routeName'], [$user->nid, $user->profilelink]) }}">
                                                {{ $bcItem['title'] }}
                                            </a>
                                        </li>
                                    @else
                                        <li class="breadcrumb-item">{{ $bcItem['title'] }}</li>
                                    @endif
                                @endforeach
                            </ol>
                        </nav>{{-- @todo move to ui\component --}}
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
