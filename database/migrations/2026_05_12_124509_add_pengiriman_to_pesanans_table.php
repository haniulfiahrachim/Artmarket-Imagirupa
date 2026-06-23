<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->enum('opsi_pengambilan', ['antar', 'ambil_sendiri'])->nullable()->after('status_pesanan');
            $table->string('alamat_pengiriman')->nullable()->after('opsi_pengambilan');
            $table->decimal('biaya_pengiriman', 15, 2)->default(0)->after('alamat_pengiriman');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['opsi_pengambilan', 'alamat_pengiriman', 'biaya_pengiriman']);
        });
    }
};