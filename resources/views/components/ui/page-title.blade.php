@props(['disabled' => false, 'h1', 'desc' => null])

<x-ui.block
    :disabled="$disabled"
    {{ $attributes->merge([
        'class' => 'text-uppercase mb-4',
    ]) }}
>
    <div class="h1 m-0">
        {{ $h1 }}
    </div>
    <x-ui.block
        :disabled="! $desc"
        @class(['h5', 'm-0'])
    >
        {{ $desc }}
    </x-ui.block>
</x-ui.block>
