{{-- @deprecated --}}

@props(['messages'])

@if ($messages)
    <ul
        {{ $attributes->merge([
            'class' => 'm-0 py-2'
        ]) }}
    >
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
