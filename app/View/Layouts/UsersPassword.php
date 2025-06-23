<?php

namespace App\View\Layouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsersPassword extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('layouts.users-password');
    }
}
