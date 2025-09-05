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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('includes', 355)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained('menu_categories');
            $table->decimal('mrp', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('rate', 10, 2)->virtualAs('mrp - (mrp * (discount / 100))');
            $table->unsignedTinyInteger('gst')->default(0);
            $table->decimal('price', 8, 2)->virtualAs('LEAST(rate + (rate * (gst / 100)), mrp)');
            $table->boolean('is_available')->default(true);
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
