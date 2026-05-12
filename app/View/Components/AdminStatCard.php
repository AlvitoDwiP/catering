<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AdminStatCard extends Component
{
    public function __construct(
        public string $label,
        public string|int|float $value,
        public ?string $description = null,
        public string $variant = 'default',
    ) {
    }

    public function render(): View
    {
        return view('components.admin-stat-card');
    }
}
