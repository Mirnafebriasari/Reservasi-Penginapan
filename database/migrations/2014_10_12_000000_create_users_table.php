<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key auto increment (bigint unsigned)
            $table->string('name'); // Nama user, tipe string default 255 karakter
            $table->string('email')->unique(); // Email unik untuk tiap user
            $table->timestamp('email_verified_at')->nullable(); // Waktu verifikasi email, nullable
            $table->string('password'); // Password hashed
            $table->rememberToken(); // Token untuk fitur "remember me" di login
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('users'); // Drop tabel users jika rollback
    }
};
