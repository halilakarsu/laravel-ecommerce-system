<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_title');
            $table->string('product_imagepath');
            $table->string('product_file');
            $table->integer('product_type_id');
            $table->string('product_slug');
            $table->enum('product_status',['0','1'])->default('1');
            $table->string('product_code');
            $table->enum('product_sort',['0','1']);
            $table->text('product_detail')->nullable();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
