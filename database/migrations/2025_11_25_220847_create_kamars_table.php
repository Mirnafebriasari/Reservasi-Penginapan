<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Membuat tabel 'kamars'
        Schema::create('kamars', function (Blueprint $table) {
            $table->id(); // kolom primary key 'id' (unsignedBigInteger auto increment)
            $table->string('nama_kamar'); // nama kamar (string 255)
            $table->string('status')->default('available'); // status kamar dengan default 'available'
            $table->integer('harga'); // harga kamar (integer)
            $table->text('deskripsi')->nullable(); // deskripsi kamar, nullable
            $table->timestamps(); // created_at dan updated_at otomatis
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kamars');
    }
};
