<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'id_mahasiswa', 'id_data_keluarga', 'id_data_rumah', 'id_beasiswa', 'status', 'persyaratan'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa');
    }

    public function beasiswa()
    {
        return $this->belongsTo('App\Beasiswa', 'id_beasiswa');
    }

    public function data_keluarga()
    {
        return $this->belongsTo('App\DataKeluarga', 'id_data_keluarga');
    }

    public function data_rumah()
    {
        return $this->belongsTo('App\DataRumah', 'id_data_rumah');
    }

    public function ambilFilePersyaratan() 
    {
        if(!$this->persyaratan){
            return asset('File/Mahasiswa/Persyaratan/a.png');
        }else{
            return asset('File/Mahasiswa/Persyaratan/'.$this->persyaratan);
        }
    }
}
