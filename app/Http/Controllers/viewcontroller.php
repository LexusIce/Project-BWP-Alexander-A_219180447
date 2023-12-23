<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\users;
use App\Models\withlist;
use App\Rules\email;
use App\Rules\username;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class viewcontroller extends Controller
{
    //
    function Logout(){
        Session::forget('login');
        return redirect('/');
    }
    function index() {
        $param['data'] = barang::get();
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        return view('Home',$param);
    }
    function clothes($fkBarang){
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $data = barang::where('fk_kategori','=',$fkBarang)->get();
        $param['databarang'] = $data;
        return view('clothes',$param);
    }
    function accessories($fkBarang){
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $data = barang::where('fk_kategori','=',$fkBarang)->get();
        $param['databarang'] = $data;
        return view('accessories',$param);
    }
    function pats($fkBarang){
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $data = barang::where('fk_kategori','=',$fkBarang)->get();
        $param['databarang'] = $data;
        return view('pats',$param);
    }
    function Shoes($fkBarang){
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $data = barang::where('fk_kategori','=',$fkBarang)->get();
        $param['databarang'] = $data;
        return view('Shoes',$param);
    }
    function vLogin() {
        return view('login');
    }
    function Login(Request $req){
        if($req->username == 'admin' && $req->pass == 'admin'){
            Session::put('login','admin');
            return redirect('/admin/home');
        }
        else{
            $data = DB::select("select * from users");
            $bool = false;
            $tempid = 0;
            foreach ($data as $key) {
                if($req->username == $key->Username && password_verify($req->pass,$key->Password)){
                    // Session::put('login',$key->id);
                    // return redirect('/');
                    $tempid = $key->id;
                    $bool = true;
                }
            }
            if($bool == true){
                Session::put('login',$tempid);
                return redirect('/');
            }else{
                return redirect()->back()->with('msg','user tidak terdaftar');
            }
        }
    }
    function Register() {
        return view('Register');
    }
    function pRegister(Request $req){
        if($req->validate([
            'username'=>['required',new username],
            'Nama'=>['required'],
            'Email'=>['required', new email],
            'pass'=>['required','confirmed'],
        ])){
            $newuser = new users();
            $newuser->Registers($req->username,$req->Nama,$req->Email,Hash::make($req->pass));
            return redirect()->back();
        };
    }
    function search(Request $req){
        if(Session::has('login')){
            $id = Session::get('login');
            $param['datawithlist'] = withlist::where('fk_users','=',$id)->get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $search = DB::select("SELECT b.id as id,b.Nama as Nama,b.Gambar as Gambar, b.Harga as Harga FROM barang b , merek m
        WHERE b.fk_merek = m.id and m.Nama LIKE '%".$req->Search."%' OR b.Nama LIKE '%".$req->Search."' GROUP BY b.Nama,b.id,b.Gambar,b.Harga");
        //dd($search);
        $param['Search'] = $search;
        return view('search',$param);
    }
}
