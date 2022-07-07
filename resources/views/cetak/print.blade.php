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

      {{-- #header{
        text-align: center;
        align: center;  --}}
      }
      img{
        max-width: inherit;
    width: inherit;
      }
    }
  </style>
</head>

<body>

  <section class="top">
    <p>Dibuat pada: {{ now()->format('h:i:s d-m-Y') }}</p>
  </section>

<div id="div1">
  <table class="table table-bordered" style="width:100%" id="cetaknota">
  <tr id="header">
   <td><img src="{{asset('assets/img/logo.png') }}" alt="Logo PDAN" id="logo"></td>
  <td colspan="7">
  <h6>BADAN PENGELOLAN SARANA PENYEDIAAN AIR MINUM MASYARAKAT</h6>
  <h4>(BP-SPAMS) "TIRTA AGUNG SUMARI"</h4>
  <p>DESA SUMARI KECAMATAN DUDUKSAMPEYAN KABPATEN GRESIK</p>
  <p>Jl. sumber Duduksampeyan Gresik - 61162</p>
  </td>
  </tr>

  <tr>
    <td colspan="8" style=text-align: center>TAGIHAN REKENING AIR</td>
  </tr>
  <tr>
    <td colspan="2">NO. PELANGGAN</td>
    <td colspan="2">isi no pelanggan</td>
    <td>BLN/THN</td>
    <td colspan="2">isi bln / thn</td>
  </tr>
  <tr>
    <td colspan="2">NAMA</td>  
    <td colspan="2">isi nama</td>
    <td>GOLONGAN</td>
    <td colspan="2">isi golongan</td>
  </tr>
  <tr>
    <td colspan="2">ALAMAT</td>  
    <td colspan="2">nama desa</td>
    <td>RT</td>
    <td colspan="2">isi RT</td>
  </tr>

  <tr>
  <td colspan="8">PERINCIAN PEMAKAIAN DAN TAGIHAN</td>
  </tr>
  <tr>
  <td colspan="2">Satuan</td>
  <td>Tarif</td>
  <td>RP</td>
  <td>Tagihan</td>
  <td>Isi tagihan</td>
  <td colspan="2">Jumlah yang harus dibayar</td>
  </tr>
  <tr>
  <td>Akhir</td>
  <td>isi satuan akhir</td>
  <td rowspan="3">isi tarif</td>
  <td rowspan="3">isi RP</td>
  <td>Biaya Admin</td>
  <td>isi Biaya Admin</td>
  <td rowspan="3">isi jumlah yang harus dibayar</td>
  </tr>

  <tr>
  <td>Awal</td>
  <td>isi awal</td>
  <td>Perawatan</td>
  <td>isi biaya perawatan</td>
  </tr>

  <tr>
  <td>Pemakaian</td>
  <td>isi pemakaian</td>
  <td>Tunggakan</td>
  <td>isi tunggakan</td>
  </tr>

  <tr>
  <td colspan="8">Terbilang : isi terbilang</td>
  </tr>
</table>
</div>
<input type="button" class="hidden-print" value="Print" onclick="printpart()"/>

</body>

<script>
function printpart () {
  var printwin = window.open("");
  printwin.document.write(document.getElementById("div1").innerHTML);
  printwin.stop();
  printwin.print();
  printwin.close();
}
</script>  
</html>