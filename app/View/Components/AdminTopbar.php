<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminTopbar extends Component
{
    public function __construct(public string $title = 'Admin')
    {
    }

    public function render(): View
    {
        return view('components.admin-topbar');
    }
}
