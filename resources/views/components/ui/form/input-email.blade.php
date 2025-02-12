<x-ui.form.input
    {{ $attributes->merge([
        'name' => 'email',
        'type' => 'email',
        'autocomplete' => 'off',
        'placeholder' => 'Адрес эл. почты (Логин)',
        'error' => $errors->first('email'),
        'required' => true
    ]) }}
/>
