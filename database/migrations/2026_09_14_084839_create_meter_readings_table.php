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
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('billing_component_id')->constrained()->cascadeOnDelete();
            $table->decimal('previous_reading', 12, 2);
            $table->decimal('current_reading', 12, 2);
            $table->decimal('consumption', 12, 2); // current - previous, stored for easy querying
            $table->decimal('rate_used', 12, 2);   // snapshot of the rate at that time
            $table->decimal('amount', 12, 2);      // consumption * rate_used, snapshot
            $table->date('reading_date');          // when this reading was recorded
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_readings');
    }
};
