@props(['label' => 'Логин (Адрес эл. почты)', 'error' => false])

<div
    {{ $attributes->merge([
        'class' => 'form-group'
    ]) }}
>
    <x-ui.label for="email" :label="$label" class="d-none"/>
    <x-ui.input
        id="email"
        name="email"
        type="email"
        :placeholder="$label"
        autocomplete="off"
        required
        :error="$errors->has('email')"
    />
    {{ $slot ?? '' }}
</div>
