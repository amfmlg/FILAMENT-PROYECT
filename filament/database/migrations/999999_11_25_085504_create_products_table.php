<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('image_url');
            $table->decimal('price', 8, 2);
            $table->integer('stock');
            $table->foreignId('category_id')->constrained();
            $table->foreignId('provider_id')->nullable()->constrained(); // Asegúrate de que esta columna tenga un valor predeterminado o sea nullable
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->foreignId('status_id')->nullable()->constrained(); // Asegúrate de que esta columna tenga un valor predeterminado o sea nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */ 
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
