<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id(); // Primary key auto increment
            $table->unsignedBigInteger('reservasi_id'); // FK ke tabel reservasis
            $table->foreign('reservasi_id')->references('id')->on('reservasis')->onDelete('cascade'); // FK constraint dengan cascade delete
            $table->string('metode'); // Metode pembayaran, misal: transfer, cash, dll
            $table->integer('jumlah'); // Jumlah pembayaran dalam satuan integer, bisa dalam satuan terkecil (misal rupiah)
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending'); // Status pembayaran
            $table->string('bukti_transfer')->nullable(); // Path file bukti transfer, nullable karena belum tentu ada
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
