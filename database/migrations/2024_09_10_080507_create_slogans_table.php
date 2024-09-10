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
        Schema::create('slogans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('slogan_title');
            $table->string('slogan_description');
            $table->enum('slogan_status',['0',1])->default('1');
            $table->smallInteger('slogan_sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slogans');
    }
};
