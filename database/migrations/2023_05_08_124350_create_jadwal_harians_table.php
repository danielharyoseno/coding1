<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_harians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_instruktur');
            $table->foreign('id_instruktur')->references('id')->on('instrukturs')->onDelete('cascade');
            $table->unsignedBigInteger('id_jadwal_umum');
            $table->foreign('id_jadwal_umum')->references('id')->on('jadwal_umums')->onDelete('cascade');
            $table->date('tanggal_kelas');
            $table->string('keterangan');
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
        Schema::dropIfExists('jadwal_harians');
    }
};