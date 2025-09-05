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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('session_id')->nullable();
            $table->timestamps();
            
            // For guest identification
            $table->string('guest_identifier')->nullable();
            $table->index(['session_id', 'guest_identifier']);
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained('menu_items');
            $table->integer('quantity')->default(1);
            $table->timestamps();
            
            // For tracking if item is from a guest session
            $table->string('guest_identifier')->nullable();
        });

        Schema::create('cart_item_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('cart_items')->onDelete('cascade');
            $table->foreignId('variation_id')->constrained('item_variations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_item_variations');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
