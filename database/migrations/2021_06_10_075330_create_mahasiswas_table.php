<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->bigInteger('id_prodi')->unsigned()->nullable();
            $table->string('nama');
            $table->bigInteger('nim')->unique();
            $table->integer('semester')->nullable();
            $table->string('kelas')->nullable();
            $table->double('ipk')->nullable();
            $table->string('foto_khs')->nullable();
            $table->bigInteger('nik')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('status_bidikmisi')->nullable();
            $table->timestamps();

            $table->foreign('id_user')
                    ->references('id')
                    ->on('user');

            $table->foreign('id_prodi')
                    ->references('id')
                    ->on('prodi');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
}
