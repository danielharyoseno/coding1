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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('no_member');
            $table->string('nama_member');
            $table->string('alamat_member');
            $table->date('tgl_lahir');
            $table->string('email_member');
            $table->integer('notel_member');
            $table->string('username_member');
            $table->string('password_member');
            $table->string('status_membership')->nullable();
            $table->integer('saldo_deposit_member')->nullable();
            $table->date('masa_berlaku_member')->nullable();
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
        Schema::dropIfExists('members');
    }
};