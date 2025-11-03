<?php

use App\Models\WorkingHours;
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
        Schema::create(WorkingHours::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('day_of_week', 32);
            $table->unsignedTinyInteger('opens_at')->nullable();
            $table->unsignedTinyInteger('closes_at')->nullable();
            $table->timestamps();

            $table->unique(['service_id', 'day_of_week']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(WorkingHours::TABLE);
    }
};
