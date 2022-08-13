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
             <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal" data-target="#modaltambahharga"><i class="fas fa-plus-circle"></i></a>
             <br><br>
             {{-- filter --}}
             <div class="row">
  <div class="col-sm-3">
  <select id="status_harga" name="id_class" class="form-control select2 form-select-sm" required>
      <option></option>
      <option value="1">Aktif</option>
      <option value="0">Tidak Aktif</option>
      </select><br>
  </div><br><br>
</div>
             {{-- endfilter --}}
<table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>User</th></th>
                                                        <th>Class</th>
                                                        <th>Harga</th>
                                                        <th>Status</th>
                                                        <th>Tgl Add</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($dataharga as $harga)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $harga->nama }}</td>
                                                        <td>{{ $harga->keterangan }}</td>
                                                        <td>{{ $harga->harga }}</td>
                                                        @if($harga->status_harga == '1')
                                                          <td> Aktif </td>
                                                          @else
                                                          <td> Tidak Aktif </td>
                                                          @endif
                                                        {{-- <td>{{ $harga->status_harga }}</td> --}}
                                                        <td>{{ date('d-m-Y', strtotime($harga->tgl_add_harga )) }}</td>
                                                        {{-- <td>
				<a href="/datamasterharga/editharga/{{ $harga->id_harga }}" class="btn btn-warning" role="button"><i class="fas fa-pen"></i> Edit</a>
				
				<a href="#"onclick="deleteharga({{$harga->id_harga}})" class="btn btn-danger" role="button"><i class="fas fa-trash"></i> Hapus</a>
			</td> --}}
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
      <select id="user" name="id_user" class="form-control form-control-sm select2" required>
      <option></option>
      @foreach ($data_user as $harga)
      <option value="{{$harga->id_user}}">{{$harga->user}}</option>
      @endforeach
      </select>
    </div>

    <div class="form-group">
      <select id="class" name="id_class" class="form-control select2" required>
      <option></option>
      @foreach ($data_keterangan_class as $harga)
      <option value="{{$harga->id_class}}">{{$harga->keterangan}}</option>
      @endforeach
      </select>
    </div>

        Status
        <input type=radio name="status_harga" value="1" {{ $harga->status_harga == '1' ? 'checked' : ''}}>Aktif</option>
        <input type=radio name="status_harga" value="0" {{ $harga->status_harga == '0' ? 'checked' : ''}}>Tidak Aktif</option>
<br><br>
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

$(document).ready(function () {
// Create date inputs
    minDate = new DateTime($('#min'), {
        format: 'DD-MM-YYYY'
    });
    maxDate = new DateTime($('#max'), {
        format: 'DD-MM-YYYY'
    });

    var table = $('#dt-basic-example').DataTable({
      dom: 'Bfrtip',
        buttons: [
            'excel',
        ],
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());
 
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });
 
                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },
    });

    // Refilter the table
    $('#min, #max').on('change', function () {
        table.draw();
    });

    $('#status_harga').on('change', function(e){
      var status = $(this).val();
      $('#status_harga').val(status)
      console.log(status)
      //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
      table.column(4).search(status).draw();
    })
});

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

  function deleteharga(id_harga){
       
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
            url: '/datamasterharga/deleteharga/' + id_harga,
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
    $('#status_harga').select2({
      placeholder: "Pilih Status"
    });
  });
</script>
  @endpush