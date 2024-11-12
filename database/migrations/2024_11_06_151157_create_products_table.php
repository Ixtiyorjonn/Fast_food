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
            $table->string('name');
            $table->float('price');
            $table->string('description')->nullable();
            $table->boolean('on_discount')->default(false);
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('sub_category_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('photo_url');
            $table->boolean('new')->default(true);
            $table->float('duration_time');
            $table->timestamp("created_at")->useCurrent()->nullable();
            $table->timestamp("updated_at")->useCurrent()->nullable();
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
