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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('developer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('lokasi_id')->constrained('lokasi')->cascadeOnDelete();
            $table->foreignId('kategori_id')->constrained('kategori')->cascadeOnDelete();
            $table->foreignId('jenis_id')->constrained('jenis')->cascadeOnDelete();
            $table->string('nama_project');
            $table->string('slug');
            $table->text('alamat_project');
            $table->string('url_video')->nullable();
            $table->string('google_map')->nullable();
            $table->string('latlang')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('sertifikat')->nullable();
            $table->string('status_sertifikat')->nullable();
            $table->string('transaksi')->nullable();
            $table->string('status')->default('tampil');
            $table->foreignId('kelompok_id')->constrained('kelompok')->cascadeOnDelete();
            $table->string('is_approved')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
