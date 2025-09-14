<?php

declare(strict_types=1);

namespace App\Http\Controllers\SSO;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ShikimoriCallbackController extends Controller
{
    public function __invoke(Request $request, UserService $userService)
    {
        /** @var ?string $driver */
        $driver = $request->driver;
        $socialite = Socialite::driver($driver);
        $user = $socialite->user();
        dd($driver, $user);
    }
}
