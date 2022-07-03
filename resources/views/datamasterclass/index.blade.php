@extends('layouts.main')

@section('title')
     Data Master Class
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Master Class</h1>
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
             <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#modaltambahclass">Tambah Data Baru</a>
             <input type="text" name="datetimes" id="datetimes" />

                                            <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Keterangan</th></th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($dataclass as $class)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $class->keterangan }}</td>
                                                        <td>{{ $class->harga }}</td>
                                                        <td>{{ $class->status }}</td>
                                                        <td>{{ $class->tgl_add }}</td>
                                                        <td>{{ $class->tgl_edit }}</td>
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
                                                        <th>Keterangan</th>
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
                                              <div class="modal fade" id="modaltambahclass">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Class</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
    	<form id="tambahclass" method="post">
		{{ csrf_field() }}

<div class="form-group">
      <input type="text" name="keterangan" class="form-control form-control-sm" placeholder="Keterangan">
    </div>

        <div class="form-group">
      <input type="text" name="harga" class="form-control form-control-sm" placeholder="Harga">
    </div>

        Status <input type="radio" name="status" value="1">
        <label for="aktif">Aktif</label>
        <input type="radio" name="status" value="0">
        <label for="tidak_aktif">Tidak Aktif</label> <br/>

        <button class="btn btn-primary" href="/datamasterclass/tambahclass" type="submit">Tambah</button>
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
  $("#tambahclass").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterclass/tambahclass',
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
          location.replace("/datamasterclass/index");
        });
      }
    });
  });  
</script>
  @endpush