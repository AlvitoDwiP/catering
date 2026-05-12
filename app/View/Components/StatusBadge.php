<?php

namespace App\View\Components;

use App\Enums\OrderStatus;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public function __construct(public OrderStatus $status)
    {
    }

    public function render(): View
    {
        return view('components.status-badge');
    }
}
