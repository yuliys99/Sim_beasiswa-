<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_role')->unsigned();
            $table->string('nama');
            $table->string('username');
            $table->string('email')->nullable();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            // $table->rememberToken();
            $table->timestamps();

            $table->foreign('id_role')
                    ->references('id')
                    ->on('role');
        });

        DB::table('user')->insert(
            [[
                'id_role' => '1',
                'nama' => 'Wadir 3',
                'username' => 'wadir3',
                'email' => 'wadir3@gmail.com',
                'password' => bcrypt('1234567'),
            ],[
                'id_role' => '2',
                'nama' => 'Akademik',
                'username' => 'akademik',
                'email' => 'akademik@gmail.com',
                'password' => bcrypt('1234567'),
            ],[
                'id_role' => '3',
                'nama' => 'Admin Prodi',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('1234567'),
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
        Schema::dropIfExists('user');
    }
}
