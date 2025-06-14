<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pharmacy_product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('pharmacy_id')
                ->constrained('pharmacies')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
           $table->foreignUuid('product_id')
                ->constrained('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
                $table->unique(['pharmacy_id', 'product_id'], 'pharmacy_product_unique');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pharmacy_product');
    }
};
