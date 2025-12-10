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
        Schema::table('inventaris', function (Blueprint $table) {
            $table->dropColumn('kondisi'); // Hapus kolom kondisi

            // Tambahkan kolom jumlah kondisi
            $table->integer('jumlah_baik')->nullable()->after('jumlah');
            $table->integer('jumlah_perbaikan')->nullable()->after('jumlah_baik');
            $table->integer('jumlah_rusak')->nullable()->after('jumlah_perbaikan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris', function (Blueprint $table) {
            //
        });
    }
};
