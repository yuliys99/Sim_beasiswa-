<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataKeluarga extends Model
{
    protected $table = 'data_keluarga';
    protected $fillable = [
        'id_mahasiswa', 'nama_ayah', 'pekerjaan_ayah', 'penghasilan_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'penghasilan_ibu', 'tanggungan_keluarga', 'nohp_ortu'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa'); 
    }
}
