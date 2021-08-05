<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    protected $table = 'beasiswa';
    protected $fillable = [
        'nama_beasiswa', 'tahun_perolehan', 'min_ipk', 
        'jenis', 'kontrak_beasiswa', 'persyaratan'
    ];

    public function ambilFile() 
    {
        if(!$this->persyaratan){
            return asset('File/Beasiswa/Persyaratan/a.png');
        }else{
            return asset('File/Beasiswa/Persyaratan/'.$this->persyaratan);
        }
    }
}
