@props(['hidden' => false, 'text', 'slot'])

<label
    {{ $attributes->merge([
        'class' => 'form-label'
    ]) }}
>
    @if($text)
    <div
        @class([
            'form-label',
            'd-none' => $hidden,
        ])
    >
        {{ $text }}
    </div>
    @endif
    {{ $slot ?? '' }}
</label>
