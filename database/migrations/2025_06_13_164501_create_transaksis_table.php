<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('transaksis', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->decimal('jumlah', 12, 2);
        $table->enum('jenis', ['pemasukan', 'pengeluaran']);
        $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
