<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserProfilelinkMonthlyLimitException;
use App\Exceptions\UserProfilelinkTakenException;
use App\Http\Requests\UserUpdateProfilelinkRequest as ProfilelinkRequest;
use App\Models\UserUser as User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Throwable;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserEditProfilelinkController extends Controller
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
        $count = abs($this->userRepository->getCountProfilelinkMonthlyLimit($user) - $limit = 1);
        return view('sections.users.edit.profilelink', compact(['user', 'count']));
    }

    public function update(ProfilelinkRequest $request, User $user): RedirectResponse
    {
        $level = 'success';
        $message = 'Ссылка профиля успешно обновлена.';
        $routeName = 'users.edit.account';

        try {
            $this->userService->updateUserProfilelink($user, $request->validated('user_profilelink'));
        } catch (
            UserProfilelinkTakenException |
            UserProfilelinkMonthlyLimitException $e
        ) {
            list($level, $routeName) = match (true) {
                $e instanceof UserProfilelinkTakenException,
                $e instanceof UserProfilelinkMonthlyLimitException => ['info', 'users.edit.profilelink'],
            };

            $message = $e->getMessage();
        } catch (Throwable $th) {
            $level = 'danger';
            $message = 'Произошла внутренняя ошибка, повторите попытку позже.';
            $routeName = 'users.edit.profilelink';
            logger()->error(self::class, ['error' => $th->getMessage(), 'user_id' => $user->id]);
        }

        return redirect()
            ->route($routeName, [$user->nid, $user->profilelink])
            ->with('messages', [['level' => $level, 'message' => $message]]);
    }
}
