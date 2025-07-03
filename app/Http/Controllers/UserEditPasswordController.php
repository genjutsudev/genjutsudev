<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**
 * @todo
 */
class UserEditPasswordController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    )
    {
    }

    public function show(User $user): View
    {
        return view('sections.users.edit.password', compact(['user']));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate( [
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $this->userService->updateUser($user, [
            'password' => Hash::make($validated['password'])
        ]);

        return back()->with('messages', [
            ['level' => 'info', 'message' => __('password-updated')]
        ]);
    }
}
