<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Core\Model\User\Entity\User as EntityUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserEditAccountController extends Controller
{
    public function show(Request $request, User $user): View
    {
        return view('web.sections.users.show.edit.account', compact(['user']));
    }

    /* public function update(Edit\AccountRequest $update, User $user)
    {
        try {
            $update->handle();
        } catch (\Exception $e) {
            self::danger($e->getMessage());
            return redirect()->route('users.edit.account.show', $user);
        }

        self::success('Data saved successfully.');
        return redirect()->route('users.edit.account.show', $user);
    } */
}
