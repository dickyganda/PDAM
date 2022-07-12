<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | General Form Elements</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-4">

            <!-- Input addon -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Login</h3>
              </div>
              <div class="card-body">
              <form id="loginform">
              {{ csrf_field() }}
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" id="email" class="form-control" placeholder="Email">
                </div>
                <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                      </div>
                      <input type="password" id="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="row">
                      <!-- /.col-lg-6 -->
                    </div>

                  </div>
                  <!-- /.card-body -->
                </div>

        <button class="btn btn-primary" id="loginbutton" type="submit">Login</button>

</form>
                </div>


                  </div>
                  <!-- /.card-body -->
                </div>

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/js/demo.js') }}"></script>

<script type="text/javascript" src="{{ asset('assets/js/sweetalert2.js') }}"></script>

<!-- Page specific script -->
<script>
$(function () {
  bsCustomFileInput.init();
});

$( document ).ready(function(){
$("#loginform").submit(function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    console.log(FormData);
    formdata.append('email',$("#email").val());
    formdata.append('password',$("#password").val());
    $.ajax({
      type:'POST',
      dataType: 'json',
      url: '/dashboard/login',
      data: formdata,
      contentType: false,
      cache: false,
      processData: false,
      success:function(data){
        if(data.status == 'failed'){
          Swal.fire(
            'Gagal',
            data.reason,
            'error'
          );
        }
        else{
          window.location.href = "{{ route('dashboard')}}"
        }
      }
    });
  });
});

</script>
</body>
</html>
