@extends('layouts.main')

@section('title')
     Data Master Pelanggan
 @endsection

@push('styles')
    <style>
    </style>
@endpush

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Master Pelanggan</h1>
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
             <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahdata"><i class="fas fa-plus-circle"></i></a><br><br>
             {{-- filter --}}
             <div class="row">
  <div class="col-sm-3">
  <select id="status_pelanggan" name="id_class" class="form-control select2 form-select-sm" required>
      <option></option>
      <option value="1">Aktif</option>
      <option value="0">Tidak Aktif</option>
      </select><br>
  </div>
  <br><br>
</div>
             {{-- endfilter --}}
              <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No.</th>
                                                        {{-- <th>ID</th> --}}
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>RT</th>
                                                        {{-- <th>keterangan</th> --}}
                                                        <th>Aksi</th>

                                                    </tr>
                                                </thead>
                                                <tbody height="10px">
                                                    @php $i=1 @endphp
                                                @foreach($datapelanggan as $pelanggan)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        {{-- <td>{{ $pelanggan->id_pelanggan}}</td> --}}
                                                        <td>{{ $pelanggan->kode_pelanggan}}</td>
                                                        <td>{{ $pelanggan->nama }}</td>
                                                        <td>{{ $pelanggan->alamat }}</td>
                                                        @if($pelanggan->status_pelanggan == '1')
                                                          <td> Aktif </td>
                                                          @else
                                                          <td> Tidak Aktif </td>
                                                          @endif
                                                        <td>{{ date('d-m-Y', strtotime($pelanggan->tgl_add_pelanggan )) }}</td>
                                                        <td>{{ ($pelanggan->tgl_edit_pelanggan ? date('d-m-Y', strtotime($pelanggan->tgl_edit_pelanggan)) : '') }}</td>
                                                        <td>{{ $pelanggan->rt }}</td>
                                                        {{-- <td>{{ $pelanggan->keterangan }}</td> --}}
                                                        <td>

				<a href="/datamasterpelanggan/editpelanggan/{{ $pelanggan->id_pelanggan }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>
			
				<a href="#"onclick="deletepelanggan({{$pelanggan->id_pelanggan}})" title="Hapus" class="btn btn-danger btn-xs" role="button" ><i class="fas fa-trash"></i></a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        {{-- <th>ID</th> --}}
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama</th>
                                                        <th>Alamat</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        <th>Tgl Edit</th>
                                                        <th>RT</th>
                                                        {{-- <th>keterangan</th> --}}
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

</td>
    <div class="form-group">
      <select id="rt" name="rt" class="form-control form-control-sm select2" style="width:100%;" required>
      <option></option>
      @foreach ($data_pelanggan as $pelanggan)
      <option value="{{$pelanggan->rt}}">{{$pelanggan->rt}}</option>
      @endforeach
      </select>
    </div>
   
    {{-- <div class="form-group">
      <select id="class" name="id_class" class="form-control form-control-sm select2" style="width:100%;" required>
      <option></option>
      @foreach ($dataclass as $class)
      <option value="{{$class->id_class}}">{{$class->keterangan}}</option>
      @endforeach
      </select>
    </div> --}}

    {{-- <div class="form-group">
      <input type="text" name="no_sambung" class="form-control form-control-sm" placeholder="Nomor Sambung">
    </div> --}}

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
        var date = new Date( data[5,6] );
 
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
        format: 'DD-MM-YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'DD-MM-YYYY'
    });
 
    // DataTables initialisation
    var table = $('#dt-basic-example').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'excel',
        ],
    });
 
    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });

    $('#status_pelanggan').on('change', function(e){
      var status = $(this).val();
      $('#status_pelanggan').val(status)
      if(status == '1'){
        status_pelanggan = 'Aktif'
        console.log(status_pelanggan)
      }else{
        status_pelanggan = 'Tidak Aktif'
        console.log(status_pelanggan)
      }
      
      console.log(status)
      //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
      table.column(4).search("^"+status_pelanggan+"$",true,false).draw();
    })
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
    $('#rt').select2({
      placeholder: "Pilih RT"
      
    });
  });

  function hitungtotalsaldo(id_pelanggan){
     
     Swal.fire({
     title: 'Are you sure?',
     text: "You won't be able to revert this!",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
     if (result.isConfirmed) {
       $.ajax({
         type:'POST',
         dataType: 'json',
         url: '/hitungtotalsaldo/' + id_pelanggan,
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
    $('#status_pelanggan').select2({
      placeholder: "Pilih Status"
    });
  });
</script>
  @endpush