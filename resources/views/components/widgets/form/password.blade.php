@props([
    'label' => 'Пароль',
    'id' => 'password',
    'name' => 'password',
    'placeholder' => null,
    'is_invalid' => false,
])

<div class="form-group mb-3">
    <x-ui.form.label :for="$id" required>
        {{ $label }}
    </x-ui.form.label>
    <div class="input-group input-group-flat">
        <x-ui.form.input.password
            :id="$id"
            :name="$name"
            :placeholder="$placeholder"
            :is_invalid="$errors->has($name)"
            autocomplete="off"
            required
        />
        <span class="input-group-text">
            <a href="#"
               class="link-secondary disabled"
               data-bs-toggle="tooltip"
               data-bs-original-title="Показать пароль"
            >
                <svg xmlns="http://www.w3.org/2000/svg"
                     width="24"
                     height="24"
                     viewBox="0 0 24 24"
                     fill="none"
                     stroke="currentColor"
                     stroke-width="2"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     class="icon icon-1"
                >
                    <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                    <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path>
                </svg>
            </a>
        </span>
    </div>
    <x-ui.input-errors :messages="$errors->get($name)"/>
</div>
