@props(['user'])

@section('title', $user->profilename)

<x-layouts::users-edit>
    <div class="alert alert-info">
        Изменение эл. почты потребует повторного подтверждения через письмо.<br/>
        Это необходимо для подтверждения, что новый адрес электронной почты действительно принадлежит вам.
    </div>
    <x-ui.form.index method="put" class="w-50">
        {{-- email --}}
        <x-widgets.form.email :value="$user->email" :placeholder="$user->email" required/>
        {{-- new password --}}
        <x-widgets.form.password label="Новый пароль"/>
        <small class="d-none">Чувствителен к регистру</small>
        {{-- confirm new password --}}
        <x-widgets.form.password id="password_confirmation" name="password_confirmation" label="Повторите новый пороль"/>
        <div class="form-group text-end">
            <a href="{{ route('users.edit.account', [$user, $user->profilelink]) }}" class="me-2">Отмена</a>
            <input type="submit" value="Сохранить" class="btn btn-primary">
        </div>
    </x-ui.form.index>
</x-layouts::users-edit>
