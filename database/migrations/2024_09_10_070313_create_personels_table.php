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
        Schema::create('personels', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('personel_name');
            $table->string('personel_phone');
            $table->string('personel_read');
            $table->text('personel_descripton');
            $table->date('personel_date');
            $table->string('personel_email');
            $table->string('personel_code');
            $table->enum('personel_status',['0','1'])->default('1');
            $table->smallInteger('personel_sort');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personel');
    }
};
