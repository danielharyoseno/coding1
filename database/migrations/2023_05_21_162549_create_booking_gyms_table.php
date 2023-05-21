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
        Schema::create('booking_gyms', function (Blueprint $table) {
            $table->id();
            $table->string('no_booking_gym');
            $table->unsignedBigInteger('id_member');
            $table->foreign('id_member')->references('id')->on('members')->onDelete('cascade');
            $table->dateTime('tgl_booking_gym');
            $table->date('tgl_reservasi_gym');
            $table->unsignedBigInteger('id_gym');
            $table->foreign('id_gym')->references('id')->on('gyms')->onDelete('cascade');
            $table->time('jam_presensi_gym')->nullable();
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
        Schema::dropIfExists('booking_gyms');
    }
};