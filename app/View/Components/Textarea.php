<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Textarea extends Component
{
    public function __construct(
        public string $name,
        public ?string $label = null,
        public mixed $value = null,
        public ?string $placeholder = null,
    ) {
    }

    public function render(): View
    {
        return view('components.textarea');
    }
}
