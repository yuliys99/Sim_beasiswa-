<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mahasiswa')->unsigned()->nullable();
            $table->bigInteger('id_data_keluarga')->unsigned()->nullable();
            $table->bigInteger('id_data_rumah')->unsigned()->nullable();
            $table->bigInteger('id_beasiswa')->unsigned()->nullable();
            $table->string('persyaratan')->nullable();
            $table->string('status')->nullable();

            $table->timestamps();

            $table->foreign('id_mahasiswa')
                    ->references('id')
                    ->on('mahasiswa');

            $table->foreign('id_data_keluarga')
                    ->references('id')
                    ->on('data_keluarga');

            $table->foreign('id_data_rumah')
                    ->references('id')
                    ->on('data_rumah');

            $table->foreign('id_beasiswa')
                    ->references('id')
                    ->on('beasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pendaftaran');
    }
}
