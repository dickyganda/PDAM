@extends('layouts.main')

@section('title')
     Edit Harga
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Harga</h1>
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
              @foreach($dataharga as $harga)
    <form id="editharga" method="post">

<input type="hidden" name="id_harga" value="{{ $harga->id_harga }}" hidden>

        Status

        <input type=radio name="status" value="1" {{ $harga->status == '1' ? 'checked' : ''}}>Aktif</option>
        <input type=radio name="status" value="0" {{ $harga->status == '0' ? 'checked' : ''}}>Tidak Aktif</option>
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
$("#editharga").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterharga/updateharga',
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