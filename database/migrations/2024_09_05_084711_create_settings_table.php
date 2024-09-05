<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('settings_title');
            $table->string('settings_key');
            $table->string('settings_value');
            $table->string('settings_type');
            $table->text('settings_description');
            $table->integer('settings_sort')->nullable();
            $table->enum('settings_status',['1','0'])->default('1');
            $table->enum('settings_delete',['0','1']);
            });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
