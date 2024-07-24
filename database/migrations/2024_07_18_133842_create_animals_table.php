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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->date('birthday')->nullable();
            $table->string('type', 10);
            $table->string('health', 100);
            $table->string('description', 1000);
            $table->string('animal_status', 100);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('comment', 255)->nullable();
            $table->string('sex', 6);
            $table->unsignedInteger('color_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
            $table->foreign('color_id')->references('id')->on('colors')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
