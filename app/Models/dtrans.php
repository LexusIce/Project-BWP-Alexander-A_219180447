<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dtrans extends Model
{
    public $table   = "dtrans";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','fk_htrans','fk_barang','qty',"Harga",'Subtotal'];
}
