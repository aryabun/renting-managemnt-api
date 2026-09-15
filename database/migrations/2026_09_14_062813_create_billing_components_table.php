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
        Schema::create('billing_components', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('billable'); // Property OR SubUnit
            $table->foreignId('billing_component_type_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('USD');
            $table->timestamp('effective_from');
            $table->timestamp('effective_to')->nullable(); // null = currently active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing_components');
    }
};
