{{-- @deprecated --}}

@props(['label' => 'Пароль', 'error' => false])

<div
    {{ $attributes->merge([
        'class' => 'form-group'
    ]) }}
>
    <x-ui.label for="password" class="d-none form-label" :label="$label"/>
    <x-ui.input
        id="password"
        name="password"
        type="password"
        class="form-control"
        :placeholder="$label"
        autocomplete="new-password"
        required
        :error="$errors->has('password')"
    />
    {{ $slot ?? '' }}
</div>
