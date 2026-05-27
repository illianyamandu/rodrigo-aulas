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
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigInteger('user_id')->primary()->references('id')->on('users');
            $table->text('street');
            $table->text('complement')->nullable();
            $table->text('number')->nullble();
            $table->text('neighborhood');
            $table->text('city');
            $table->text('postal_code');
            $table->text('country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
