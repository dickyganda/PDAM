@extends('layouts.main')

@section('title')
     Edit Pelanggan
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Pelanggan</h1>
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
              @foreach($datapelanggan as $pelanggan)
    <form id="editpelanggan" method="post">

<input type="hidden" name="id_pelanggan" value="{{ $pelanggan->id_pelanggan }}" hidden>

        Status

        @if ( $pelanggan->status_pelanggan == '1' )
        <input type="radio" name="status_pelanggan" value="1" checked>
        <label for="aktif">Aktif</label>
        <input type="radio" name="status_pelanggan" value="0">
        @else
        <input type="radio" name="status_pelanggan" value="1">
        <label for="aktif">Aktif</label>
        <input type="radio" name="status_pelanggan" value="0" checked>
        @endif
        <label for="tidakaktif">Tidak Aktif</label>
        <br />

        <button class="btn btn-primary" type="submit">Simpan</button>
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
$("#editpelanggan").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterpelanggan/updatepelanggan',
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
</script>
  @endpush