<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\stock;
use App\Models\withlist;
use App\Models\htrans;
use App\Models\dtrans;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class usercontroller extends Controller
{
    //
    function test(){
        if(Session::has('login')){
            $param['datawithlist'] = withlist::get();
            $dataTrans=htrans::where("fk_customer",Session::get("login"))->get();
            foreach ($dataTrans as $key => $value) {
                if ($value->status==2) {
                    \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
                    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
                    \Midtrans\Config::$isProduction = false;
                    // Set sanitization on (default)
                    \Midtrans\Config::$isSanitized = true;
                    // Set 3DS transaction for credit card to true
                    \Midtrans\Config::$is3ds = true;
                    $status = \Midtrans\Transaction::status($value->id_nota);
                    $status_format=json_decode(json_encode($status), true);
                    $dataUpdate=htrans::findOrFail($value->id_nota);
                    if ($status_format["transaction_status"]=="capture"||$status_format["transaction_status"]=="settlement") {
                        $dataUpdate->status=1;
                        $dataUpdate->save();
                        $dataTrans[$key]->status=1;
                    }
                    else if ($status_format["transaction_status"]=="expire") {
                        $dataUpdate->status=3;
                        $dataUpdate->save();
                        $dataTrans[$key]->status=3;
                    }
                }
            }
            $param["dataHistory"]=$dataTrans;
        }
        else{
            $param['datawithlist'] = [];
            $param['dataHistory'] = [];
        }
        return view("historitransaksi",$param);
    }
    function detail($id){
        $databarang = barang::where('id','=',$id)->get();
        $datastock = stock::where('fk_barang','=',$id)->get();
        if(Session::has('login')){
            $param['datawithlist'] = withlist::get();
        }
        else{
            $param['datawithlist'] = [];
        }
        $param['databarang'] = $databarang;
        $param['datastock'] = $datastock;
        return view('detail',$param);
    }
    function addcart(Request $req){
        if(!Session::has('login')){
            return redirect()->back()->with('msg','Login Terlebih Dahulu');
        }
        else{
            $datacart = [];
            $total = $req->harga * $req->quantity_input;
            if(!Session::has('cart')){
                $total = $req->harga * $req->quantity_input;
                $newdatacart = [
                    'fk_barang' => $req->id,
                    'nama'=> $req->nama,
                    'qty' => $req->quantity_input,
                    'ukuran' => $req->product_radio,
                    'harga' => $req->harga,
                    'total' => $total,
                    'gambar'=>$req->gambar
                ];
                array_push($datacart,$newdatacart);
                Session::put('cart',$datacart);
                //echo json_encode(Session::get('cart'));
                return redirect()->back();
            }
            else{
                $datacart = Session::get('cart');
                $newdatacart = [
                    'fk_barang' => $req->id,
                    'nama'=> $req->nama,
                    'qty' => $req->quantity_input,
                    'ukuran' => $req->product_radio,
                    'harga' => $req->harga,
                    'total' => $total,
                    'gambar'=>$req->gambar
                ];
                array_push($datacart,$newdatacart);
                Session::put('cart',$datacart);
                //echo json_encode(Session::get('cart'));
                return redirect()->back();
            }
        }
        //echo $req->product_radio;
        //echo $req->quantity_input;
    }
    function lcart(){
        if(Session::has('login')){
            $param['datawithlist'] = withlist::get();
        }
        else{
            $param['datawithlist'] = [];
        }
        return view('carts',$param);
    }
    function unfav($id,$idfav){
        //echo $id.','.$idfav;
        $unfav = withlist::find($idfav);
        $unfav->delete();
        return redirect()->back();
    }
    function fav($id){
        if(Session::has('login')){
            $newfav = new withlist();
            $idusers = Session::get('login');
            $newfav->addfav($idusers,$id);
            return redirect()->back();
        }
        else{
            return redirect()->back()->with('msg','Login Terlebih dahulu');
        }
    }
    function withlist(){
        $idusers = Session::get('login');
        $param['datawithlist'] = withlist::get();
        $data = DB::select("select b.id as id, b.Nama as NamaBarang, b.Harga as Harga,b.Gambar as gambar from barang b , users u , withlist w where b.id = w.fk_barang and w.fk_users =u.id and u.id = '$idusers'");
        $param['data']= $data;
        return view('withlisth',$param);
    }
    public function getSnapToken()
    {
        $dataHjual=htrans::get();
        $ctrHjual=1;
        $id="N".date_format(date_create('now'),'dmYHi');
        foreach ($dataHjual as $key => $value) {
            if ($id==substr($value->id_nota,0,12)) {
                $ctrHjual++;
            }
        }
        $dataCustomer=users::findOrFail(Session::get("login"));
        if ($ctrHjual<10) {
            $id=$id."00".$ctrHjual;
        }
        if ($ctrHjual>9&&$ctrHjual<100) {
            $id=$id."0".$ctrHjual;
        }
        if ($ctrHjual>99) {
            $id=$id.$ctrHjual;
        }
        Session::put("id_nota",$id);
        $dataBarang=[];
        foreach (Session::get("cart") as $key => $value) {
            $dataBarang[]=array(
                    "id"=> $value["fk_barang"],
                    "price"=> $value["harga"],
                    "quantity"=> $value["qty"],
                    "name"=> $value["nama"],
                    "brand"=> "",
                    "category"=> "",
                    "merchant_name"=> ""
            );
        }
        \Midtrans\Config::$serverKey = env("MIDTRANS_SERVER_KEY");
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;
            $params = array(
                'transaction_details' => array(
                    'order_id' => $id,
                    'gross_amount' => 0,
                ),
                'customer_details' => array(
                    'first_name' => $dataCustomer->nama,
                    'last_name' => '',
                    'email' => $dataCustomer->email,
                    'phone' => "blabla",
                    'adress'=>"blabla"
                ),
                'item_details' => $dataBarang
            );
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            echo $snapToken;
    }
    public function insertTransaksi()
    {
        $status=1;
        if ($_POST["status"]!="lunas") {
            $status=2;
        }
        $dataCart=Session::get("cart");
        $grandtotal=0;
        foreach ($dataCart as $key => $value) {
            $grandtotal+=$value["total"];
        }
        $dataHtrans=new htrans();
        $dataHtrans->id_nota=Session::get("id_nota");
        $dataHtrans->fk_customer=Session::get("login");
        $dataHtrans->Grandtotal=$grandtotal;
        $dataHtrans->Tanggal=date_format(date_create('now'),'Y/m/d');
        $dataHtrans->snap_token=$_POST["snap_token"];
        $dataHtrans->status=$status;
        $dataHtrans->save();
        foreach ($dataCart as $key => $value) {
            $dataDtrans=new dtrans();
            $dataDtrans->fk_htrans=Session::get("id_nota");
            $dataDtrans->fk_barang=$value["fk_barang"];
            $dataDtrans->qty=$value["qty"];
            $dataDtrans->Harga=$value["harga"];
            $dataDtrans->Subtotal=$value["total"];
            $dataDtrans->save();
        }
        foreach (session()->get('Datacart') as $key => $value) {
            $updatestock = stock::find($value['ukuran']);
            $tempjumstock = $updatestock[0]->JumlahStock - $value['qty'];
            $updatestock[0]->JumlahStock = $tempjumstock;
            $updatestock->save();
        }
        session()->forget('Datacart);
        return redirect('/');
        echo "berhasil";
    }

}
