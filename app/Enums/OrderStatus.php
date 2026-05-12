<?php

namespace App\Enums;

enum OrderStatus: string
{
    case New = 'new';
    case Confirmed = 'confirmed';
    case Processing = 'processing';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::New => 'Baru',
            self::Confirmed => 'Dikonfirmasi',
            self::Processing => 'Diproses',
            self::Completed => 'Selesai',
            self::Cancelled => 'Dibatalkan',
        };
    }

    public function customerMessage(): string
    {
        return match ($this) {
            self::New => 'Pesanan Anda telah diterima dan menunggu konfirmasi admin.',
            self::Confirmed => 'Pesanan Anda telah dikonfirmasi dan akan diproses.',
            self::Processing => 'Pesanan sedang disiapkan oleh dapur.',
            self::Completed => 'Pesanan telah selesai.',
            self::Cancelled => 'Pesanan dibatalkan.',
        };
    }

    public function badgeVariant(): string
    {
        return match ($this) {
            self::New => 'warning',
            self::Confirmed => 'secondary',
            self::Processing => 'primary',
            self::Completed => 'success',
            self::Cancelled => 'danger',
        };
    }
}
