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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('products_title');
            $table->string('products_key');
            $table->string('products_value');
            $table->string('products_type');
            $table->text('products_description');
            $table->integer('products_sort')->nullable();
            $table->enum('products_status',['1','0'])->default('1');
            $table->enum('products_delete',['0','1']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
