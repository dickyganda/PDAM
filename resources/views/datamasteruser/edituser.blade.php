@extends('layouts.main')

@section('title')
Edit User
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit User</h1>
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
                        @foreach($datauser as $user)
                        <form id="edituser" method="post">

                            <input type="hidden" name="id_user" value="{{ $user->id_user }}" hidden>

                            Status

                            @if ( $user->status_user == '1' )
                            <input type="radio" name="status_user" value="1" checked>
                            <label for="aktif">Aktif</label>
                            <input type="radio" name="status_user" value="0">
                            @else
                            <input type="radio" name="status_user" value="1">
                            <label for="aktif">Aktif</label>
                            <input type="radio" name="status_user" value="0" checked>
                            @endif
                            <label for="tidakaktif">Tidak Aktif</label>
                            <br />

                            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
                            <a href="/datamasteruser/index" class="btn btn-warning btn-sm" role="button"><i
                                    class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                        </form>
                        @endforeach

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
        $("#edituser").submit(function (event) {
            event.preventDefault();
            var formdata = new FormData(this);
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/datamasteruser/updateuser',
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

    </script>
    @endpush
