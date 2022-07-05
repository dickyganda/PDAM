@extends('layouts.main')

@section('title')
     Data Transaksi
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Transaksi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol>
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
             {{-- <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#myModal">Tambah Data Baru</a> --}}
             <input type="text" name="datetimes" id="datetimes" />
				<a href="#" class="btn btn-success" role="button">Hitung Saldo</a>
				<a href="#" class="btn btn-success" role="button">Cetak</a>

                                                <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th></th>
                                                        <th>Stand Meter Bulan Lalu</th>
                                                        <th>Stand Meter Bulan Ini</th>
                                                        <th>Pemakaian</th>
                                                        <th>Tagihan</th>
                                                        <th>Biaya Admin</th>
                                                        <th>Biaya Perawatan</th>
                                                        <th>Tunggakan</th>
                                                        <th>Saldo</th>
                                                        <th>Pembayaran</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                        <th>Tgl Scan</th>
                                                        <th>Otorisasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($datatransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $transaksi->kode_pelanggan }}</td>
                                                        <td>{{ $transaksi->stand_meter_bulan_lalu }}</td>
                                                        <td>{{ $transaksi->stand_meter_bulan_ini }}</td>
                                                        <td>{{ $transaksi->pemakaian = $transaksi->stand_meter_bulan_ini - $transaksi->stand_meter_bulan_lalu }}</td> 
                                                        <td>{{ $transaksi->tagihan = $transaksi->pemakaian * $transaksi->harga }}</td>
                                                        <td>{{ $transaksi->biaya_admin }}</td>
                                                        <td>{{ $transaksi->biaya_perawatan }}</td>
                                                        <td>{{ $transaksi->tunggakan }}</td>
                                                        <td>{{ $transaksi->saldo }}</td>
                                                        <td>{{ $transaksi->pembayaran }}</td>
                                                        <td>{{ $transaksi->link_image }}</td>
                                                        <td>{{ $transaksi->status }}</td>
                                                        <td>{{ $transaksi->tgl_scan }}</td>
                                                        <td>{{ $transaksi->otorisasi }}</td>
                                                        <td>
				<a href="" class="btn btn-warning" role="button">Edit</a>
				
				<a href="#" class="btn btn-danger" role="button">Hapus</a>

        <a href="/datatransaksi/report" class="btn btn-success" role="button">Cetak</a>

        <a href="/datatransaksi/reportthermal" class="btn btn-success" role="button">Cetak Thermal</a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th></th>
                                                        <th>Stand Meter Bulan Lalu</th>
                                                        <th>Stand Meter Bulan Ini</th>
                                                        <th>Pemakaian</th>
                                                        <th>Tagihan</th>
                                                        <th>Biaya Admin</th>
                                                        <th>Biaya Perawatan</th>
                                                        <th>Tunggakan</th>
                                                        <th>Saldo</th>
                                                        <th>Pembayaran</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                        <th>Tgl Scan</th>
                                                        <th>Otorisasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
            </div>

                                                        {{-- Modal Tambah Data --}}
                                              <div class="modal fade" id="modaltransaksi">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
    	<form id="tambahpelanggan" method="post">
		{{ csrf_field() }}

<div class="form-group">
      <input type="text" name="user" class="form-control form-control-sm" placeholder="User">
    </div>

        <div class="form-group">
      <input type="text" name="email" class="form-control form-control-sm" placeholder="Email">
    </div>

    <div class="form-group">
      <input type="password" name="password" class="form-control form-control-sm" placeholder="Password">
    </div>

    <div class="form-group">
      <input type="text" name="pengingat" class="form-control form-control-sm" placeholder="Pengingat">
    </div>

    <div class="form-group">
      <input type="text" name="nama" class="form-control form-control-sm" placeholder="Nama">
    </div>

    <div class="form-group">
      <input type="text" name="id_level" class="form-control form-control-sm" placeholder="Level">
    </div>

        Status <input type="radio" name="status" value="Aktif">
        <label for="aktif">Aktif</label>
        <input type="radio" name="status" value="Tidak Aktif">
        <label for="tidak_aktif">Tidak Aktif</label> <br/>

<div class="form-group">
      <input type="date" name="tgl_daftar" required="required" class="form-control form-control-sm">
    </div>

        <div class="form-group">
      <input type="date" name="tgl_password" required="required" class="form-control form-control-sm">
    </div>

        <button class="btn btn-primary" href="/datamasterpelanggan/tambahpelanggan" type="submit">Tambah</button>
	</form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
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
</script>
  @endpush