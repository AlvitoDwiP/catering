<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Price extends Component
{
    public function __construct(public float|int|string $amount)
    {
    }

    public function render(): View
    {
        return view('components.price');
    }
}
