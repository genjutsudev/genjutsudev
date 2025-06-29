{{-- @todo move --}}

@props(['label' => 'Повтор пароля'])

<div
    {{ $attributes->merge([
        'class' => 'form-group'
    ]) }}
>
    <x-ui.label for="password-confirmation" class="d-none form-label" :label="$label"/>
    <x-ui.input
        id="password-confirmation"
        name="password_confirmation"
        type="password"
        class="form-control"
        :placeholder="$label"
        autocomplete="new-password"
        required
    />
    {{ $slot ?? '' }}
</div>
