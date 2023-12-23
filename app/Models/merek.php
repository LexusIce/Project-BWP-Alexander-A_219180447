<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class merek extends Model
{
    use HasFactory;
    public $table   = "merek";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','Nama'];
    function addmerek($nama){
        $newmerek = new merek();
        $newmerek->Nama = $nama;
        $newmerek->save();
    }
}
