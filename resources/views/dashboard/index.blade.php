 @extends('layouts.main')

 @section('title')
     Dashboard
 @endsection

 @push('style')
     <style>

     </style>
 @endpush

 @section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
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
  <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $jumlah_pelanggan }}</h3>

                <p>Jumlah Pelanggan</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3> {{ $total_saldo_tunggakan }}</h3>

                <p>Total Tunggakan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            {{-- <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> --}}
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            {{-- <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> --}}
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Chart Pemakaian
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#chart_pemakaian_rt" data-toggle="tab">Chart Pemakaian RT</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#chart_pemakaian_kelas" data-toggle="tab">Chart Pemakaian Kelas</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="chart_pemakaian_rt"
                       style="position: relative;">
                      <canvas id="chart_pemakaian_rt_canvas" height="400" style="height: 400px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="chart_pemakaian_kelas" style="position: relative;">
                    <canvas id="chart_pemakaian_kelas_canvas" height="400" style="height: 400px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DIRECT CHAT -->
            
            <!--/.direct-chat -->

            <!-- TO DO List -->
            
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">

            <!-- Map card -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-table"></i>
                  Daftar Tunggakan Per RT
                </h3>
                <div class="card-tools">
                  
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="chart_pemakaian_rt"
                       style="position: relative;">
                      <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>RT</th>
                                                        <th>Total Saldo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php $i=1 @endphp
                                                {{-- @foreach($total_saldo_rt as $saldo_rt)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $saldo_rt->rt}}</td> --}}
                                                        {{-- <td>{{ $saldo_rt->total_saldo_rt }}</td> --}}
                                                    {{-- </tr>
                                                    @endforeach --}}
                                                </tbody>
                                            </table>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- solid sales graph -->
            
            <!-- /.card -->

            <!-- Calendar -->

            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
  <!-- /.content -->
     
 @endsection

 @push('script')
 <script>
const ctx = document.getElementById('chart_pemakaian_rt_canvas');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?php echo json_encode($data_pelanggan); ?>,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

const ctx_2 = document.getElementById('chart_pemakaian_kelas_canvas');
const myChart_2 = new Chart(ctx_2, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($data_class); ?>,
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
 </script>
     
 @endpush
