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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('sender_postCode');
            $table->string('sender_service');
            $table->enum('message_read',['0','1'])->default('0');
            $table->string('sender_email');
            $table->text('sender_message');
            $table->dateTime('sender_time');
             });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
