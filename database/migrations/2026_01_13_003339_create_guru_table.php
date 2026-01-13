<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sekolah_id');
            $table->string('no_peserta');
            $table->string('nama_peserta');
            $table->string('status', 5);
            $table->string('nip', 18);
            $table->string('lembaga_dapodik');
            $table->string('kecamatan', 50);
            $table->string('jabatan_paruh_waktu');
            $table->string('jabatan', 50);
            $table->string('gaji');
            $table->tinyInteger('tunjangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
