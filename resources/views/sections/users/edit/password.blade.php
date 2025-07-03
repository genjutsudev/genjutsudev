@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <x-ui.form.index method="put" class="w-50">
        {{-- email --}}
        <div class="mb-3">
            <label class="form-label m-0">
                <span class="form-label">Email</span>
                <input class="form-control" id="email" type="email" name="email" value="{{ $user->email }}" placeholder="{{ $user->email }}" required="required" autocomplete="off">
            </label>
            <x-ui.input-errors :messages="$errors->get('email')"/>
        </div>
        {{-- new password --}}
        <div class="mb-3">
            <label class="form-label m-0">
                <span class="form-label">New Password</span>
                <span class="input-group input-group-flat">
                    <input class="form-control" type="password" name="password" autocomplete="new-password">
                    <span class="input-group-text">
                        <a href="/" class="disabled link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg>
                        </a>
                    </span>
                </span>
                <small>Чувствителен к регистру</small>
            </label>
            <x-ui.input-errors :messages="$errors->get('password')"/>
        </div>
        {{-- confirm new password --}}
        <div class="mb-3">
            <label class="form-label m-0">
                <span class="form-label">Confirm New Password</span>
                <span class="input-group input-group-flat">
                    <input class="form-control" type="password" name="password_confirmation" autocomplete="new-password">
                    <span class="input-group-text">
                        <a href="#" class="disabled link-secondary" data-bs-toggle="tooltip" aria-label="Show password" data-bs-original-title="Show password">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"></path></svg>
                        </a>
                    </span>
                </span>
            </label>
        </div>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user->nid, $user->profilelink]) }}" class="me-3">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-sm btn-secondary px-2 py-1">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
