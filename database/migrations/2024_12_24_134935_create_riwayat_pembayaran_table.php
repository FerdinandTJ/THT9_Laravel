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
        Schema::create('riwayat_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warga_id')->constrained()->onDelete('cascade');
            $table->foreignId('tagihan_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->string('bukti_pembayaran')->nullable();
            $table->timestamp('tanggal_bayar')->nullable();
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_pembayaran');
    }
};
