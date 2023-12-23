<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class users extends Authenticatable
{
    use HasFactory;
    public $table   = "users";
    public $primaryKey = "id";
    public $incrementing = true;
    public $timestamps = false;
    public $fillable = ['id','Username','Nama','Email',"Password"];
    function Registers($username,$nama,$Email,$Password){
        $newusers = new users();
        $newusers->Username = $username;
        $newusers->Nama = $nama;
        $newusers->Email = $Email;
        $newusers->Password = $Password;
        $newusers->save();
    }

}
