<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateAccountRequest as AccountRequest;
use App\Models\UserUser as User;
use App\Models\UserUserNetwork as Network;
use App\Services\UserNetworkService as NetworkService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class UserEditAccountController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly NetworkService $networkService
    )
    {
    }

    public function show(User $user): View
    {
        $preferences = $user->preferences;
        return view('sections.users.edit.account', compact(['user', 'preferences']));
    }

    public function update(AccountRequest $request, User $user): RedirectResponse
    {
        $user_gender = $request->validated('user_gender');
        $user_preferences = $request->validated('user_preferences');

        $preferences_data = [
            'is_show_age' => isset($user_preferences['is_show_age']),
            'is_view_censored' => isset($user_preferences['is_view_censored']) && $user->birthday->age >= 18,
            'is_show_gravatar' => isset($user_preferences['is_show_gravatar'])
        ];

        $level = 'success';
        $message = 'Изменения успешно сохранены.';
        $routeName = 'users.edit.account';

        try {
            DB::transaction(function () use ($user, $user_gender, $preferences_data) {
                $this->userService->updateUser($user, ['gender' => $user_gender]);
                $this->userService->updatePreferences($user, $preferences_data);
            });
        } catch (\Exception $e) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            logger()->error(self::class, ['error' => $e->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()->route($routeName, [$user->nid, $user->profilelink])->with('messages', [
            ['level' => $level, 'message' => $message]
        ]);
    }

    public function attachNetwork(Request $request, User $user): RedirectResponse
    {
        return Socialite::driver($request->driver)->redirect();
    }

    public function detachNetwork(Request $request, User $user): RedirectResponse
    {
        $level = 'success';
        $message = 'The social network has been successfully disabled.';

        try {
            $this->networkService->detachNetwork($user, Network::make([
                'network' => $request->driver,
                'identity' => $request->identity
            ]));
        } catch (\Exception $e) {
            $level = 'danger';
            $message = $e->getMessage();
            logger()->error(self::class, ['error' => $e->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()->route('users.edit.account', [$user->nid, $user->profilelink])->with('messages', [
            ['level' => $level, 'message' => $message]
        ]);
    }
}
