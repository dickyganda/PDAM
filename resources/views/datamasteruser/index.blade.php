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
                        <a href="" class="btn btn-success btn-xs" title="Tambah Data Baru" role="button" data-toggle="modal"
                            data-target="#modaltambahuser"><i class="fas fa-plus-circle"></i></a> <br><br>
                        {{-- filter --}}
                        <div class="row">
                            <div class="col-sm-3">
                                <select id="status_user" name="id_class" class="form-control select2 form-select-sm"
                                    required>
                                    <option></option>
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select><br>
                            </div> <br><br>
                        </div>
                        {{-- endfilter --}}
                        <table id="dt-basic-example"
                            class="table table-bordered table-responsive table-hover table-striped w-100">
                            <thead class="bg-warning-200">
                                <tr>
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Level</th>
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
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->nama_level }}</td>
                                    @if($user->status_user == '1')
                                        <td> Aktif </td>
                                    @else
                                        <td> Tidak Aktif </td>
                                    @endif
                                    <td>{{ date('d-m-Y', strtotime($user->tgl_daftar )) }}</td>
                                    <td>{{ ($user->tgl_password ? date('d-m-Y', strtotime($user->tgl_password)) : '') }}</td>
                                    <td>
                            <a href="/datamasteruser/edituser/{{ $user->id_user }}" title="Edit" class="btn btn-warning btn-xs" role="button"><i class="fas fa-pen"></i></a>


                            <a href="#"onclick="deleteuser({{$user->id_user}})" title="Hapus" class="btn btn-danger btn-xs" role="button" ><i class="fas fa-trash"></i></a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>Level</th>
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
                                            <input type="text" name="user" class="form-control form-control-sm"
                                                placeholder="User">
                                        </div>

                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-sm"
                                                placeholder="Email">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-sm"
                                                placeholder="Password">
                                        </div>

                                        {{-- <div class="form-group">
                                            <input type="text" name="pengingat" class="form-control form-control-sm"
                                                placeholder="Pengingat">
                                        </div> --}}

                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-sm"
                                                placeholder="Nama">
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
                                        <input type=radio name="status_user" value="1"
                                            {{ $user->status_user == '1' ? 'checked' : ''}}>Aktif</option>
                                        <input type=radio name="status_user" value="0"
                                            {{ $user->status_user == '0' ? 'checked' : ''}}>Tidak Aktif</option>

                                            <br>

                                        <button class="btn btn-primary" href="/datamasteruser/tambahuser"
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
                        var date = new Date(data[8]);

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
                        format: 'MMMM Do YYYY'
                    });
                    maxDate = new DateTime($('#max'), {
                        format: 'MMMM Do YYYY'
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
                                    var select = $(
                                            '<select><option value=""></option></select>')
                                        .appendTo($(column.footer()).empty())
                                        .on('change', function () {
                                            var val = $.fn.dataTable.util.escapeRegex($(
                                                this).val());

                                            column.search(val ? '^' + val + '$' : '', true,
                                                false).draw();
                                        });

                                    column
                                        .data()
                                        .unique()
                                        .sort()
                                        .each(function (d, j) {
                                            select.append('<option value="' + d + '">' + d +
                                                '</option>');
                                        });
                                });
                        },
                    });

                    // Refilter the table
                    $('#min, #max').on('change', function () {
                        table.draw();
                    });

                    $('#status_user').on('change', function (e) {
                        var status = $(this).val();
                        $('#status_user').val(status)
                        if(status == '1'){
        status_user = 'Aktif'
        console.log(status_user)
      }else{
        status_user = 'Tidak Aktif'
        console.log(status_user)
      }
                        console.log(status)
                        //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
                        table.column(5).search("^"+status_user+"$",true,false).draw();
                    })
                });

                $("#tambahuser").submit(function (event) {
                    event.preventDefault();
                    var formdata = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '/datamasteruser/tambahuser',
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
                                location.replace("/datamasteruser/index");
                            });
                        }
                    });
                });

                $(document).ready(function () {
                    $('#level').select2({
                        placeholder: "Pilih level"
                    });
                });

                $(document).ready(function () {
                    $('#status_user').select2({
                        placeholder: "Pilih Status"
                    });
                });

        function deleteuser(id_user){
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
            url: '/datamasteruser/deleteuser/' + id_user,
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
