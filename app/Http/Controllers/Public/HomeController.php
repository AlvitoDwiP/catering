<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\Cart\CartService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(CartService $cart): View
    {
        $bestSellerSlugs = ['nasi-kotak-ayam', 'nasi-kotak-ikan', 'snack-box-premium'];

        $recommendedMenus = Menu::query()
            ->with('category')
            ->whereIn('slug', $bestSellerSlugs)
            ->available()
            ->get()
            ->sortBy(fn (Menu $menu) => array_search($menu->slug, $bestSellerSlugs, true))
            ->values();

        $featuredCategories = [
            [
                'name' => 'Nasi Box',
                'slug' => 'nasi-kotak',
                'description' => 'Menu box praktis untuk rapat, reuni, dan jamuan kerja.',
                'image_key' => 'categories.nasi-box',
                'placeholder_key' => 'nasi-box',
                'link' => route('public.menus.index', ['category' => 'nasi-kotak']),
            ],
            [
                'name' => 'Catering Harian',
                'slug' => 'paket-catering',
                'description' => 'Paket harian yang rapi, hangat, dan siap dikirim terjadwal.',
                'image_key' => 'categories.catering-harian',
                'placeholder_key' => 'catering-harian',
                'link' => route('public.menus.index', ['category' => 'paket-catering']),
            ],
            [
                'name' => 'Snack Box',
                'slug' => 'snack-box',
                'description' => 'Box snack untuk meeting, seminar, dan acara keluarga.',
                'image_key' => 'categories.snack-box',
                'placeholder_key' => 'snack-box',
                'link' => route('public.menus.index', ['category' => 'snack-box']),
            ],
            [
                'name' => 'Minuman',
                'slug' => 'minuman',
                'description' => 'Pelengkap segar untuk konsumsi acara yang lebih lengkap.',
                'image_key' => 'categories.minuman',
                'placeholder_key' => 'minuman',
                'link' => route('public.menus.index', ['category' => 'minuman']),
            ],
            [
                'name' => 'Paket Acara',
                'slug' => 'paket-acara',
                'description' => 'Rangkaian paket untuk gathering, arisan, dan event kantor.',
                'image_key' => 'categories.paket-acara',
                'placeholder_key' => 'paket-acara',
                'link' => route('public.menus.index', ['category' => 'paket-catering']),
            ],
        ];

        $promotions = [
            [
                'title' => 'Catering Kantor',
                'description' => 'Siap untuk briefing, lunch meeting, dan operasional harian.',
                'image_key' => 'promotions.catering-kantor',
                'placeholder_key' => 'catering-kantor',
            ],
            [
                'title' => 'Catering Acara',
                'description' => 'Paket untuk gathering, launching, hingga kebutuhan keluarga besar.',
                'image_key' => 'promotions.catering-acara',
                'placeholder_key' => 'catering-acara',
            ],
            [
                'title' => 'Paket Bulanan',
                'description' => 'Langganan konsumsi yang stabil, efisien, dan mudah dikelola.',
                'image_key' => 'promotions.paket-bulanan',
                'placeholder_key' => 'paket-bulanan',
            ],
        ];

        $whyChooseUs = [
            [
                'title' => 'Food presentation yang rapi',
                'description' => 'Foto asli, komposisi bersih, dan tampilan menu yang membuat brand langsung terasa meyakinkan.',
            ],
            [
                'title' => 'Cocok untuk event nyata',
                'description' => 'Dirancang untuk kebutuhan kantor, keluarga, komunitas, hingga acara formal dengan flow order yang jelas.',
            ],
            [
                'title' => 'Respons cepat dan mudah dipahami',
                'description' => 'Pengalaman pemesanan dibuat singkat, ringkas, dan nyaman di desktop maupun mobile.',
            ],
            [
                'title' => 'Tampilan premium tanpa berlebihan',
                'description' => 'Earth tone, spacing luas, card modern, dan hierarki tegas membuat situs terasa profesional.',
            ],
        ];

        $testimonials = [
            [
                'quote' => 'Tampilannya langsung terasa seperti catering serius, bukan template. Foto makanannya juga bikin kami lebih percaya buat order.',
                'name' => 'Admin Kantor',
                'role' => 'Pemesanan lunch meeting',
            ],
            [
                'quote' => 'Menu mudah dibaca dan proses pilihannya nyaman di HP. Kami jadi lebih cepat cocokkan menu untuk acara keluarga.',
                'name' => 'Event Organizer',
                'role' => 'Paket acara mingguan',
            ],
            [
                'quote' => 'Layout-nya premium tapi tetap simpel. Cocok untuk jelaskan katalog ke klien tanpa terlihat seperti aplikasi CRUD.',
                'name' => 'PIC Konsumsi',
                'role' => 'Langganan harian kantor',
            ],
        ];

        return view('public.home', [
            'recommendedMenus' => $recommendedMenus,
            'featuredCategories' => $featuredCategories,
            'promotions' => $promotions,
            'whyChooseUs' => $whyChooseUs,
            'testimonials' => $testimonials,
            'cartCount' => $cart->count(),
            'cartTotal' => $cart->totalAmount(),
            'cartItems' => $cart->all(),
        ]);
    }
}
