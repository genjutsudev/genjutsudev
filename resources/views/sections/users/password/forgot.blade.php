<div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
@if (session('status'))
    <div class="font-medium text-sm text-green-600 dark:text-green-400">
        {{ session('status') }}
    </div>
@endif

<form method="post" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        <x-ui.input-errors :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
        <input type="submit" value="Email Password Reset Link" />
    </div>
</form>
