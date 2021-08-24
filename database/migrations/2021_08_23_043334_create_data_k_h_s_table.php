<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKHSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_khs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_mahasiswa')->unsigned()->nullable();
            $table->string('semester')->nullable();
            $table->double('ipk')->nullable();
            $table->string('foto_khs')->nullable();
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
        Schema::dropIfExists('data_khs');
    }
}
