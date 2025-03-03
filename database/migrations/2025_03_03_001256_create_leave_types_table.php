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
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->enum('category', ['sick', 'casual', 'earned', 'unpaid', 'maternity', 'paternity', 'religious', 'annual']);
            $table->integer('max_days')->default(0);
            $table->boolean('gender_specific')->default(false);
            $table->enum('aplicable_for', ['all', 'male', 'female'])->default('all');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_types');
    }
};
