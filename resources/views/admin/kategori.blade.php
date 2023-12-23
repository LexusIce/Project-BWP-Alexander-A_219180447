@extends('tamplate.adminmaster')
@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <form action="" method="post" class="form-group">
                    @csrf
                    <label for="exampleFormControlInput1">Nama Kategori</label>
                    <input type="text" class="form-control" name="NamaKategori" id="exampleFormControlInput1" placeholder="Nama Kategori">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Nama kategori</td>
                            <td>action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datakategori as $kategori)
                            <tr>
                                <td>{{$kategori->Nama}}</td>
                                <td>
                                    <a href=""><Button class="btn btn-warning">edit</Button></a>
                                    <a href=""><button class="btn btn-danger">Hapus</button></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
