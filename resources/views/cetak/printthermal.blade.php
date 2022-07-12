<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <title>Receipt example</title>

        <style>
        * {
    font-size: 12px;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
}

td.description,
th.description {
    width: 75px;
    max-width: 75px;
}

td.quantity,
th.quantity {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.price,
th.price {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centered {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 155px;
    max-width: 155px;
}

img {
    max-width: inherit;
    width: inherit;
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
    @foreach($datatransaksi as $key => $transaksi)
        <div class="ticket">
            <img src="{{asset('assets/img/logo.png') }}"  alt="Logo">
            <p class="centered">BADAN PENGELOLAN SARANA PENYEDIAAN AIR MINUM MASYARAKAT <br>
            (BP-SPAMS) "TIRTA AGUNG SUMARI"
                <br>DESA SUMARI KECAMATAN DUDUKSAMPEYAN KABPATEN GRESIK
                <br>Jl. sumber Duduksampeyan Gresik - 61162</p>
            <table>
                    <tr>
                        <th class="quantity">Kode Pelanggan</th>
                        <td class="description">{{ $transaksi->kode_pelanggan}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Nama</th>
                        <td class="description">{{ $transaksi->nama}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Alamat</th>
                        <td class="description">{{ $transaksi->alamat}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">RT</th>
                        <td class="description">{{ $transaksi->rt}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Bulan / Tahun</th>
                        <td class="description">{{ $transaksi->tgl_scan}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Satuan Akhir</th>
                        <td class="description">{{ $transaksi->stand_meter_bulan_lalu}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Satuan Awal</th>
                        <td class="description">{{ $transaksi->stand_meter_bulan_ini}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Pemakaian</th>
                        <td class="description">{{ $transaksi->pemakaian}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Tagihan</th>
                        <td class="description">{{ $transaksi->tagihan}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Biaya Admin</th>
                        <td class="description">{{ $transaksi->biaya_admin}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Biaya Perawatan</th>
                        <td class="description">{{ $transaksi->biaya_perawatan}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Tunggakan</th>
                        <td class="description">{{ $transaksi->tunggakan}}</td>
                    </tr>
                    <tr>
                        <th class="quantity">Total</th>
                        <td class="description">{{ $transaksi->saldo}}</td>
                    </tr>
            </table>
            <p class="centered">Thanks for your purchase!
                <br>parzibyte.me/blog</p>
        </div>
        <button id="btnPrint" class="hidden-print">Print</button>
        @endforeach
        <script>
        const $btnPrint = document.querySelector("#btnPrint");
$btnPrint.addEventListener("click", () => {
    window.print();
});
        </script>
    </body>
</html>