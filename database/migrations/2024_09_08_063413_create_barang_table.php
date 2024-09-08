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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_ruangan');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('gambar');
            $table->text('keterangan');
            $table->string('kategori');
            $table->integer('stok');
            $table->string('satuan');
            $table->enum('kondisi',['baik', 'rusak', 'dalam perbaikan', 'tidak digunakan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
