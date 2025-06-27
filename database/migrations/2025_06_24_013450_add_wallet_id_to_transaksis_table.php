<?php

// database/migrations/xxxx_xx_xx_add_wallet_id_to_transaksis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->unsignedBigInteger('wallet_id')->nullable()->after('kategori_id');
            $table->foreign('wallet_id')->references('id')->on('gendri_dompet')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->dropForeign(['wallet_id']);
            $table->dropColumn('wallet_id');
        });
    }
};
