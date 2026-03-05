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
        Schema::create('alert_responses', function (Blueprint $table) {
            $table->id();
            $table->datetime('sendTime')->nullable();
            $table->string('eventId')->nullable();
            $table->string('eventType')->nullable();
            $table->string('status')->nullable();
            $table->string('human_id')->nullable();
            $table->string('name')->nullable();
            $table->string('wearMaskStatus')->nullable();
            $table->text('response_data');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alert_responses');
    }
};
