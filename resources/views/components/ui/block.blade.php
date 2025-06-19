@props(['disabled' => false])

@if(! $disabled)
    <div
        {{ $attributes->merge([
            'class' => 'block',
        ]) }}
    >
        {{ $slot }}
    </div>
@endif
