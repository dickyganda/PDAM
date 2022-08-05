@extends('layouts.main')

@section('title')
Data Master User Level
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data Master User Level</h1>
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
                        <a href="" class="btn btn-success" role="button" data-toggle="modal"
                            data-target="#myModal">Tambah Data Baru</a> <br><br>
                        <div class="row">
                            <div class="col-sm-3">
                                <select id="status_aktif" name="id_class" class="form-control select2 form-select-sm"
                                    required>
                                    <option></option>
                                    @foreach ($data_status_userlevel as $userlevel)
                                    <option value="{{$userlevel->status_aktif}}">{{$userlevel->status_aktif}}</option>
                                    @endforeach
                                </select>
                            </div><br><br>
                        </div>
                        <table id="dt-basic-example"
                            class="table table-bordered table-responsive table-hover table-striped w-100">
                            <thead class="bg-warning-200">
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Level</th>
                                    </th>
                                    <th>Status Aktif</th>
                                    <th>Akses Web</th>
                                    <th>Akses Mobile</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1 @endphp
                                @foreach($datauserlevel as $userlevel)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $userlevel->nama_level }}</td>
                                    <td>{{ $userlevel->status_aktif }}</td>
                                    <td>{{ $userlevel->akses_web }}</td>
                                    <td>{{ $userlevel->akses_mobile }}</td>
                                    <td>
                                        <a href="/datamasteruserlevel/edituserlevel/{{ $userlevel->id_level }}"
                                            class="btn btn-warning" role="button"><i class="fas fa-pen"></i> Edit</a>

                                        <a href="#" onclick="deleteuserlevel({{$userlevel->id_level}})" class="btn btn-danger" role="button"><i class="fas fa-trash"></i>
                                            Hapus</a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Level</th>
                                    <th>Status Aktif</th>
                                    <th>Akses Web</th>
                                    <th>Akses Mobile</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    {{-- Modal Tambah Data --}}
                    <div class="modal fade" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Tambah Data User</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <form id="tambahuserlevel" method="post">
                                        {{ csrf_field() }}

                                        <div class="form-group">
                                            <input type="text" name="nama_level" class="form-control form-control-sm"
                                                placeholder="Nama Level">
                                        </div>

                                        Status
                                        <input type=radio name="status_aktif" value="1"
                                            {{ $userlevel->status_aktif == '1' ? 'checked' : ''}}>Aktif</option>
                                        <input type=radio name="status_aktif" value="0"
                                            {{ $userlevel->status_aktif == '0' ? 'checked' : ''}}>Tidak Aktif</option>
                                            <br>
                                            <br>

                                        Akses Web
                                        <input type=radio name="akses_web" value="1"
                                            {{ $userlevel->akses_web == '1' ? 'checked' : ''}}>Aktif</option>
                                        <input type=radio name="akses_web" value="0"
                                            {{ $userlevel->akses_web == '0' ? 'checked' : ''}}>Tidak Aktif</option>
                                            <br>
                                            <br>

                                            Akses Mobile
                                        <input type=radio name="akses_mobile" value="1"
                                            {{ $userlevel->akses_mobile == '1' ? 'checked' : ''}}>Aktif</option>
                                        <input type=radio name="akses_mobile" value="0"
                                            {{ $userlevel->akses_mobile == '0' ? 'checked' : ''}}>Tidak Aktif</option>

                                        <button class="btn btn-primary" href="/datamasteruserlevel/tambahuserlevel"
                                            type="submit">Tambah</button>
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
                    function (settings, data, dataIndex) {
                        var min = minDate.val();
                        var max = maxDate.val();
                        var date = new Date(data[5, 6]);

                        if (
                            (min === null && max === null) ||
                            (min === null && date <= max) ||
                            (min <= date && max === null) ||
                            (min <= date && date <= max)
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

                    // DataTables initialisation
                    var table = $('#dt-basic-example').DataTable({

                    });

                    // Refilter the table
                    $('#min, #max').on('change', function () {
                        table.draw();
                    });

                    $('#status_aktif').on('change', function (e) {
                        var status = $(this).val();
                        $('#status_aktif').val(status)
                        console.log(status)
                        //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
                        table.column(2).search(status).draw();
                    })
                });

                $(document).ready(function () {
                    $('#status_aktif').select2({
                        placeholder: "Pilih Status"
                    });
                });

    $("#tambahuserlevel").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasteruserlevel/tambahuserlevel',
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
          location.replace("/datamasteruserlevel/index");
        });
      }
    });
  });

  function deleteuserlevel(id_level){
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
            url: '/datamasteruserlevel/deleteuserlevel/' + id_level,
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

            </script>
            @endpush
