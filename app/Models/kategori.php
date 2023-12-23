<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;
    public $table   = "kategori";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','Nama'];

    function add($nama){
        $newKategori = new kategori();
        $newKategori->Nama = $nama;
        $newKategori->save();
    }
}
