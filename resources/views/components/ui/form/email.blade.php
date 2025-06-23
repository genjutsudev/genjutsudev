@props(['label' => 'Логин (Адрес эл. почты)', 'error' => false])

<div
    {{ $attributes->merge([
        'class' => 'form-group'
    ]) }}
>
    <x-ui.label for="email" class="d-none form-label" :label="$label"/>
    <x-ui.input
        id="email"
        name="email"
        type="email"
        class="form-control"
        :placeholder="$label"
        autocomplete="off"
        required
        :error="$errors->has('email')"
    />
    <x-ui.input-errors :messages="$errors->get('email')"/>
</div>
