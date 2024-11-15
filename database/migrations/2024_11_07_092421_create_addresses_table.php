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
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->string('type')->comment('Can be either shipping or billing');
            $table->string('company_name')->nullable();
            $table->string('company_vat')->nullable();
            $table->string('company_eori')->nullable();
            $table->string('company_oss')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->string('street');
            $table->string('housenumber');
            $table->string('address_line_2');
            $table->string('zipcode');
            $table->string('city');
            $table->string('country');
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
