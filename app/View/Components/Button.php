<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public function __construct(
        public string $variant = 'primary',
        public string $type = 'button',
        public ?string $href = null,
    ) {
    }

    public function render(): View
    {
        return view('components.button');
    }
}
