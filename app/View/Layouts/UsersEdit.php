<?php

declare(strict_types=1);

namespace App\View\Layouts;

use App\Models\UserUser as User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class UsersEdit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(private readonly Request $request)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        /** @var User $user */
        $user = $this->request->user();

        return view('layouts.users-edit', compact(['user']));
    }
}
