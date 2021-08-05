<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beasiswa', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('id_kelas')->unsigned()->nullable();
            $table->string('nama_beasiswa');
            $table->integer('tahun_perolehan')->nullable();
            $table->double('min_ipk')->nullable();
            $table->string('jenis')->nullable();
            $table->string('kontrak_beasiswa')->nullable();
            $table->string('persyaratan')->nullable();
            $table->timestamps();

            // $table->foreign('id_kelas')
            //         ->references('id')
            //         ->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beasiswa');
    }
}
