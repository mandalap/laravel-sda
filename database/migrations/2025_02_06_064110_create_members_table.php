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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

            $table->string('sapaan');
            $table->string('nama');
            $table->string('email')->unique()->nullable();
            $table->string('telepon')->unique();
            $table->string('password');
            $table->string('recovery_code')->nullable();
            $table->string('status')->default('active');
            $table->string('gender')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('kota_id')->nullable();
            $table->string('alamat')->nullable();
            $table->string('thumbnail')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
