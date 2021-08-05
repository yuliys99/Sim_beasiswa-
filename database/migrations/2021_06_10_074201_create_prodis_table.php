<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi');
            $table->timestamps();
        });

        DB::table('prodi')->insert(
            [[
                'nama_prodi' => 'Teknik Informatika'
            ],[
                'nama_prodi' => 'Teknik Sipil'
            ],[
                'nama_prodi' => 'Teknik Mesin'
            ]]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prodi');
    }
}
