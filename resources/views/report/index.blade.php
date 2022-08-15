@extends('layouts.main')

@push('style')
<style>
#zoom {
  transition: transform .2s; /* Animation */
  margin: 0 auto;
}

#zoom:hover {
  transform: scale(20); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
}
</style>
@endpush

@section('title')
Report
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Report</h1>
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
                        {{-- <a href="" class="btn btn-success" role="button" data-toggle="modal" data-target="#myModal">Tambah Data Baru</a> --}}
                        {{-- filter --}}

                        <table border="0" cellspacing="5" cellpadding="5">
                            <tbody>
                                <tr>
                                    <td><input type="text" id="min" name="min" value="<?php echo date('01-m-Y');?>">
                                    </td>
                                    <td>-</td>
                                    <td><input type="text" id="max" name="max" value="<?php echo date('d-m-Y');?>"></td>
                                </tr>
                            </tbody>
                        </table>

                        {{-- endfilter --}}
                        <div class="row">
                            <div class="col-sm-3">
                                <select id="rt" name="id_class" class="form-control select2 form-select-sm" required>
                                    <option></option>
                                    @foreach ($datapelanggan as $pelanggan)
                                    <option value="{{$pelanggan->rt}}">{{$pelanggan->rt}}</option>
                                    @endforeach
                                </select>
                            </div> <br><br>
                            
                        </div>


                        {{-- <button onclick="fnExcelReport('dt-basic-example')" class="btn btn-success btn-sm"><i
                                class="fas fa-file-excel"></i> Excel</button> --}}
                        {{-- <a href="#"onclick="('dt-basic-example')" class="btn btn-success btn-sm" role="button"><i class="fas fa-file-pdf"></i></a> --}}
                        {{-- <a href="javascript:generatePDF()" role="button" class="btn btn-danger btn-sm"><i class="fas fa-file-pdf"></i> PDF</a> --}}
                        {{-- <button onclick="generatePDF()"><i class="fas fa-file-pdf"></i></button> --}}
                        <a href="https://wa.me/6281233914316" class="btn btn-success btn-sm" title="Whatsapp" role="button"><i
                                class="fab fa-whatsapp"></i></a>

                        <button onclick="printpreview()" class="btn btn-primary btn-sm" title="Print Preview"><i class="fas fa-print"></i>
                            Preview</button> <br><br>
                        {{-- <input type="button" class="hidden-print" value="Print" onclick="printpart()" /> --}}
                        {{-- <a href="/report/print_preview" role="button" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> Preview</a> --}}

                        <div id="cetak">

                            <table id="dt-basic-example"
                                class="table table-bordered table-responsive table-hover table-striped w-100"
                                border="1">
                                <div id="cetak">
                                    <thead class="bg-warning-200">
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Nama</th>
                                            <th>RT</th>
                                            <th>Last Month</th>
                                            <th>This Month</th>
                                            <th>Image</th>
                                            <th>Issued</th>
                                            <th>Bill</th>
                                            <th>By. Admin</th>
                                            <th>By. mainten</th>
                                            <th>Tunggakan</th>
                                            <th>Saldo</th>
                                            <th>Pay</th>
                                            <th>Piutang</th>
                                            <th>Tgl Scan</th>
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
                                            <td><img src="{{asset('storage/'.$transaksi->link_image)}}" width="10px"
                                                    height="10px" id="zoom"> </td>
                                            <td>{{ $transaksi->pemakaian = $transaksi->stand_meter_bulan_ini - $transaksi->stand_meter_bulan_lalu }}
                                            </td>
                                            <td>{{ $transaksi->tagihan = $transaksi->pemakaian * $transaksi->harga_class }}
                                            </td>
                                            <td>{{ $transaksi->biaya_admin }}</td>
                                            <td>{{ $transaksi->biaya_perawatan }}</td>
                                            <td>{{ $transaksi->tunggakan }}</td>
                                            <td>{{ $transaksi->saldo }}</td>
                                            <td>{{ $transaksi->pembayaran }}</td>
                                            <td>{{ $transaksi->sisa_bayar }}</td>
                                            <td>{{ $transaksi->tgl_scan }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Code</th>
                                            <th>Nama</th>
                                            <th>RT</th>
                                            <th>Last Month</th>
                                            <th>This Month</th>
                                            <th>Image</th>
                                            <th>Issued</th>
                                            <th>Bill</th>
                                            <th>By. Admin</th>
                                            <th>By. mainten</th>
                                            <th>Tunggakan</th>
                                            <th>Saldo</th>
                                            <th>Pay</th>
                                            <th>Piutang</th>
                                            <th>Tgl Scan</th>
                                        </tr>
                                    </tfoot>
                            </table>
                        </div>
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
                    var date = new Date(data[15]);

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

                var table = $('#dt-basic-example').DataTable({
                    dom: 'Bfrtip',
        buttons: [
            'excel', 'print',
            {
extend: 'pdfHtml5',
orientation: 'landscape',
pageSize: 'A4' },
        ],
                    initComplete: function () {
                        this.api()
                            .columns()
                            .every(function () {
                                var column = this;
                                var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex($(this)
                                            .val());

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

                $('#rt').on('change', function (e) {
                    var status = $(this).val();
                    $('#rt').val(status)
                    console.log(status)
                    //dataTable.column(6).search('\\s' + status + '\\s', true, false, true).draw();
                    table.column(3).search(status).draw();
                })

            });

            function printpart() {
                var printwin = window.open("");
                printwin.document.write(document.getElementById("cetak").innerHTML);
                printwin.stop();
                printwin.print();
                printwin.close();
            }

            function fnExcelReport() {
                var tab_text = "<table border='2px'><tr bgcolor='#87AFC6'>";
                var textRange;
                var j = 0;
                tab = document.getElementById('dt-basic-example'); // id of table

                for (j = 0; j < tab.rows.length; j++) {
                    tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
                    //tab_text=tab_text+"</tr>";
                }

                tab_text = tab_text + "</table>";
                tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, ""); //remove if u want links in your table
                tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
                tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

                var ua = window.navigator.userAgent;
                var msie = ua.indexOf("MSIE ");

                if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) // If Internet Explorer
                {
                    txtArea1.document.open("txt/html", "replace");
                    txtArea1.document.write(tab_text);
                    txtArea1.document.close();
                    txtArea1.focus();
                    sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
                } else //other browser not tested on IE 11
                    sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));

                return (sa);
            }

            $(document).ready(function () {
                $('#rt').select2({
                    placeholder: "Pilih RT"
                });
            });

            function generatePDF() {
                var doc = new jsPDF(); //create jsPDF object
                doc.fromHTML(document.getElementById("dt-basic-example"), // page element which you want to print as PDF
                    15,
                    15, {
                        'width': 170 //set width
                    },
                    function (a) {
                        doc.save("Report.pdf"); // save file name as HTML2PDF.pdf
                    });
            }

            $(document).ready(function () {
                $('#rt').select2({
                    placeholder: "Pilih RT"
                });
            });

            function printpreview() {
                var url = new URL(window.location.origin + "/report/print_preview");

                // If your expected result is "http://foo.bar/?x=1&y=2&x=42"
                url.searchParams.append('filterdatemin', $("#min").val());
                url.searchParams.append('filterdatemax', $("#max").val());
                url.searchParams.append('filter_rt', $("#rt").val());
                window.location.href = url.href;
            }

        </script>
        @endpush
