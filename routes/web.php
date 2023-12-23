<?php

use App\Http\Controllers\admincontroller;
use App\Http\Controllers\usercontroller;
use App\Http\Controllers\viewcontroller;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\RouteCompiler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[viewcontroller::class,'index'])->middleware('users');
Route::get('/login',[viewcontroller::class,'vlogin']);
Route::get('/Register',[viewcontroller::class,"Register"])->middleware('users');
Route::post('/login',[viewcontroller::class,'login']);
Route::post('/Register',[viewcontroller::class,'pRegister']);
Route::get('/logout',[usercontroller::class,'logout'])->middleware('users');
Route::get('/acount',[usercontroller::class,])->middleware('users');
Route::get('/detailbarang/{id}',[usercontroller::class,'detail'])->middleware('users');
Route::post('/cart',[usercontroller::class,'addcart']);
Route::get('/lcart',[usercontroller::class,'lcart'])->middleware('users');
Route::get('/unfav/{id}/{idfav}',[usercontroller::class,'unfav']);
Route::get('/fav/{id}',[usercontroller::class,'fav']);
Route::get('/clothes/{fkbarang}',[viewcontroller::class,'clothes'])->middleware('users');
Route::get('/accessories/{fkbarang}',[viewcontroller::class,'accessories'])->middleware('users');
Route::get('/pats/{fkbarang}',[viewcontroller::class,'pats'])->middleware('users');
Route::get('/Shoes/{fkbarang}',[viewcontroller::class,'Shoes'])->middleware('users');
Route::get('/withlist',[usercontroller::class,'withlist'])->middleware('users');
Route::get('/Histori',[usercontroller::class,'test']);
Route::post('/search',[viewcontroller::class,'Search']);
Route::get('/Logout',[viewcontroller::class,'Logout']);
Route::prefix('/admin')->middleware('admin')->group(function(){
    Route::get('/home',[admincontroller::class,'index'])->middleware('admin');
    Route::get('/MasterBarang',[admincontroller::class,"Listbarang"]);
    Route::get('/Merek',[admincontroller::class,'merk']);
    Route::get('/ListUser',[admincontroller::class,'']);
    Route::get('/Kategori',[admincontroller::class,'Kategori']);
    Route::get('/LaporanTransaksi',[admincontroller::class,"Laporan"]);
    Route::get('/Stock/{id}',[admincontroller::class,'stock']);
    Route::get('/LogOut',[admincontroller::class,'logout']);
    //post
    Route::post('/Merek',[admincontroller::class,'addmerk']);
    Route::post('/Kategori',[admincontroller::class,"pkategori"]);
    Route::post('/MasterBarang',[admincontroller::class,'pbarang']);
    Route::post('/addstock',[admincontroller::class,'addstock']);
    Route::post('/updatestock',[admincontroller::class,'updatestock']);

});
Route::post("/getsnapToken",[usercontroller::class,"getSnapToken"]);
Route::post("/insertTrans",[usercontroller::class,"insertTransaksi"]);
