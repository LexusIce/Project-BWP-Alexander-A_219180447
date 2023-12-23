@extends('tamplate.adminmaster')
@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <td>id nota</td>
                            <td>Grand Total</td>
                            <td>Tanggal</td>
                            <td>Status</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datahtrans as $data)
                            <tr>
                                <td>{{$data->id_nota}}</td>
                                <td>{{"Rp. ".number_format($data->Grandtotal)}}</td>
                                <td>{{$data->Tanggal}}</td>
                                @if ($data->Status == 1)
                                    <td>Lunas</td>
                                @elseif($data->Status == 2)
                                    <td>Pending</td>
                                @else
                                    <td>Transaksi Gagal</td>
                                @endif
                                <td>
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?php echo $data->id_nota?>">Detail</button>
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
@foreach ($datahtrans as $data)
<div class="modal fade" id="exampleModal<?php echo $data->id_nota?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive table-data">
                <table class='table'>
                    <thead>
                        <tr>
                            <td>Nama Barang</td>
                            <td>Harga</td>
                            <td>Jumlah</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datadtrans as $datas )
                            @if ($data->id_nota == $datas->fk_htrans)
                                <tr>
                                    <td>{{$datas->Nama_item}}</td>
                                    <td>{{'Rp. '.number_format($datas->Harga)}}</td>
                                    <td>{{$datas->qty}}</td>
                                    <td>{{"Rp. ".number_format($datas->Subtotal)}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
