<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        $recommendedMenus = Menu::query()->available()->recommended()->take(6)->get();

        return view('public.home', compact('recommendedMenus'));
    }
}
