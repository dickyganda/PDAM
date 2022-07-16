@extends('layouts.main')

@section('title')
     Data Master User
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Master User</h1>
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
             <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#modaltambahuser">Tambah Data Baru</a>
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
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>User</th></th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Pengingat</th>
                                                        <th>Nama</th>
                                                        <th>ID Level</th>
                                                        <th>Status</th>
                                                        <th>Tgl Daftar</th>
                                                        <th>Tgl Perubahan Password</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($datauser as $user)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $user->user }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->password }}</td>
                                                        <td>{{ $user->pengingat }}</td>
                                                        <td>{{ $user->nama }}</td>
                                                        <td>{{ $user->id_level }}</td>
                                                        <td>{{ $user->status_user }}</td>
                                                        <td>{{ $user->tgl_daftar }}</td>
                                                        <td>{{ $user->tgl_password }}</td>
                                                        <td>
				<a href="" class="btn btn-warning" role="button">Edit</a>
				
				<a href="" class="btn btn-danger" role="button">Hapus</a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>User</th>
                                                        <th>Email</th>
                                                        <th>Password</th>
                                                        <th>Pengingat</th>
                                                        <th>Nama</th>
                                                        <th>ID Level</th>
                                                        <th>Status</th>
                                                        <th>Tgl Daftar</th>
                                                        <th>Tgl Perubahan Password</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
            </div>

                                                        {{-- Modal Tambah Data --}}
                                              <div class="modal fade" id="modaltambahuser">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data User</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
    	<form id="tambahuser" method="post">
		{{ csrf_field() }}

<div class="form-group">
      <input type="text" name="user" class="form-control form-control-sm" placeholder="User">
    </div>

        <div class="form-group">
      <input type="email" name="email" class="form-control form-control-sm" placeholder="Email">
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
      <select id="level" name="id_level" class="form-control select2" required>
      <option></option>
      @foreach ($datauser as $user)
      <option value="{{$user->id_level}}">{{$user->nama_level}}</option>
      @endforeach
      </select>
    </div>

        Status
        <input type=radio name="status_user" value="1" {{ $user->status_user == '1' ? 'checked' : ''}}>Aktif</option>
        <input type=radio name="status_user" value="0" {{ $user->status_user == '0' ? 'checked' : ''}}>Tidak Aktif</option>

        <button class="btn btn-primary" href="/datamasteruser/tambahuser" type="submit">Tambah</button>
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
var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[0] );
 
        if (
            ( min === null && max === null ) ||
            ( min === null && date <= max ) ||
            ( min <= date   && max === null ) ||
            ( min <= date   && date <= max )
        ) {
            return true;
        }
        return false;
    }
);
 
$(document).ready(function() {
    // Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'MMMM Do YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'MMMM Do YYYY'
    });
 
    // DataTables initialisation
    var table = $('#dt-basic-example').DataTable();
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });
});

$("#tambahuser").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasteruser/tambahuser',
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
          location.replace("/datamasteruser/index");
        });
      }
    });
  });

    $(document).ready(function() {
    $('#level').select2({
      placeholder: "Pilih level"
    });
  });  
</script>
  @endpush