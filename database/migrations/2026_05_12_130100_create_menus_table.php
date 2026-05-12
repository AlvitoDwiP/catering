<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_category_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->string('unit')->default('porsi');
            $table->unsignedInteger('minimum_order')->default(1);
            $table->string('image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->boolean('is_recommended')->default(false);
            $table->timestamps();

            $table->index(['is_available', 'is_recommended']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
