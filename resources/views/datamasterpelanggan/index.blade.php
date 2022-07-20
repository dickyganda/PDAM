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
                                                        <th>Total Saldo</th>
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
                                                        <td>{{ $pelanggan->status_pelanggan }}</td>
                                                        <td>{{ $pelanggan->tgl_add_pelanggan }}</td>
                                                        <td>{{ $pelanggan->tgl_edit_pelanggan }}</td>
                                                        <td>{{ $pelanggan->rt }}</td>
                                                        <td>{{ $pelanggan->keterangan }}</td>
                                                        <td>{{ $pelanggan->no_sambung }}</td>
                                                        <td>{{ $pelanggan->total_saldo }}</td>
                            
                                                        <td>

				<a href="/datamasterpelanggan/editpelanggan/{{ $pelanggan->id_pelanggan }}" class="btn btn-warning" role="button">Edit</a>
				
				<a href="#"onclick="deletepelanggan({{$pelanggan->id_pelanggan}})" class="btn btn-danger" role="button" >Hapus</a>
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
                                                        <th>Total Saldo</th>
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

        Status
        <input type=radio name="status_pelanggan" value="1" {{ $pelanggan->status_pelanggan == '1' ? 'checked' : ''}}>Aktif</option>
        <input type=radio name="status_pelanggan" value="0" {{ $pelanggan->status_pelanggan == '0' ? 'checked' : ''}}>Tidak Aktif</option>

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
var minDate, maxDate;
 
// Custom filtering function which will search data in column four between two values
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date( data[5] );
 
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

  function deletepelanggan(id_pelanggan){
       
        Swal.fire({
        title: 'Hapus Data ?',
        text: "Anda tidak akan dapat mengembalikan ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Hapus'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            type:'GET',
            dataType: 'json',
            url: '/datamasterpelanggan/deletepelanggan/' + id_pelanggan,
            success:function(data){
              Swal.fire(
                'Sukses!',
                data.reason,
                'success'
              ).then(() => {
                location.reload();
              });
            }
          });
        }
      })
      }

  $(document).ready(function() {
    $('#class').select2({
      placeholder: "Pilih Kelas"
    });
  });
</script>
  @endpush