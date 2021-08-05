<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_role', 'nama', 'username', 'email', 'password', 'foto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //membuat fungsi isMahasiswa untuk Pimpinan
    public function isMahasiswa(){
        //jika role_name=mahasiswa maka benar
        if($this->id_role == 4){
            return true;
        }
            return false;
    }
    public function isAdminprodi(){
        //jika role_name=Adminprodi maka benar
        if($this->id_role == 3){
            return true;
        }
            return false;
    }
    public function isAkademik(){
        //jika role_name=Akademik maka benar
        if($this->id_role == 2){
            return true;
        }
            return false;
    }
    public function isWadir3(){
        //jika role_name=Wadir3 maka benar
        if($this->id_role == 1){
            return true;
        }
            return false;
    }

    public function ambilFotoProfile()
    {
        if(!$this->foto){
            return asset('Images/Profile/avatar.png');
        }else{
            return asset('Images/Profile/'.$this->foto);
        }
    }
}
