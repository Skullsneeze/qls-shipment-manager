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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();
            $table->string('qls_id')
                ->unique()
                ->nullable()
                ->comment('UUID of the shipment received from the QLS API');
            $table->string('qls_token')
                ->nullable()
                ->comment('Token used for getting labels, received from the QLS API');
            $table->string('packing_slip')
                ->nullable()
                ->comment('The path to the generated packing slip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
