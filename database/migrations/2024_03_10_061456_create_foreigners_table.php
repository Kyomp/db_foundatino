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
        Schema::create('foreigners', function (Blueprint $table) {
            $table->id();
            $table->string('passport_no', 20);
            $table->string('country', 20);
            $table->unsignedBigInteger('user_id');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('issued_at', 50);
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foreigners');
    }
};
