@extends('layouts.main')

@section('title')
     Data Master Pelanggan
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Master Pelanggan</h1>
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
             <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#modaltambahdata">Tambah Data Baru</a>
             {{-- filter --}}
             <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table>
             {{-- endfilter --}}
              <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th></th>
                                                        <th>Nama</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>RT</th>
                                                        <th>keterangan</th>
                                                        <th>No. Sambung</th>
                                                        {{-- <th>Saldo</th>
                                                        <th>Tunggakan</th> --}}
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i=1 @endphp
                                                @foreach($datapelanggan as $pelanggan)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $pelanggan->kode_pelanggan}}</td>
                                                        <td>{{ $pelanggan->nama }}</td>
                                                        <td>{{ $pelanggan->alamat }}</td>
                                                        <td>{{ $pelanggan->status }}</td>
                                                        <td>{{ $pelanggan->tgl_add }}</td>
                                                        <td>{{ $pelanggan->tgl_edit }}</td>
                                                        <td>{{ $pelanggan->rt }}</td>
                                                        <td>{{ $pelanggan->keterangan }}</td>
                                                        <td>{{ $pelanggan->no_sambung }}</td>
                                                        {{-- <td>{{ $pelanggan->saldo }}</td>
                                                        <td>{{ $pelanggan->tunggakan }}</td> --}}
                                                        <td>
				<a href="/datamasterpelanggan/editpelanggan/{{ $pelanggan->id_pelanggan }}" class="btn btn-warning" role="button">Edit</a>
				
				<a href="#" class="btn btn-danger" role="button" >Hapus</a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>RT</th>
                                                        <th>keterangan</th>
                                                        <th>No. Sambung</th>
                                                        {{-- <th>Saldo</th>
                                                        <th>Tunggakan</th> --}}
                                                        <th>Aksi</th>

                                                    </tr>
                                                </tfoot>
                                            </table>
            </div>

                                                        {{-- Modal Tambah Data --}}
                                              <div class="modal fade" id="modaltambahdata">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Pelanggan</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
    	<form id="tambahpelanggan" method="post">
		{{ csrf_field() }}

    <div class="form-group">
      <input type="text" name="nama" required="required" class="form-control form-control-sm" placeholder="Nama">
    </div>
    
    <div class="form-group">
      <input type="text" name="alamat" required="required" class="form-control form-control-sm" placeholder="Alamat">
    </div>

        Status <input type="radio" name="status" value="1">
        <label for="aktif">Aktif</label>
        <input type="radio" name="status" value="0">
        <label for="tidak_aktif">Tidak Aktif</label> <br/>

    <div class="form-group">
      <input type="text" name="rt" required="required" class="form-control form-control-sm" placeholder="RT">
    </div>

    <div class="form-group">
      <select id="class" name="id_class" class="form-control select2" required>
      <option></option>
      @foreach ($dataclass as $class)
      <option value="{{$class->id_class}}">{{$class->keterangan}}</option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <input type="text" name="no_sambung" class="form-control form-control-sm" placeholder="Nomor Sambung">
    </div>

        <button class="btn btn-primary" type="submit">Tambah</button>
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
$("#tambahpelanggan").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterpelanggan/tambahpelanggan',
      data: formdata,
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        Swal.fire(
          'Sukses!',
          data.reason,
          'success'
        ).then(() => {
          location.replace("/datamasterpelanggan/index");
        });
      }
    });
  });

  $(document).ready(function() {
    $('#class').select2({
      placeholder: "Pilih Kelas"
    });
  });
</script>
  @endpush