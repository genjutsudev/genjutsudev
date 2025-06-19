@props(['disabled' => false, 'navItem'])

@use(Illuminate\Support\Str)

@if(! $disabled)
    <li class="nav-item dropdown">
        <a
            href="#nav-{{ Str::slug($navItem['title']) }}"
            class="nav-link dropdown-toggle"
            data-bs-toggle="dropdown"
            data-bs-auto-close="outside"
            role="button"
            aria-expanded="false"
        >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
                {!! $navItem['svg'] !!}
            </span>
            <span class="nav-link-title me-1">
                {{ $navItem['title'] }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-start rounded-0 shadow-none">
            @each('components.navbar.navbar-nav-item-dropdown-item', $navItem['dropdown'], 'dropdownItem')
        </div>
    </li>
@endif
