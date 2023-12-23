@extends('tamplate.master_index')
@section('content')
    <div class="arrivals">
        <div class="container">
            {{-- <form action="" method="post">
                <input type="text" name="" id="">
            </form> --}}
            <div class="row" style="width: 100%;">
                @if (!session()->has("login"))
                    <div class="alert alert-danger alert-block">
                        <strong>Untuk melihat history transaski Pengguna harus melakukan login terlebih dahulu</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">
                    @if (!session()->has("login"))
                    <div class="alert alert-danger alert-block">
                        <strong>Untuk melihat history transaski Pengguna harus melakukan login terlebih dahulu</strong>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>id</td>
                                    <td>Grand Total</td>
                                    <td>Tanggal</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataHistory as $item)
                                    <tr>
                                        <td>{{$item->id_nota}}</td>
                                        <td>Rp. {{number_format($item->Grandtotal,0,',','.')}}</td>
                                        <td>{{date_format(date_create($item->Tanggal),'d-m-Y')}}</td>
                                        @if ($item->status==1)
                                            <td>Transaski Lunas</td>
                                        @elseif ($item->status==2)
                                            <td><button class="btn btn-primary" onclick="bayar(`{{$item->snap_token}}`)">Bayar</button></td>
                                        @else
                                            <td>Transaksi Gagal</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
				</div>
			</div>
		</div>
	</div>        
    <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{env('MIDTRANS_SERVER_KEY')}}"></script>
    <script>
        function ajaxGetToken(transactionData, callback){
          var snapToken;
          // Request get token to your server & save result to snapToken variable

          if(snapToken){
            callback(null, snapToken);
          } else {
            callback(new Error('Failed to fetch snap token'),null);
          }
        }
        function bayar(x) {
            alert(x)
            snap.pay(x, {
              onSuccess: function(result){console.log('success');console.log(result);
                $.ajax({
                    url:"{{url("/insertTrans")}}",
                    type:"POST",
                    data:{"_token":"{{csrf_token()}}",status:"lunas",snap_token:x},
                    success:function(res){
                        window.location.href="{{url("/Histori")}}";
                    }
                })
              },
              onPending: function(result){console.log('pending');console.log(result);
                $.ajax({
                    url:"{{url("/insertTrans")}}",
                    type:"POST",
                    data:{"_token":"{{csrf_token()}}",status:"pending",snap_token:x},
                    success:function(res){
                        window.location.href="{{url("/Histori")}}";
                    }
                })
              },
              onError: function(result){console.log('error');console.log(result);},
              onClose: function(){console.log('customer closed the popup without finishing the payment');}
            });
        }
    </script>
@endsection
