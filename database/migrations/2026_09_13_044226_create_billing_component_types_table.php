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
        Schema::create('billing_component_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_kh');             // "Rent", "Water", "Electricity"
            $table->string('name_en');             // "Rent", "Water", "Electricity"
            $table->string('code')->nullable(); // "rent", "water", "electricity"
            $table->enum('type', ['fixed', 'metered'])->default('fixed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_component_types');
    }
};
