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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('guest_identifier')->nullable();
            $table->enum('status', [
                'pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'
            ])->default('pending');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax_amount', 10, 2)->default(0);
            $table->decimal('delivery_fee', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2);
            $table->text('delivery_address')->nullable();
            $table->string('delivery_phone')->nullable();
            $table->text('delivery_instructions')->nullable();
            $table->enum('payment_method', ['cod', 'card', 'upi', 'netbanking', 'wallet'])->default('cod');
            $table->string('payment_gateway')->nullable();
            $table->string('payment_id')->nullable();
            $table->json('gateway_response')->nullable();
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['user_id', 'status']);
            $table->index('guest_identifier');
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained('menu_items')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->text('special_instructions')->nullable();
            $table->timestamps();

            $table->index(['order_id', 'menu_item_id']);
        });

        Schema::create('order_item_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained('order_items')->onDelete('cascade');
            $table->foreignId('variation_id')->constrained('item_variations')->onDelete('cascade');
            $table->decimal('variation_price', 10, 2);
            $table->timestamps();

            $table->unique(['order_item_id', 'variation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_variations');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
