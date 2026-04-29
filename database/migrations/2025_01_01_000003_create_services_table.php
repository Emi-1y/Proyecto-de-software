<?php

// Author: Equipo Raíces

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('employee')->nullable();
            $table->string('description')->nullable();
            $table->integer('price');
            $table->string('duration')->nullable();
            $table->string('emoji')->default('🌿');
            $table->boolean('active')->default(true);
            $table->json('features')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
