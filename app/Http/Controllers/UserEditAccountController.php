<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserEditAccountController extends Controller
{
    public function show(Request $request, User $user): View
    {
        return view('sections.users.edit.account', compact(['user']));
    }
}
