<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $fillable = [
        'id_user', 'id_prodi', 'nama', 'nim', 'semester', 'ipk', 'kelas',
        'foto_khs', 'nik', 'alamat', 'no_hp', 'no_wa', 'status_bidikmisi'
    ];

    public function prodi()
    {
        return $this->belongsTo('App\Prodi', 'id_prodi');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

    public function ambilGambarKHS() 
    {
        if(!$this->foto_khs){
            return asset('Images/Mahasiswa/KHS/a.png');
        }else{
            return asset('Images/Mahasiswa/KHS/'.$this->foto_khs);
        }
    }
}
