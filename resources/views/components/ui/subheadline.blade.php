@props(['label', 'href' => null])

<div
    {{ $attributes->merge([
        'class' => 'subheadline'
    ]) }}
>
    @if($href)
        <a
            href="{{ $href }}"
            @class([
                'd-flex',
                'align-items-center',
                'fw-bold',
                'text-uppercase',
            ])
        >
            <div class="flex-grow-1">
                {{ $label }}
            </div>
            <div>
                <i class="fa-solid fa-caret-up fa-rotate-90"></i>
            </div>
        </a>
    @else
        <div class="d-flex">
            <div class="flex-grow-1 fw-bold text-uppercase">
                {{ $label }}
            </div>
            {{ $options ?? '' }}
        </div>
    @endif
</div>
@if($slot->isNotEmpty())
    <div class="subheadline-body">
        {{ $slot }}
    </div>
@endif
