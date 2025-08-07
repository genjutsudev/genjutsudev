<header class="navbar-expand-md">
    <div class="navbar-collapse collapse" id="navbar-menu">
        <div class="navbar p-0">
            <div class="container">
                <div class="d-flex justify-content-between flex-fill">
                    <x-navbar.navbar-nav />
                    @if($boosty_url_donate = env('BOOSTY_URL_DONATE'))
                    <div class="d-none d-lg-block w-25">
                        <div class="d-flex align-items-center justify-content-end">
                            <div class="text-end fw-bold text-uppercase me-2">
                                Поддержи нас<br/>
                                на <a href="{{ $boosty_url_donate }}" class="link-azure" target="_blank">Бусти</a>
                            </div>
                            {{--<div>
                                <img
                                    style="height: 52px;"
                                    alt="Донат"
                                    class="bg-light"
                                    --}}{{-- @todo --}}{{--
                                    src="{{ asset('static/media/boosty-donate.svg') }}"
                                >
                            </div>--}}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<x-session-flash-messages class="container mb-0"/>
