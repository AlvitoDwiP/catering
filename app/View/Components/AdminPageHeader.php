<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminPageHeader extends Component
{
    public function __construct(public string $title, public ?string $description = null)
    {
    }

    public function render(): View
    {
        return view('components.admin-page-header');
    }
}
