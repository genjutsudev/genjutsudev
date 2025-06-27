@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <form method="post">
        @method('put')
        @csrf
        {{-- profilename --}}
        <div class="mb-3 w-50">
            <label for="profilename" class="form-label">Имя профиля</label>
            <x-ui.input
                id="profilename"
                name="profilename"
                value="{{ old('profilename') ?? $user->profilename }}"
                class="form-control"
                autocomplete="off"
                required
                :error="$errors->has('profilename')"
            />
            <x-ui.input-errors :messages="$errors->get('profilename')"/>
        </div>
        <div class="w-50 form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </form>
</x-layouts::users-edit>
