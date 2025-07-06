<?php

declare(strict_types=1);

namespace App\View\Components\Form\Input;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Text extends Component
{
    public string $type = 'text';

    /**
     * Get the view / contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        return view('components.form.input.text');
    }
}
