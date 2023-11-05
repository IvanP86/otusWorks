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
        Schema::create('element_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreignId('element_id')->references('id')->on('elements')->onDelete('cascade');
            $table->integer('count')->default(1);
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('element_order');
    }
};
