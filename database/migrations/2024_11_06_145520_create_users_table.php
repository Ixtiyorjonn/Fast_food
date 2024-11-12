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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('username')->unique();
            $table->string('password');
            $table->foreignId('region_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('district_id')->constrained()->onDelete('cascade'); 
            $table->string('adress');
            $table->foreignId('role_id')->constrained()->onDelete('no action')->default(1);
            $table->timestamp("created_at")->useCurrent()->nullable();
            $table->timestamp("updated_at")->useCurrent()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
