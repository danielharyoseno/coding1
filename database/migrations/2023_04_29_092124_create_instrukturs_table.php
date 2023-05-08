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
        Schema::create('instrukturs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_instruktur');
            $table->integer('notel_instruktur');
            $table->integer('jmlh_keterlambatan');
            $table->string('email_instruktur');
            $table->string('password_instruktur');
            $table->string('username_instruktur');
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
        Schema::dropIfExists('instrukturs');
    }
};