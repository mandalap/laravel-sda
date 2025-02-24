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
             $table->foreignId('project_id')->constrained()->cascadeOnDelete();
             $table->string('code_product');
             $table->string('nama_product');
             $table->string('panjang')->nullable();
             $table->string('lebar')->nullable();
             $table->string('luas')->nullable();
             $table->string('harga')->nullable();
             $table->string('discount')->nullable();
             $table->string('pembayaran')->nullable();
             $table->string('fee')->nullable();
             $table->string('status')->nullable();
             $table->string('jenis')->nullable();
             $table->string('sertifikat_link')->nullable();
             $table->string('ktp')->nullable();
             $table->string('slug');

             $table->softDeletes();
            $table->timestamps();
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
