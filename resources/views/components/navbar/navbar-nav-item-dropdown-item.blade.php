@props(['dropdownItem'])

@if($dropdownItem['href'] !== '#')
    <a
        href="{{ $dropdownItem['href'] }}"
        @class([
            'dropdown-item',
            'active' => url()->current() == $dropdownItem['href'],
        ])>
        @if(isset($dropdownItem['svg']))
            {!! $dropdownItem['svg'] !!}
        @endif
        <span>
        {{ $dropdownItem['title'] }}
    </span>
    </a>
@else
    <div class="dropdown-divider my-1"></div>
@endif
