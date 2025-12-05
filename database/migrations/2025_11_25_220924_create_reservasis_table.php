<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // FK ke tabel users, hapus reservasi saat user dihapus
            $table->foreignId('kamar_id')->constrained('kamars')->onDelete('cascade'); // FK ke tabel kamars, hapus reservasi saat kamar dihapus
            $table->string('nama_tamu'); // nama tamu yang melakukan reservasi
            $table->string('nomor_wa', 20)->nullable(); // nomor WhatsApp tamu, nullable
            $table->dateTime('tanggal_checkin'); // tanggal & waktu check-in
            $table->dateTime('tanggal_checkout'); // tanggal & waktu check-out
            $table->integer('jumlah_tamu'); // jumlah tamu yang menginap
            $table->decimal('total_harga', 12, 2)->nullable(); // total harga, dengan 2 desimal, nullable
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending'); // status reservasi
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
