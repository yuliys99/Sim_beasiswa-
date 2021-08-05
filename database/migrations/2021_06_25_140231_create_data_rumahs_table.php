<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataRumahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_rumah', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mahasiswa')->unsigned()->nullable();
            $table->string('kepemilikan_rumah')->nullable();
            $table->string('foto_rumah')->nullable();
            $table->integer('thn_perolehan')->nullable();
            $table->string('daya_listrik')->nullable();
            $table->string('luas_tanah_bangunan')->nullable();
            $table->string('bahan_atap')->nullable();
            $table->string('bahan_lantai')->nullable();
            $table->string('bahan_tembok')->nullable();
            $table->string('aset_keluarga')->nullable();
            $table->string('prestasi')->nullable();

            $table->timestamps();

            $table->foreign('id_mahasiswa')
                    ->references('id')
                    ->on('mahasiswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_rumah');
    }
}
