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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->decimal('total_price', $precision = 8, $scale = 2); //se si spacca lui torna qui e sistema
            $table->date('date');
            $table->string('notes')->nullable();
            $table->string('guest_name', 100);
            $table->string('guest_surname', 100);
            $table->string('guest_telephone', 100);
            $table->string('guest_email', 100);
            $table->string('guest_address', 255);
            $table->string('guest_city', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
