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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('customer_name');
            $table->string('customer_companyName');
            $table->string('customer_address');
            $table->string('customer_email');
            $table->string('customer_postCode');
            $table->string('customer_password');
            $table->string('customer_read');
            $table->string('customer_code');
            $table->dateTime('customer_date');
            $table->enum('customer_status',['0','1']);
            $table->string('customer_phone');
            $table->string('customer_phoneCell');
            $table->string('customer_description');
            $table->smallInteger('customer_sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
