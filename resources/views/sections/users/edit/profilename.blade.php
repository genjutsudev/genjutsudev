@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <x-ui.form.index method="put" class="w-50">
        {{-- profilename --}}
        <div class="mb-3">
            <x-ui.form.label for="user_profilename" required>
                Имя профиля
                <x-slot:slotDesc>
                    В этом месяце вы можете поменять имя профиля ещё <b>{{ $count }}</b> раз(а).
                </x-slot:slotDesc>
            </x-ui.form.label>
            <x-ui.form.input.text
                id="user_profilename"
                name="user_profilename"
                value="{{ $user->profilename }}"
                placeholder="{{ $user->profilename }}"
                autocomplete="off"
                required
                :is_invalid="$errors->has('user_profilelink')"
            />
            <x-ui.input-errors :messages="$errors->get('user_profilename')"/>
        </div>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-2">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
