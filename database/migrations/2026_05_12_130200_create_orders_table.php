<?php

use App\Enums\OrderStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->string('customer_name');
            $table->string('customer_whatsapp');
            $table->text('event_address');
            $table->date('event_date');
            $table->time('event_time');
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default(OrderStatus::New->value);
            $table->timestamps();

            $table->index(['status', 'event_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
