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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_type_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->string('color', 6);
            $table->boolean('availability')->default(false);
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->foreign('car_type_id')->references('id')->on('car_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
