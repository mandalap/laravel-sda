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
        Schema::create('booking_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('agency_id')->nullable();
            $table->string('invoice')->nullable();
            $table->unsignedBigInteger('jumlah_uang_booking')->nullable();
            $table->unsignedBigInteger('harga_tanah');
            $table->unsignedBigInteger('diskon');
            $table->unsignedBigInteger('total_harga');
            $table->boolean('is_paid');
            $table->string('status')->nullable(); /// Booking, Pending, Dibayar
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_transactions');
    }
};
