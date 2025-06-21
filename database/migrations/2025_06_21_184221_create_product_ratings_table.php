<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration
{

    public function up(): void
    {
        Schema::create('product_ratings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('name');
            $table->string('email');
            $table->tinyInteger('stars');
            $table->text('review')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->unique(['product_id', 'email', 'ip_address'], 'unique_product_rating');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('product_ratings');
    }
};
