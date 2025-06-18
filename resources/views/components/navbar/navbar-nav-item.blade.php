@props(['disabled' => false, 'navItem'])

@if(! $disabled)
    <li class="nav-item">
        <a
            href="{{ $navItem['href'] }}"
            @class([
                'nav-link',
                'link-orange' => $is_active =  url()->current() == $navItem['href'],
            ])
        >
        <span
            @class([
                'nav-link-icon',
                'd-md-none',
                'd-lg-inline-block',
                'text-orange' => $is_active,
            ])
        >
            {!! $navItem['svg'] !!}
        </span>
            <span class="nav-link-title">
            {{ $navItem['title'] }}
        </span>
        </a>
    </li>
@endif
