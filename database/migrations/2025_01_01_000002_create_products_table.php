<?php

// Author: Equipo Raíces

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size');
            $table->string('brand');
            $table->integer('price');
            $table->boolean('exclusive')->default(false);
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->string('color');
            $table->integer('discount')->default(0);
            $table->boolean('active')->default(true);
            $table->integer('stock')->default(0);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
