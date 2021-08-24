<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKHS extends Model
{
    protected $table = 'data_khs';

    protected $fillable = [
        'id_mahasiswa', 'semester', 'ipk', 'foto_khs'
    ];

    public function ambilFotoKhs()
    {
        if(!$this->foto_khs){
            return asset('Images/Mahasiswa/KHS/a.png');
        }else{
            return asset('Images/Mahasiswa/KHS/'.$this->foto_khs);
        }
    }
}
