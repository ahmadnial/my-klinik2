<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 300px;
        }

        .header {
            margin: 0;
            text-align: center;
        }

        h2,
        p {
            margin: 0;
        }

        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1>div {
            text-align: left;
        }

        .flex-container-1 .right {
            text-align: right;
            width: 200px;
        }

        .flex-container-1 .left {
            width: 100px;
        }

        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container>div {
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
        }

        ul {
            display: contents;
        }

        ul li {
            display: block;
        }

        hr {
            border-style: dashed;
        }

        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        /* @page {
            size: 58mm 100mm
        }


        body.receipt .sheet {
            width: 58mm;
            height: 100mm
        }

        @media print {
            body.receipt {
                width: 58mm
            }
        } */

        /* fix for Chrome */
        body {
            /* font-family: Calibri, Helvetica, Arial, sans-serif; */
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            width: 55mm;
            height: 100%;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            left: 10px;
            -webkit-font-smoothing: antialiased;

        }

        h2 {
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body class="receipt">
    <div class="container">
        <div class="header" style="margin-bottom: 10px;">
            <div class="">
                {{-- <img src="{{ asset('src/img/AMnw.png') }}" alt="" height="60px" width="60px"> --}}
            </div>
            <h2>APOTEK AULIA</h2>
            <small>Ngawu RT03/RW01,Ngawu,Playen <br> Hp.085228935645
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Pelanggan</li>
                    <li>Alamat</li>
                    <li>Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    @foreach ($isListPenjualanHdr as $item)
                        @php
                            $nama = $item->nm_pasien ?? '-';
                            $alamat = $item->alamat ?? '-';
                        @endphp
                        <li>{{ $item->kd_trs }}</li>
                        <li> {{ $nama }} </li>
                        <li>{{ $alamat }} </li>
                        <li>{{ Auth::user()->name }}</li>
                        <li>{{ date('Y-m-d : H:i:s', strtotime($item->created_at)) }}</li>
                    @endforeach
                    {{-- <li> {{ date('Y-m-d : H:i:s', strtotime($order->created_at)) }} </li> --}}
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga/Qty</div>
            <div>Total</div>
        </div>
        @foreach ($isListPenjualan as $item)
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;">{{ $item->nm_obat }}</div>
                <div>@currency($item->hrg_obat) / {{ $item->qty }}{{ $item->satuan }} </div>
                <div>@currency($item->sub_total)</div>
            </div>
            <br>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    {{-- <li>Sub Total</li> --}}
                    <li>Diskon</li>
                    <li>Grand Total</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    {{-- <?php $sub_ttl = 0; ?>
                    @foreach ($isListPenjualan as $item)
                        <?php $sub_ttl += $item->sub_total; ?>
                    @endforeach
                    <li>@currency($sub_ttl)</li> --}}
                    <?php $sum_diskon = 0; ?>
                    @foreach ($isListPenjualan as $item)
                        <?php $sum_diskon += $item->diskon; ?>
                    @endforeach
                    <li>@currency($sum_diskon)</li>
                    @foreach ($isListPenjualanHdr as $item)
                        <li>@currency($item->total_penjualan)</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 50px;">
            <h3>Terimakasih</h3>
            {{-- <p>Silahkan berkunjung kembali</p> --}}
        </div>
    </div>
</body>
<script>
    // window.print();
</script>

</html>
