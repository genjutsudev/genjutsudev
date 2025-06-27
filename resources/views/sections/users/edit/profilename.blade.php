@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <form method="post">
        @method('put')
        @csrf
        {{-- profilename --}}
        <div class="mb-3 w-50">
            <label for="user_profilename" class="form-label">Имя профиля</label>
            <input
                id="user_profilename"
                name="user_profilename"
                value="{{ $user->profilename }}"
                class="form-control"
                autocomplete="off"
                required
            >
        </div>
        <div class="w-50 form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </form>
</x-layouts::users-edit>
