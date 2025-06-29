@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="alert alert-info">
        Можно использовать латиницу (a-z), цифры (0-9) и подчёркивание. Минимальная длина &mdash; 5 символов.
    </div>
    <form method="post">
        @method('put')
        @csrf
        {{-- profilelink --}}
        <div class="mb-3 w-50">
            <label for="user_profilelink" class="form-label">Ссылка профиля</label>
            <x-ui.input
                id="user_profilelink"
                name="user_profilelink"
                value="{{ old('user_profilelink', $user->profilelink) }}"
                class="form-control"
                autocomplete="off"
                required
                :error="$errors->has('user_profilelink')"
            />
            <x-ui.input-errors :messages="$errors->get('user_profilelink')"/>
        </div>
        <div class="w-50 form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </form>
</x-layouts::users-edit>
