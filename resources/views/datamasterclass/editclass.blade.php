@extends('layouts.main')

@section('title')
     Edit Class
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit Class</h1>
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
              @foreach($dataclass as $class)
    <form id="editclass" method="post">

<div class="form-group">
          <label>Harga</label>
          <input type="text" name="harga" required="required" class="form-control form-control-sm" value="{{ $class->harga }}">
        </div>

        Status

        <input type=radio name="status" value="1" {{ $class->status == '1' ? 'checked' : ''}}>Aktif</option>
        <input type=radio name="status" value="0" {{ $class->status == '0' ? 'checked' : ''}}>Tidak Aktif</option>
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
$("#editclass").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/datamasterclass/updateclass',
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