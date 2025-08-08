@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="alert alert-info">
        Можно использовать латиницу (a-z), цифры (0-9) и подчёркивание.
        Минимальная длина &mdash; 5 символов.
    </div>
     этом месяце доступно - {{ $count }} смен(ы)
    <x-ui.form.index method="put" class="w-50">
        {{-- profilelink --}}
        <div class="mb-3">
            <x-ui.form.label for="user_profilelink" required>
                Ссылка профиля
            </x-ui.form.label>
            <x-ui.form.input.text
                id="user_profilelink"
                name="user_profilelink"
                value="{{ $user->profilelink }}"
                placeholder="{{ $user->profilelink }}"
                autocomplete="off"
                required
                :is_invalid="$errors->has('user_profilelink')"
            />
            <x-ui.input-errors :messages="$errors->get('user_profilelink')"/>
        </div>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
