<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'customer_whatsapp',
        'event_address',
        'event_date',
        'event_time',
        'notes',
        'total_amount',
        'status',
    ];

    protected $casts = [
        'event_date' => 'date',
        'total_amount' => 'decimal:2',
        'status' => OrderStatus::class,
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeLatestOrders(Builder $query): Builder
    {
        return $query->latest();
    }

    public function scopeByStatus(Builder $query, OrderStatus|string|null $status): Builder
    {
        if (blank($status)) {
            return $query;
        }

        $value = $status instanceof OrderStatus ? $status->value : $status;

        return $query->where('status', $value);
    }

    public function scopeByEventDate(Builder $query, string|null $eventDate): Builder
    {
        if (blank($eventDate)) {
            return $query;
        }

        return $query->whereDate('event_date', $eventDate);
    }
}
