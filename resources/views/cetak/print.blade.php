<!DOCTYPE html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <style>
    table {
      width: 100%;
      text-align: left;
    }
    table, th, td {
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
    section.top {
      margin-bottom: 20px;

      img{
        max-width: inherit;
    width: inherit;
      }
    }
    #header{
      text-align: center;
      line-height: 0.5cm;
      
    }
    #headerkategori{
      text-align: center;
      background-color: skyblue;
    }
    #subheader{
      text-align: center;
      
    }
  </style>
</head>

<body>


  <section class="top">
    <p>Dibuat pada: {{ now()->format('h:i:s d-m-Y') }}</p>
  </section>

@foreach($datatransaksi as $transaksi)

<div id="div1">
  <table class="table table-bordered" style="width:100%" id="cetaknota" border="1">
  <tr id="header">
   {{-- <td><img src="{{asset('assets/img/logo.png') }}"  alt="Logo"></td> --}}
  <td colspan="7">
  <p>BADAN PENGELOLAN SARANA PENYEDIAAN AIR MINUM MASYARAKAT</p>
  <h4>(BP-SPAMS) "TIRTA AGUNG SUMARI"</h4>
  <p>DESA SUMARI KECAMATAN DUDUKSAMPEYAN KABPATEN GRESIK</p>
  <p>Jl. sumber Duduksampeyan Gresik - 61162</p>
  </td>
  </tr>

  <tr>
    <td colspan="8" id="headerkategori"><b>TAGIHAN REKENING AIR</b></td>
  </tr>
  <tr>
    <td colspan="2">NO. PELANGGAN</td>
    <td colspan="2">{{ $transaksi->kode_pelanggan }}</td>
    <td>BLN/THN</td>
    <td colspan="2">{{ $transaksi->tgl_add}}</td>
  </tr>
  <tr>
    <td colspan="2">NAMA</td>  
    <td colspan="2">{{ $transaksi->nama }}</td>
    <td>GOLONGAN</td>
    <td colspan="2">{{ $transaksi->id_class }}</td>
  </tr>
  <tr>
    <td colspan="2">ALAMAT</td>  
    <td colspan="2">{{ $transaksi->alamat }}</td>
    <td>RT</td>
    <td colspan="2">{{ $transaksi->rt }}</td>
  </tr>

  <tr>
  <td colspan="8" id="headerkategori"><b>PERINCIAN PEMAKAIAN DAN TAGIHAN</b></td>
  </tr>
  <tr>
  <td colspan="2" id="subheader">Satuan</td>
  <td id="subheader">Tarif</td>
  <td id="subheader">RP</td>
  <td>Tagihan</td>
  <td>{{ $transaksi->tagihan }}</td>
  <td colspan="2" id="subheader">Jumlah yang harus dibayar</td>
  </tr>
  <tr>
  <td>Akhir</td>
  <td>{{ $transaksi->stand_meter_bulan_ini}}</td>
  <td rowspan="3">{{ $transaksi->harga}}</td>
  <td rowspan="3">{{ $transaksi->tagihan}}</td>
  <td>Biaya Admin</td>
  <td>{{ $transaksi->biaya_admin}}</td>
  <td rowspan="3" id="terbilang-input">{{ $transaksi->saldo}}</td>
  </tr>

  <tr>
  <td>Awal</td>
  <td>{{ $transaksi->stand_meter_bulan_lalu}}</td>
  <td>Perawatan</td>
  <td>{{ $transaksi->biaya_perawatan}}</td>
  </tr>

  <tr>
  <td>Pemakaian</td>
  <td>{{ $transaksi->pemakaian}}</td>
  <td>Tunggakan</td>
  <td>{{ $transaksi->tunggakan}}</td>
  </tr>

  <tr>
  <td colspan="8" id="terbilang-output">Terbilang : </td>
  </tr>
</table>
</div>
<input type="button" class="hidden-print" value="Print" onclick="printpart()"/>
@endforeach


</body>

<script>
function printpart () {
  var printwin = window.open("");
  printwin.document.write(document.getElementById("div1").innerHTML);
  printwin.stop();
  printwin.print();
  printwin.close();
}

{{-- terbilang --}}
function inputTerbilang() {
      //membuat inputan otomatis jadi mata uang
      $('.mata-uang').mask('0.000.000.000', {reverse: true});

      //mengambil data uang yang akan dirubah jadi terbilang
       var input = document.getElementById("terbilang-input").value.replace(/\./g, "");

       //menampilkan hasil dari terbilang
       document.getElementById("terbilang-output").value = terbilang(input).replace(/  +/g, ' ');
    }
</script>  
</html>