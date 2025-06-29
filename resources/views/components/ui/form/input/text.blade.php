@props(['id', 'name', 'value', 'placeholder', 'errors' => false])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="text"
    value="{!! $value !!}"
    @class(['form-control', 'is-invalid' => $errors])
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
