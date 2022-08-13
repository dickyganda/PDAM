@extends('layouts.main')

@section('title')
Edit Transaksi
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Transaksi</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                {{-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol> --}}
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg">


                <div class="card card-primary card-outline">
                    <div class="card-body">
                        @foreach($datatransaksi as $transaksi)
                        <form id="edittransaksi" method="post">

                            <input type="hidden" name="id" value="{{ $transaksi->id }}" hidden>

                            <div class="form-group">
                                <label>Biaya Admin</label>
                                <input type="text" name="biaya_admin" class="form-control form-control-sm"
                                    value="{{ $transaksi->biaya_admin }}">
                            </div>

                            <div class="form-group">
                                <label>Biaya Perawatan</label>
                                <input type="text" name="biaya_perawatan" class="form-control form-control-sm"
                                    value="{{ $transaksi->biaya_perawatan }}">
                            </div>

                            <div class="form-group">
                                <label>Saldo</label>
                                <input type="text" name="biaya_perawatan" class="form-control form-control-sm" readonly
                                    value="{{ $transaksi->saldo }}">
                            </div>

                            <div class="form-group">
                                <label>Sisa Bayar</label>
                                <input type="text" name="sisa_bayar" class="form-control form-control-sm"
                                    value="{{ $transaksi->sisa_bayar }}">
                            </div>

                            <div class="form-group">
                                <label>Pembayaran</label>
                                <input type="text" name="pembayaran" class="form-control form-control-sm"
                                    value="{{ $transaksi->pembayaran }}">
                            </div>

                            Status

                            <input type=radio name="status" value="1"
                                {{ $transaksi->status == '1' ? 'checked' : ''}}>Aktif</option>
                            <input type=radio name="status" value="0"
                                {{ $transaksi->status == '0' ? 'checked' : ''}}>Tidak Aktif</option>
                            <br>
                            <br>

                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            <a href="/datatransaksi/index" class="btn btn-warning btn-sm" role="button"><i
                                    class="fas fa-arrow-alt-circle-left"></i> Kembali</a>

                        </form>
                        @endforeach

                    </div><!-- /.card -->
                </div>

                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    @endsection

    @push('script')
    <script>
        $("#edittransaksi").submit(function (event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/datatransaksi/updatetransaksi',
                data: formdata,
                contentType: false,
                cache: false,
                processData: false,
                success: function (data) {
                    Swal.fire(
                        'Sukses!',
                        data.reason,
                        'success'
                    ).then(() => {
                        location.replace("/datatransaksi/index");
                    });
                }
            });
        });

    </script>
    @endpush
