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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->date('appointmentdate');
            $table->time('appointmenttime');
            $table->string('firstname');
            $table->string('lastname');
            $table->date('birthday');
            $table->string('gender');
            $table->string('address');
            $table->string('phone');
            $table->string('email');
            $table->string('medicalhistory')->nullable();
            $table->string('emergencycontactname');
            $table->string('emergencycontactrelation');
            $table->string('emergencycontactphone');
            $table->string('name')->nullable();
            $table->string('relation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
