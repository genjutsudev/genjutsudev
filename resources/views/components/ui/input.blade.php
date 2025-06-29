{{-- @deprecated --}}

@props([
    'id',
    'name',
    'type' => 'text',
    'value' => old($name),
    'error' => null,
])

<input
    {{ $id ? "id=$id" : "" }}
    {{ $name ? "name=$name" : "" }}
    {{ $type ? "type=$type" : "" }}
    {{ $value ? "value=$value" : "" }}
    {{ $attributes->merge([
        'class' => $error ? 'is-invalid' : '',
    ]) }}
/>
