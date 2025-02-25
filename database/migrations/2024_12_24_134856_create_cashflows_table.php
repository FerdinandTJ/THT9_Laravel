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
        Schema::create('cashflows', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['pemasukan', 'pengeluaran']);
            $table->string('kategori');
            $table->decimal('jumlah', 15, 2);
            $table->text('keterangan')->nullable();
            $table->foreignId('perumahan_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashflows');
    }
};
