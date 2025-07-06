@props(['id', 'name', 'type', 'value', 'disabled', 'required', 'readonly'])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="hidden"
    @if (!empty($value))
    value="{!! $value !!}"
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
