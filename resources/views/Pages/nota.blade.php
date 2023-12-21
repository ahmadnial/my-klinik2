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
    </style>
</head>

<body>
    <div class="container">
        <div class="header" style="margin-bottom: 30px;">
            <div class="">
                <img src="{{ asset('src/img/AMnw.jpg') }}" alt="" height="40px" width="40px">
            </div>
            <h2>ABHIPRAYA MEDIC</h2>
            <small>Susukan 1, Genjahan, Ponjong, Gunungkidul <br> Hp.085727042405
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Kasir</li>
                    <li>Tanggal</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    @foreach ($isListPenjualanHdr as $item)
                        <li>{{ $item->kd_trs }}</li>
                        <li>Apotek</li>
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
                    @foreach ($isListPenjualanHdr as $item)
                        <li>-</li>
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
    window.print();
</script>

</html>
