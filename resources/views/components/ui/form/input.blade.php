@props([
    'id',
    'name',
    'type' => 'text',
    'value' => old($name),
    'placeholder' => '',
    'error' => null,
    'label' => null,
])

    @if($label)
        <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    @endif

    <input
        {{ $attributes->merge([
            'id' => $id ?? $name,
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'placeholder' => $placeholder,
            'class' => 'form-control' . ($error ? ' is-invalid' : ''),
        ]) }}
    >

    @if($error)
        <div class="invalid-feedback">
            {{ $error }}
        </div>
    @endif
