<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        table {
            width: 100%;
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table thead {
            text-align: center;
        }

        p,
        .title {
            margin: 0px;
            padding: 0px;
        }

        img {
            max-width: inherit;
            width: 50px;
            height: 50px;
        }

        #kop {
            text-align: center;
        }

        #headerkategori {
            text-align: center;
            background-color: skyblue;
        }

        #subheader {
            text-align: center;

        }

        @page {
            size: A4 portrait;
            margin: 5mm 5mm 5mm 5mm;

        }

        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }

    </style>
</head>

<body>


    {{-- <section class="top">
        <p>Dibuat pada: {{ now()->format('h:i:s d-m-Y') }}</p>
    </section> --}}


    @foreach($datatransaksi as $transaksi)

    <div id="div1">
        <table>
            <tr id="header">
                {{-- <td rowspan="1"></td> --}}
                <td>
                    <img src="{{asset('assets/img/logo.png') }}" alt="Logo">

                    {{-- <p style="text-align:center;">Jl. sumber Duduksampeyan Gresik - 61162</p> --}}
                </td>
                <td>
                    <p style="text-align:center;"><b>BADAN PENGELOLAN SARANA PENYEDIAAN AIR MINUM</b></p>
                    <p style="text-align:center;"><b>(BP-SPAMS) "TIRTA SUMARI"</b></p>
                    <p style="text-align:center;">DESA SUMARI KECAMATAN DUDUKSAMPEYAN KABPATEN GRESIK</p>
                </td>
            </tr>
        </table>

        <table class="table table-bordered" style="width:100%" id="cetaknota" border="1">
            {{-- baris 1 --}}
            <tr>
                <td colspan="8" id="headerkategori" style="text-align:center;"><b>TAGIHAN REKENING AIR BERSIH</b></td>
            </tr>

            {{-- baris 2 --}}
            <tr>
                <td colspan="2">KODE PELANGGAN</td>
                <td colspan="2">{{ $transaksi->kode_pelanggan }}</td>
                <td>BLN/THN</td>
                <td colspan="2">{{ $transaksi->tgl_scan}}</td>
            </tr>

            {{-- baris 3 --}}
            <tr>
                <td colspan="2">NAMA</td>
                <td colspan="2">{{ $transaksi->nama }}</td>
                <td>RT</td>
                <td colspan="2">{{ $transaksi->rt }}</td>
                {{-- <td>GOLONGAN</td>
                <td colspan="2">{{ $transaksi->id_class }}</td> --}}
            </tr>

            {{-- baris 4 --}}
            <tr>
                <td colspan="2">ALAMAT</td>
                <td colspan="2">{{ $transaksi->alamat }}</td>
            </tr>

            {{-- baris 5 --}}
            <tr>
                <td colspan="8" id="headerkategori" style="text-align:center; background-color:powderblue;"><b>PERINCIAN
                        PEMAKAIAN DAN TAGIHAN</b></td>
            </tr>

            {{-- baris 6 --}}
            <tr>
                <td colspan="2" id="subheader" style="text-align:center;"><b>Satuan Meter</b></td>
                <td id="subheader" style="text-align:center;" rowspan="2"><b>TARIF DASAR PER M3</b></td>
                <td id="subheader" style="text-align:center;" rowspan="2"><b>RP</b></td>
                <td>Tagihan</td>
                <td>{{ $transaksi->tagihan }}</td>
                <td colspan="2" id="subheader" style="text-align:center;"><b>Jumlah yang harus dibayar</b></td>
            </tr>

            {{-- baris 7 --}}
            <tr>
                <td>Akhir</td>
                <td>{{ $transaksi->stand_meter_bulan_ini}}</td>
                <td>Biaya Admin</td>
                <td>{{ $transaksi->biaya_admin}}</td>
                <td style="text-align:center;" rowspan="3" id="terbilang-input"><b>{{ $transaksi->saldo}}</b></td>
            </tr>

            {{-- baris 8 --}}
            <tr>
                <td>Awal</td>
                <td>{{ $transaksi->stand_meter_bulan_lalu}}</td>
                <td>{{ $class_bawah }}</td>
                <td> {{$biaya_pemakaian_bawah}} </td>
                <td>Perawatan</td>
                <td>{{ $transaksi->biaya_perawatan}}</td>
            </tr>

            {{-- baris 9 --}}
            <tr>
                <td>TOTAL M3</td>
                <td>{{ $transaksi->pemakaian}}</td>
                <td>{{ $class_atas }}</td>
                <td>{{$biaya_pemakaian_atas}}</td>
                <td>Tagihan Bulan Lalu</td>
                <td>{{ $transaksi->tunggakan}}</td>
            </tr>

            {{-- baris 10 --}}
            <tr>
                <td>Pemakaian 10m3</td>
                <td>{{ $jumlah_pemakaian_bawah }}</td>
            </tr>

            {{-- baris 11 --}}
            <tr>
                <td>Pemakaian >10m3</td>
                <td>{{ $jumlah_pemakaian_atas }}</td>
            </tr>
        </table>
        <br>
        <button id="btnPrint" class="hidden-print">Print</button>
    </div>
    @endforeach


</body>

<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });

</script>

</html>
