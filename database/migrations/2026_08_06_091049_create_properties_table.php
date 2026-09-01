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
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->text('address')->nullable();
            $table->unsignedBigInteger('price')->nullable();

            $table->foreignId('property_type_id')->references('id')->on('property_types')->cascadeOnUpdate()->cascadeOnDelete();;
            $table->foreignId('unit_type_id')->references('id')->on('unit_types')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('status_id')->references('id')->on('statuses')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('tenant_id')->nullable()->references('id')->on('tenants')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignUuid('owner_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
