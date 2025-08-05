<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserProfilelinkTakenException;
use App\Http\Requests\UserUpdateProfilelinkRequest as ProfilelinkRequest;
use App\Models\UserUser as User;
use App\Repositories\UserRepository;
use App\Services\UserService;
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
        return view('sections.users.edit.profilelink', compact(['user']));
    }

    public function update(ProfilelinkRequest $request, User $user): RedirectResponse
    {
        $user_profilelink = $request->validated('user_profilelink');

        $level = 'success';
        $message = 'Ссылка профиля успешно обновлена.';
        $routeName = 'users.edit.account';

        try {
            $found = $this->userRepository->findOneByProfilelink($user_profilelink);
            throw_if($found, new UserProfilelinkTakenException());

            $this->userService->updateUser($user, ['profilelink' => $user_profilelink]);
        } catch (UserProfilelinkTakenException $e) {
            $level = 'info';
            $message = $e->getMessage();
            $routeName = 'users.edit.profilelink';
        } catch (\Throwable $th) {
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
