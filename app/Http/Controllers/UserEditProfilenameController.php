<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserProfilenameMonthlyLimitException;
use App\Http\Requests\UserUpdateProfilenameRequest as ProfilenameRequest;
use App\Models\UserUser as User;
use App\Repositories\UserUserRepository as UserRepository;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Throwable;

class UserEditProfilenameController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserService $userService
    )
    {
    }

    public function show(User $user): View
    {
        // @todo param "limit" move to .env file or in database in table "users"
        $count = abs($this->userRepository->getCountProfilenameMonthlyLimit($user) - $limit = 3);
        return view('sections.users.edit.profilename', compact(['user', 'count']));
    }

    public function update(ProfilenameRequest $request, User $user): RedirectResponse
    {
        $level = 'success';
        $message = 'Имя профиля успешно обновлено.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUserProfilename($user, $request->validated('user_profilename'));
        } catch (
            UserProfilenameMonthlyLimitException $e
        ) {
            list($level, $routeName) = match (true) {
                $e instanceof UserProfilenameMonthlyLimitException => ['info', 'users.edit.profilelink'],
            };

            $message = $e->getMessage();
        } catch (Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.profilename';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
