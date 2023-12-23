<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    public $table   = "barang";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','fk_merek','fk_kategori','Nama',"Harga",'Deskripsi','Gambar'];
    function addbarang($nama,$fkkategori,$fkmerek,$deskripsi,$Harga,$Gambar,$namagambar){
        $newitem = new barang();
        $newitem->fk_merek = $fkmerek;
        $newitem->fk_kategori = $fkkategori;
        $newitem->Nama = $nama;
        $newitem->Harga = $Harga;
        $newitem->Deskripsi = $deskripsi;
        $newitem->Gambar = $namagambar;
        $Gambar->move("product",$namagambar);
        $newitem->save();
    }
}
