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
        Schema::create('prokers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama_program');
            $table->text('deskripsi');
            $table->date('tanggal_pelaksanaan');
            $table->string('tempat');
            $table->string('penanggung_jawab');
            $table->string('divisi');
            $table->decimal('anggaran', 15, 2);
            $table->string('status'); // ex: Perencanaan, Berjalan, Selesai
            $table->string('file_proposal')->nullable();
            $table->string('file_kepanitiaan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prokers');
    }
};
