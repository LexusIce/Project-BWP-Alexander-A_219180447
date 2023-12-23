<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    use HasFactory;
    public $table   = "stock";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','fk_barang','Ukuran','JumlahStock'];
    function AddStock($fkbarang,$ukuran,$jum){
        $newstock = new stock();
        $newstock->fk_barang = $fkbarang;
        $newstock->Ukuran = $ukuran;
        $newstock->JumlahStock = $jum;
        $newstock->save();
    }
}
