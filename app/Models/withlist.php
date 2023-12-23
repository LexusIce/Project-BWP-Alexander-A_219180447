<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class withlist extends Model
{
    use HasFactory;
    public $table   = "withlist";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','fk_users','fk_barang'];
    function addfav($fkusers,$fkbarang){
        $newfav = new withlist();
        $newfav->fk_users = $fkusers;
        $newfav->fk_barang = $fkbarang;
        $newfav->save();
    }
}
