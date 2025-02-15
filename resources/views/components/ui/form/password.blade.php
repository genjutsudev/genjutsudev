@props(['label' => 'Пароль', 'error' => false])

<div
    {{ $attributes->merge([
        'class' => 'form-group'
    ]) }}
>
    <x-ui.label for="password" :label="$label" class="d-none"/>
    <x-ui.input
        id="password"
        name="password"
        type="password"
        :placeholder="$label"
        autocomplete="new-password"
        required
        :error="$errors->has('password')"
    />
    {{ $slot ?? '' }}
</div>
