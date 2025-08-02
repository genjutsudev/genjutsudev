@props(['id', 'name', 'value', 'placeholder', 'disabled', 'required' => false, 'readonly', 'is_invalid' => false])

<input
    id="{{ $id }}"
    name="{{ $name }}"
    type="email"
    @if(!empty($value))
    value="{!! $value !!}"
    @endif
    @class(['form-control', 'is-invalid' => $is_invalid])
    @if(!empty($placeholder))
    placeholder="{!! $placeholder !!}"
    @endif
    @if (isset($disabled))
    disabled="disabled"
    @endif
    @if ($required)
    required="required"
    @endif
    @if (isset($readonly))
    readonly="readonly"
    @endif
    {{ $attributes->except(['placeholder', 'disabled', 'required', 'readonly']) }}
/>
