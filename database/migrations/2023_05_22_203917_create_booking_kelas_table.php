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
        Schema::create('booking_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('no_booking_kelas');
            $table->unsignedBigInteger('id_member');
            $table->foreign('id_member')->references('id')->on('members')->onDelete('cascade');
            $table->unsignedBigInteger('id_harian');
            $table->foreign('id_harian')->references('id')->on('jadwal_harians')->onDelete('cascade');
            $table->unsignedBigInteger('id_deposit');
            $table->foreign('id_deposit')->references('id')->on('deposit_kelas')->onDelete('cascade');
            $table->dateTime('tgl_booking_kelas');
            $table->date('tgl_reservasi_kelas');
            $table->dateTime('waktu_presensi_kelas');
            $table->string('status_presensi');
            $table->string('tipe_booking');
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
        Schema::dropIfExists('booking_kelas');
    }
};