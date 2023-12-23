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
        Schema::create('userlist', function (Blueprint $table) {
            $table->id('id')->length(10);
            $table->string('email');
            $table->string('nama');
            $table->string('nomor_telepon');
            $table->string('username');
            $table->string('password');
            $table->string('jabatan')->default('pelanggan');
            $table->string('status', 50)->default('inactive');
            $table->string('status_belanja_bantuan_karyawan', 50)->default('inactive');
            $table->string('gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userlist');
    }
};
