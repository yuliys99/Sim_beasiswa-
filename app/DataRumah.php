<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataRumah extends Model
{
    protected $table = 'data_rumah';
    protected $fillable = [
        'id_mahasiswa', 'kepemilikan_rumah', 'thn_perolehan', 'daya_listrik',
        'luas_tanah_bangunan', 'bahan_atap', 'bahan_lantai', 'bahan_tembok', 'aset_keluarga', 
        'prestasi', 'foto_rumah'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo('App\Mahasiswa', 'id_mahasiswa'); 
    }

    public function ambilGambarRumah()
    {
        if(!$this->foto_rumah){
            return asset('Images/Mahasiswa/Foto_Rumah/a.png');
        }else{
            return asset('Images/Mahasiswa/Foto_Rumah/'.$this->foto_rumah);
        }
    }
}
