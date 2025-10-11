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
        Schema::create('service_offerings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id');
                $table->foreign('service_id')
                    ->references('id')
                    ->on('services')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->string('name', 255);
            $table->unsignedSmallInteger('duration_minutes');
            $table->unsignedMediumInteger('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_offerings');
    }
};
