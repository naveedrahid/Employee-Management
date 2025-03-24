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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->time('check_in')->nullable();
            $table->enum('check_in_status', ['present', 'absent', 'leave', 'late', 'half-day'])->nullable();
            $table->time('check_out')->nullable();
            $table->enum('check_out_status', ['out', 'absent', 'leave', 'late', 'half-day'])->nullable();
            $table->json('location')->nullable();
            $table->string('ip_address')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
