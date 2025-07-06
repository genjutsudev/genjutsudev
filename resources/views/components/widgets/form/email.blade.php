@props([
    'label' => 'Эл. почта',
    'id' => 'email',
    'name' => 'email',
    'value' => null,
    'placeholder' => null,
    'is_invalid' => false,
])

<div class="form-group mb-3">
    <x-ui.form.label :for="$id" required>
        {{ $label }}
    </x-ui.form.label>
    <x-ui.form.input.email
        :id="$id"
        :name="$name"
        :value="old($name, $value)"
        :placeholder="$placeholder"
        :is_invalid="$errors->has($name)"
        autocomplete="off"
        required
    />
    <x-ui.input-errors :messages="$errors->get($name)"/>
</div>
