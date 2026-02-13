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
        Schema::table('users', function (Blueprint $table) {
            $table->string('personId')->nullable();
            $table->string('personCode')->nullable();
            $table->string('orgIndexCode')->nullable();
            $table->string('personFamilyName')->nullable();
            $table->string('personGivenName')->nullable();
            $table->string('gender')->nullable();
            $table->string('phoneNo')->nullable();
            $table->string('personPhoto')->nullable();
            $table->string('remark')->nullable();
            $table->datetime('beginTime')->nullable();
            $table->datetime('endTime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
