@extends('layouts.main')

@section('title')
     Data Master Harga
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Master Harga</h1>
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
             <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#modaltambahharga">Tambah Data Baru</a>
             <input type="text" name="datetimes" id="datetimes" />
<table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>ID User</th></th>
                                                        <th>ID Class</th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($dataharga as $harga)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $harga->id_user }}</td>
                                                        <td>{{ $harga->id_class }}</td>
                                                        <td>{{ $harga->harga }}</td>
                                                        <td>{{ $harga->status }}</td>
                                                        <td>{{ $harga->tgl_add }}</td>
                                                        <td>{{ $harga->tgl_edit }}</td>
                                                        <td>
				<a href="" class="btn btn-warning" role="button">Edit</a>
				
				<a href="#" class="btn btn-danger" role="button">Hapus</a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>ID User</th>
                                                        <th>ID Class</th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
            </div>

                                                        {{-- Modal Tambah Data --}}
                                              <div class="modal fade" id="modaltambahharga">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Harga</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
    	<form id="tambahharga" method="post">
		{{ csrf_field() }}

        <div class="form-group">
      <input type="text" name="harga" class="form-control form-control-sm" placeholder="Harga">
    </div>

<div class="form-group">
      <select id="user" name="id_user" class="form-control select2" required>
      <option></option>
      @foreach ($dataharga as $harga)
      <option value="{{$harga->id_user}}">{{$harga->user}}</option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <select id="class" name="id_class" class="form-control select2" required>
      <option></option>
      @foreach ($dataharga as $harga)
      <option value="{{$harga->id_class}}">{{$harga->keterangan}}</option>
      @endforeach
      </select>
    </div>

        Status <input type="radio" name="status" value="1">
        <label for="aktif">Aktif</label>
        <input type="radio" name="status" value="0">
        <label for="tidak_aktif">Tidak Aktif</label> <br/>

        <button class="btn btn-primary" href="/datamasterharga/tambahharga" type="submit">Tambah</button>
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
  $(document).ready(function() {
    $('#class').select2({
      placeholder: "Pilih Kelas"
    });
  });

  $(document).ready(function() {
    $('#user').select2({
      placeholder: "Pilih User"
    });
  });     

  $("#tambahharga").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterharga/tambahharga',
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
          location.replace("/datamasterharga/index");
        });
      }
    });
  });
</script>
  @endpush