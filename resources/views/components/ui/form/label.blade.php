<label class="form-label" {{ $attributes }}>
    {!! $slot !!}

    @if ($attributes->has('required') && $attributes->get('required') === true)
        <b class="text-red">*</b>
    @endif
</label>
