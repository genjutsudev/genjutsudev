@props(['label' => ''])

<label
    {{ $attributes->merge([]) }}
>
    {{ $label }}
    {{ $slot ?? '' }}
</label>
