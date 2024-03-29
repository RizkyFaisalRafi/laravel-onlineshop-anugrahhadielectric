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

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            // name
            $table->string('name');
            // description
            $table->text('description')->nullable();
            // brand
            $table->string('brand')->nullable();
            // image
            $table->string('image')->nullable();
            // price
            $table->string('price')->nullable();
            // in stock or not
            $table->string('stock');
            // Sudah habis atau tidak?
            $table->boolean('is_available')->default(true);

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
