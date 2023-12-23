@extends('tamplate.adminmaster')
@section('contents')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                @if($errors->any())
                    <h4>{{$errors->first()}}</h4>
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Nama Merek</label>
                        <input type="text" class="form-control" name="NamaMerek" id="exampleFormControlInput1" placeholder="Nama Merek">
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
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
                                <td>ID</td>
                                <td>Nama Merek</td>
                            </tr>
                        </thead>
                        @foreach ($datamerek as $merk )
                            <tbody>
                                <tr>
                                    <td>{{$merk->id}}</td>
                                    <td>{{$merk->Nama}}</td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
            </div>
        </div>
    </div>
</div>

@endsection
