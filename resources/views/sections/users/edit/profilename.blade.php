@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <x-ui.form.index method="put">
        {{-- profilename --}}
        <div class="mb-3 w-50">
            <x-ui.form.label for="user_profilename" required>
                <span>Имя профиля</span>
            </x-ui.form.label>
            <x-ui.form.input.text
                id="user_profilename"
                name="user_profilename"
                value="{{ old('user_profilename', $user->profilename) }}"
                placeholder="{{ $user->profilename }}"
                autocomplete="off"
                required
                :errors="$errors->has('user_profilename')"
            />
            <x-ui.input-errors :messages="$errors->get('user_profilename')"/>
        </div>
        <div class="w-50 form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
