<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <!-- Password -->
    <div>
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autofocus>
        <x-ui.input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex justify-end mt-4">
        <input type="submit" value="Confirm" />
    </div>
</form>
