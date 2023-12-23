@extends('tamplate.adminmaster')
@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                @include('alert')
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Barang</label>
                        <input type="text" class="form-control" name="Namabarang" id="exampleFormControlInput1" placeholder="Nama Merek">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Kategori</label>
                        <select name="kategori" id="" class="custom-select" >
                            @foreach ($datakategori as $kategori)
                                <option value="{{$kategori->id}}">{{$kategori->Nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Merek</label>
                        <select name="Merek" id="" class="custom-select" >
                            @foreach ($datamerek as $merek)
                                <option value="{{$merek->id}}">{{$merek->Nama}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Deskripsi</label>
                        <input type="text" class="form-control" name="Deskripsi" id="exampleFormControlInput1" placeholder="Deskripsi">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Harga</label>
                        <input type="number" class="form-control" name="Harga" id="exampleFormControlInput1" placeholder="Harga">
                    </div>
                    <div class="custom-file">
                        <label for="exampleFormControlInput1">Gambar</label>
                        <input type="file" class="custom-file-input" name="gambar" id="inputGroupFile02">
                        <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
            </div>
        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nama Barang</td>
                            <td>Kategori</td>
                            <td>merek</td>
                            <td>jumlah stock</td>
                            <td>harga</td>
                            <td>action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($databarang as $barang )
                        <tr>
                            <td>{{$barang->id}}</td>
                            <td>{{$barang->Nama}}</td>
                            <td>{{$barang->kategori}}</td>
                            <td>{{$barang->merk}}</td>
                            <td>{{$barang->stock}}</td>
                            <td>{{"Rp.".number_format($barang->Harga)}}</td>
                            <td>
                                <a href="{{url('/admin/Stock/'.$barang->id)}}"><button class="btn btn-primary">Stock</button></a>
                                <a href=""><button class="btn btn-warning">Edit</button></a>
                                <a href=""><button class="btn btn-danger">Delete</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

