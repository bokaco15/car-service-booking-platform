<?php

use App\Enums\ServiceStatus;
use App\Models\Booking;
use App\Models\Service;
use App\Models\ServiceOffering;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Booking::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained(Service::TABLE)->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('service_offering_id')->nullable()->constrained(ServiceOffering::TABLE)->cascadeOnUpdate()->cascadeOnDelete();
            $table->time('start_at');
            $table->time('end_at');
            $table->string('status')->default(ServiceStatus::PENDING);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
