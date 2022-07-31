@extends('layouts.main')

@section('title')
     Data Transaksi
 @endsection

 @section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Data Transaksi</h1>
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
             {{-- <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#myModal">Tambah Data Baru</a> --}}
             {{-- filter --}}
<div class="row">
  <div class="col-sm-3">
  <select id="rt" name="id_class" class="form-control select2 form-select-sm" required>
      <option></option>
      @foreach ($datapelanggan as $pelanggan)
      <option value="{{$pelanggan->rt}}">{{$pelanggan->rt}}</option>
      @endforeach
      </select><br>
  </div>
</div>
             <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td><input type="text" id="min" name="min" value="<?php echo date('01-m-Y');?>"></td><td>-</td> 
            <td><input type="text" id="max" name="max" value="<?php echo date('d-m-Y');?>"></td>
        </tr>
        {{-- <tr>
            <td><input type="text" id="max" name="max"></td>
        </tr> --}}
    </tbody></table>

             {{-- endfilter --}}
				{{-- <a href="#" class="btn btn-success" role="button">Hitung Saldo</a> --}}
				{{-- <a href="#" class="btn btn-success" role="button">Cetak</a> --}}
{{-- <input type="button" class="hidden-print" value="Print" onclick="printpart()"/> --}}
                                                <table id="dt-basic-example" class="table table-bordered table-responsive table-hover table-striped w-100">
                                                <thead class="bg-warning-200">
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama</th>
                                                        <th>RT</th>
                                                        <th>Stand Meter Bulan Lalu</th>
                                                        <th>Stand Meter Bulan Ini</th>
                                                        <th>Pemakaian</th>
                                                        <th>Tagihan</th>
                                                        <th>Biaya Admin</th>
                                                        <th>Biaya Perawatan</th>
                                                        <th>Tunggakan</th>
                                                        <th>Saldo</th>
                                                        <th>Pembayaran</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                        <th>Tgl Scan</th>
                                                        <th>Otorisasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                    
                                                </thead>
                                                <tbody>
                                                @php $i=1 @endphp
                                                @foreach($datatransaksi as $transaksi)
                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $transaksi->kode_pelanggan }}</td>
                                                        <td>{{ $transaksi->nama }}</td>
                                                        <td>{{ $transaksi->rt }}</td>
                                                        <td>{{ $transaksi->stand_meter_bulan_lalu }}</td>
                                                        <td>{{ $transaksi->stand_meter_bulan_ini }}</td>
                                                        <td>{{ $transaksi->pemakaian = $transaksi->stand_meter_bulan_ini - $transaksi->stand_meter_bulan_lalu }}</td> 
                                                        <td>{{ $transaksi->tagihan = $transaksi->pemakaian * $transaksi->harga_class }}</td>
                                                        <td>{{ $transaksi->biaya_admin }}</td>
                                                        <td>{{ $transaksi->biaya_perawatan }}</td>
                                                        <td>{{ $transaksi->tunggakan }}</td>
                                                        <td>{{ $transaksi->saldo }}</td>
                                                        <td>{{ $transaksi->pembayaran }}</td>
                                                        <td><img src= "{{asset('storage/'.$transaksi->link_image)}}" width="100px" height="100px" > </td>
                                                        <td>{{ $transaksi->status }}</td>
                                                        <td>{{ $transaksi->tgl_scan }}</td>
                                                        <td>{{ $transaksi->otorisasi }}</td>
                                                        <td>
         <a href="#"onclick="hitungsaldo({{$transaksi->id}})" class="btn btn-danger" role="button"><i class="fas fa-calculator"></i> Hitung Saldo</a>

         {{-- <a href="#"onclick="updatetunggakan({{$transaksi->id}})" class="btn btn-success" role="button" id="update_tunggakan">Update Tunggakan</a> --}}

				<a href="/datatransaksi/edittransaksi/{{ $transaksi->id }}" class="btn btn-warning" role="button"><i class="fas fa-pen"></i> Edit</a>

        <a href="/datatransaksi/report/{{ $transaksi->id }}" class="btn btn-success" role="button"><i class="fas fa-print"></i> Cetak</a>

        <a href="/datatransaksi/reportthermal/{{ $transaksi->id }}" class="btn btn-primary" role="button"><i class="fas fa-print"></i> Cetak Thermal</a>
			</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Kode Pelanggan</th>
                                                        <th>Nama</th>
                                                        <th>RT</th>
                                                        <th>Stand Meter Bulan Lalu</th>
                                                        <th>Stand Meter Bulan Ini</th>
                                                        <th>Pemakaian</th>
                                                        <th>Tagihan</th>
                                                        <th>Biaya Admin</th>
                                                        <th>Biaya Perawatan</th>
                                                        <th>Tunggakan</th>
                                                        <th>Saldo</th>
                                                        <th>Pembayaran</th>
                                                        <th>Image</th>
                                                        <th>Status</th>
                                                        <th>Tgl Scan</th>
                                                        <th>Otorisasi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                            
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
        var date = new Date( data[14] );
 
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

    $('#rt').on('change', function(e){
      var status = $(this).val();
      $('#rt').val(status)
      console.log(status)
      //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
      table.column(3).search(status).draw();
    })
});

   function hitungsaldo(id){
     
     Swal.fire({
     title: 'Lanjutkan ?',
     text: "Data tidak dapat diubah",
     icon: 'warning',
     showCancelButton: true,
     confirmButtonColor: '#3085d6',
     cancelButtonColor: '#d33',
     confirmButtonText: 'Ya, Lanjutkan'
   }).then((result) => {
     if (result.isConfirmed) {
       $.ajax({
         type:'POST',
         dataType: 'json',
         url: '/hitungsaldo/' + id,
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

   {{-- function updatetunggakan(id){
     
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
         url: '/updatetunggakan/' + id,
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
   
const btn = document.getElementById('update_tunggakan');

btn.addEventListener('click', () => {
  // 👇️ hide button
  btn.style.display = 'none';

  // 👇️ show div

}); --}}

function printpart () {
  var printwin = window.open("");
  printwin.document.write(document.getElementById("dt-basic-example").innerHTML);
  printwin.stop();
  printwin.print();
  printwin.close();
}

$(document).ready(function() {
    $('#rt').select2({
      placeholder: "Pilih RT"
    });
  });
</script>
  @endpush