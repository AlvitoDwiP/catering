<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public function __construct(public string $padding = 'default')
    {
    }

    public function render(): View
    {
        return view('components.card');
    }
}
