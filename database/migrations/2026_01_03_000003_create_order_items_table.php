<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->unsignedBigInteger('service_id')->nullable(); // No FK constraint strictly needed or use create_services_table?
            // Services table exists? '2025_11_28_154811_create_services_table.php' exists.
            // I'll skip strict FK for services to avoid complexity if service logic is weird, but usually safer to have it.
            // I'll make it nullable and not constrained for now to be safe, or check Service model.
            
            $table->string('product_name');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
