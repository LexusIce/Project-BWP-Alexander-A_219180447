@extends('tamplate.adminmaster')
@section('contents')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-8">
            @include('alert')
            <div class="card">
                <form action="{{url('/admin/addstock')}}" method="post">
                    @csrf
                    <input type="hidden" name="fkbarang" value="{{$id}}">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Ukuran</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Ukuran" aria-label="Ukuran" aria-describedby="basic-addon1" name="Ukuran">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Jumlah Stock</span>
                        </div>
                        <input type="number" class="form-control" placeholder="Jumlah Stock" aria-label="JumlahStock" aria-describedby="basic-addon1" name="qty">
                    </div>
                    <button type="submit" class="btn btn-primary">save</button>
                </form>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <a href="{{url('/admin/MasterBarang')}}"><button type="button" class="btn btn-dark">Back</button></a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>Ukuran</td>
                            <td>Jumlah Stock</td>
                            <td>action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datastock as $stock )
                            <tr>
                                <td>{{$stock->Ukuran}}</td>
                                <td>{{$stock->JumlahStock}}</td>
                                <td>{{$stock->JumlahStock}}</td>
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?php echo $stock->id?>">Edit</button>
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

@foreach ($datastock as $stock)
<div class="modal" tabindex="-1" role="dialog" id="exampleModal<?php echo $stock->id?>">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{url('/admin/updatestock')}}" method="post">
            @csrf
            <div class="modal-body">
                @php
                    $id = $stock->id;
                    $data = \DB::select("select * from stock where id = '$id'")
                @endphp
                @foreach ($data as $t)
                    <input type="hidden" name="id" value="{{$id}}">
                    <p>
                        Ukuran : <br>
                        <input type="text" class="form-control" name="ukuran" value="{{$t->Ukuran}}" disabled>
                        <input type="hidden" name="hukuran" value="{{$t->Ukuran}}">
                    </p>
                    <p>
                        Jumlah Stock : <br>
                        <input type="number" class="form-control" name="JumlahStock" placeholder="{{$t->JumlahStock}}">
                    </p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
