@props(['label'])

<label
    {{ $attributes->merge([
        'class' => 'form-label'
    ]) }}
>
    {{ $label }}
    {{ $slot ?? '' }}
</label>
