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
        Schema::create('item_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variation_type_id')->constrained('variation_types')->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained('menu_items')->onDelete('cascade');
            $table->string('name'); // e.g., 'Small', 'Medium', 'Large'
            $table->string('description', 555)->nullable();
            $table->boolean('is_default')->default(false);
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_variations');
    }
};
