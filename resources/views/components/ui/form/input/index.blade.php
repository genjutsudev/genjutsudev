@props(['id', 'name', 'type', 'value', 'placeholder'])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="{{ $type }}"
    @if (!empty($value))
    value="{!! $value !!}"
    @endif
    @if(!empty($placeholder))
    placeholder="{!! $placeholder !!}"
    @endif
    @if (isset($disabled))
    disabled="disabled"
    @endif
    @if (isset($required))
    required="required"
    @endif
    @if (isset($readonly))
    readonly="readonly"
    @endif
    {{ $attributes->except(['placeholder', 'disabled', 'required', 'readonly']) }}
/>
