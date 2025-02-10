<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('grand_total', 10)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('status')->default('new');
            $table->string('currency')->nullable();
            $table->decimal('shipping_amount', 10)->nullable();
            $table->string('shipping_method')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
