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
    Schema::create('kos', function (Blueprint $table) {
        $table->id();
        // Menghubungkan kos dengan pemiliknya (mengambil ID dari tabel users)
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        $table->string('nama_kos');
        $table->text('deskripsi');
        $table->integer('harga_per_bulan');
        $table->text('alamat');
        $table->text('fasilitas'); // Contoh: "AC, Wifi, Kamar Mandi Dalam"
        $table->string('kontak_pemilik'); // Nomor WhatsApp pemilik kos
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kos');
    }
};
