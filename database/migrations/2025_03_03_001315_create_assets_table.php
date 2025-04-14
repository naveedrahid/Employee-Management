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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->string('asset_name');
            $table->string('asset_code')->unique();
            $table->date('assigned_date')->nullable();
            $table->date('return_date')->nullable();
            $table->enum('status', ['assigned', 'not assigned', 'return'])->default('not assigned')->nullable();
            $table->enum('condition', ['new', 'used', 'broken'])->default('new')->nullable();
            $table->text('description')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
