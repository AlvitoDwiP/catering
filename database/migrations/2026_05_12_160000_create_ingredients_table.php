<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->string('category')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->unique(['name', 'unit']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
