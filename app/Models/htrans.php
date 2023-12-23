<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class htrans extends Model
{
    public $table   = "htrans";
    public $primaryKey = "id_nota";
    protected $incremental=false;
    protected $keyType = 'string';
    public $timestamps = false;
    public $fillable = ['id_nota','fk_customer','Grandtotal','Tanggal',"snap_token",'status'];
}
