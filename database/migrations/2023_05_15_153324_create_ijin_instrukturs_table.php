<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ijin_instrukturs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_instruktur');
            $table->foreign('id_instruktur')->references('id')->on('instrukturs')->onDelete('cascade');
            $table->unsignedBigInteger('id_instruktur_pengganti');
            $table->foreign('id_instruktur_pengganti')->references('id')->on('instrukturs')->onDelete('cascade');
            $table->unsignedBigInteger('id_jadwal_harian');
            $table->foreign('id_jadwal_harian')->references('id')->on('jadwal_harians')->onDelete('cascade');
            $table->string('hari');
            $table->date('pengajuan_ijin');
            $table->date('tanggal_ijin');
            $table->time('sesi_ijin');
            $table->string('keterangan_ijin');
            $table->string('status');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ijin_instrukturs');
    }
};