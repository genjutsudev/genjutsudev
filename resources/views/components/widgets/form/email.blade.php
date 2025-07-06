@props([
    'label' => 'Эл. почта',
    'id' => 'email',
    'name' => 'email',
    'value' => null,
    'placeholder' => null,
    'required' => false,
    'is_invalid' => false,
])

<div class="form-group mb-3">
    <x-ui.form.label :for="$id" :required="$required">
        {{ $label }}
    </x-ui.form.label>
    <x-ui.form.input.email
        :id="$id"
        :name="$name"
        :value="old($name, $value)"
        :placeholder="$placeholder"
        :required="$required"
        :is_invalid="$errors->has($name)"
        autocomplete="off"
    />
    <x-ui.input-errors :messages="$errors->get($name)"/>
</div>
