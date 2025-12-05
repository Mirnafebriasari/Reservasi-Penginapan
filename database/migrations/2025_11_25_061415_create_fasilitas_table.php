<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Fungsi untuk membuat tabel 'fasilitas'
    public function up(): void
    {
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id(); // kolom primary key 'id' dengan auto increment (bigint)
            $table->string('nama_fasilitas'); // kolom string untuk nama fasilitas (varchar default 255)
            $table->text('deskripsi')->nullable(); // kolom text untuk deskripsi fasilitas, boleh kosong (nullable)
            $table->string('foto')->nullable(); // kolom string untuk menyimpan path/filename foto, boleh kosong
            $table->timestamps(); // kolom created_at dan updated_at otomatis (timestamp)
        });
    }

    // Fungsi untuk menghapus tabel 'fasilitas' jika rollback migration
    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};
