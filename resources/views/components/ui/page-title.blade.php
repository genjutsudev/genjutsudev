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
    @if($desc)
        <div class="h5 m-0">
            {{ $desc }}
        </div>
    @endif
</x-ui.block>
