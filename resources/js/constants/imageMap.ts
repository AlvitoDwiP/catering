import heroMain from '../assets/images/hero/hero-main.jpg';

import categoryCateringHarian from '../assets/images/categories/catering-harian.jpg';
import categoryMinuman from '../assets/images/categories/minuman.jpg';
import categoryNasiBox from '../assets/images/categories/nasi-box.jpg';
import categoryPaketAcara from '../assets/images/categories/paket-acara.jpg';
import categorySnackBox from '../assets/images/categories/snack-box.jpg';

import promoCateringAcara from '../assets/images/promotions/catering-acara.jpg';
import promoCateringKantor from '../assets/images/promotions/catering-kantor.jpg';
import promoPaketBulanan from '../assets/images/promotions/paket-bulanan.jpg';

import menuAirMineral from '../assets/images/menu/air-mineral.jpg';
import menuEsTeh from '../assets/images/menu/es-teh.jpg';
import menuNasiKotakAyam from '../assets/images/menu/nasi-kotak-ayam.jpg';
import menuNasiKotakIkan from '../assets/images/menu/nasi-kotak-ikan.jpg';
import menuPaketRapatHemat from '../assets/images/menu/paket-rapat-hemat.jpg';
import menuSnackBoxA from '../assets/images/menu/snack-box-a.jpg';
import menuSnackBoxPremium from '../assets/images/menu/snack-box-premium.jpg';

import placeholderAirMineral from '../assets/images/placeholders/air-mineral.jpg';
import placeholderCateringAcara from '../assets/images/placeholders/catering-acara.jpg';
import placeholderCateringHarian from '../assets/images/placeholders/catering-harian.jpg';
import placeholderCateringKantor from '../assets/images/placeholders/catering-kantor.jpg';
import placeholderEsTeh from '../assets/images/placeholders/es-teh.jpg';
import placeholderHeroMain from '../assets/images/placeholders/hero-main.jpg';
import placeholderMenu from '../assets/images/placeholders/menu-placeholder.jpg';
import placeholderMinuman from '../assets/images/placeholders/minuman.jpg';
import placeholderNasiBox from '../assets/images/placeholders/nasi-box.jpg';
import placeholderNasiKotakAyam from '../assets/images/placeholders/nasi-kotak-ayam.jpg';
import placeholderNasiKotakIkan from '../assets/images/placeholders/nasi-kotak-ikan.jpg';
import placeholderPaketAcara from '../assets/images/placeholders/paket-acara.jpg';
import placeholderPaketBulanan from '../assets/images/placeholders/paket-bulanan.jpg';
import placeholderPaketRapatHemat from '../assets/images/placeholders/paket-rapat-hemat.jpg';
import placeholderSnackBox from '../assets/images/placeholders/snack-box.jpg';
import placeholderSnackBoxA from '../assets/images/placeholders/snack-box-a.jpg';
import placeholderSnackBoxPremium from '../assets/images/placeholders/snack-box-premium.jpg';

export const imageMap = {
    images: {
        hero: {
            main: heroMain,
        },
        categories: {
            'nasi-box': categoryNasiBox,
            'catering-harian': categoryCateringHarian,
            'snack-box': categorySnackBox,
            minuman: categoryMinuman,
            'paket-acara': categoryPaketAcara,
        },
        promotions: {
            'catering-kantor': promoCateringKantor,
            'catering-acara': promoCateringAcara,
            'paket-bulanan': promoPaketBulanan,
        },
        menus: {
            'nasi-kotak-ayam': menuNasiKotakAyam,
            'nasi-kotak-ikan': menuNasiKotakIkan,
            'snack-box-a': menuSnackBoxA,
            'snack-box-premium': menuSnackBoxPremium,
            'es-teh': menuEsTeh,
            'air-mineral': menuAirMineral,
            'paket-rapat-hemat': menuPaketRapatHemat,
        },
    },
    placeholders: {
        menu: placeholderMenu,
        hero: placeholderHeroMain,
        'nasi-box': placeholderNasiBox,
        'catering-harian': placeholderCateringHarian,
        'snack-box': placeholderSnackBox,
        minuman: placeholderMinuman,
        'paket-acara': placeholderPaketAcara,
        'catering-kantor': placeholderCateringKantor,
        'catering-acara': placeholderCateringAcara,
        'paket-bulanan': placeholderPaketBulanan,
        'nasi-kotak-ayam': placeholderNasiKotakAyam,
        'nasi-kotak-ikan': placeholderNasiKotakIkan,
        'snack-box-a': placeholderSnackBoxA,
        'snack-box-premium': placeholderSnackBoxPremium,
        'es-teh': placeholderEsTeh,
        'air-mineral': placeholderAirMineral,
        'paket-rapat-hemat': placeholderPaketRapatHemat,
    },
} as const;
