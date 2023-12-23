<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\dtrans;
use App\Models\htrans;
use App\Models\kategori;
use App\Models\merek;
use App\Models\stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class admincontroller extends Controller
{
    //
    function index(){
        return view('admin.adminhome');
    }
    function logout(){
        Session::forget('login');
        return redirect('/');
    }
    function merk(){
        $data = merek::get();
        $param['datamerek'] = $data;
        return view('admin.merk',$param);
    }
    function stock($id){
        $data = DB::select("select * from stock where fk_barang = '$id'");
        $param['id'] = $id;
        $param['datastock'] =$data;
        return view('admin.Stock',$param);
    }
    function addmerk(Request $req){
        $nama = $req->NamaMerek;
        //echo $nama;
        $newmerk = New merek();
        $newmerk->addmerek($nama);
        return redirect()->back()->withErrors(['msg'=>'Input Berhasil']);
    }
    function Kategori(){
        $data = kategori::get();
        $param['datakategori'] = $data;
        return view('admin.kategori',$param);
    }
    function Listbarang(){
        $datakategori = kategori::get();
        $datamerek = merek::get();
        $databarang = DB::select('SELECT b.id as id,m.Nama as merk,b.Nama as Nama, b.Harga as Harga,k.Nama as kategori,CASE WHEN SUM(s.JumlahStock)IS NULL THEN 0 ELSE SUM(s.JumlahStock) END as stock
        FROM barang b
        LEFT JOIN stock s
        ON b.id=s.fk_barang,merek m ,kategori k
        WHERE b.fk_merek = m.id and b.fk_kategori = k.id
        GROUP BY b.id,m.Nama,b.Nama,b.Harga,k.nama');
        $param['datakategori'] = $datakategori;
        $param['datamerek'] = $datamerek;
        $param['databarang'] = $databarang;
        return view('admin.addbarang',$param);
    }
    function pkategori (Request $req){
        $nama = $req->NamaKategori;
        //echo $nama;
        $newdata = new kategori();
        $newdata->add($nama);
        return redirect()->back();
    }
    function pbarang(Request $req){
        $namabarang = $req->Namabarang;
        $kategori = $req->kategori;
        $merek = $req->Merek;
        $harga = $req->Harga;
        $gambar = $req->gambar;
        $deskripsi =$req->Deskripsi;
        $namagambar = $gambar->getClientOriginalName();
        //echo $namabarang;
        $newdata = new barang();
        $newdata->addbarang($namabarang,$kategori,$merek,$deskripsi,$harga,$gambar,$namagambar);
        return redirect()->back()->with('msg','Berhasil Menambah data');
    }
    function addstock(Request $req){
        $newstock = new stock();
        $newstock->AddStock($req->fkbarang,$req->Ukuran,$req->qty);
        //echo $req->qty.','.$req->Ukuran;
        return redirect()->back()->with('msg','Berhasil Menambah Stock');
    }
    function updatestock(Request $req){
        $ukuran = $req->hukuran;
        $id = $req->id;
        $stock = $req->JumlahStock;
        $laststock = stock::where('id',$id)->get();
        $totalstock = $laststock[0]->JumlahStock + $stock;
        //echo $totalstock;
        $databarang = stock::find($id);
        $databarang->JumlahStock = $totalstock;
        $databarang->save();
        return redirect()->back()->with('msg','Berhasil Mengupdate stock');
    }
    function Laporan(){
        $datahtrans = htrans::get();
        $datadtrans = DB::select("select b.nama as Nama_item,b.Harga as Harga,dt.fk_htrans as fk_htrans, dt.qty as qty , dt.Subtotal as Subtotal from barang b , dtrans dt where dt.fk_barang =b.id");
        $param['datahtrans'] = $datahtrans;
        $param['datadtrans'] = $datadtrans;
        return view('admin.Laporanpenjualan',$param);
    }
}
