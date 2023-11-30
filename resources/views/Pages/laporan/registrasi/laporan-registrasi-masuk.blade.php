@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>Info Registrasi Masuk</h3>
            </div>

            <div class="card-body">
                <div class="col-4 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataRegMasuk()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="exm2" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>no RM</th>
                                <th>Nama</th>
                                <th>J/K</th>
                                <th>Alamat</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Session Poli</th>
                                <th>Jaminan</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                {{-- <td><b><input type="text" id="grandTTL" class="form-control" style="border: none"
                                            readonly></b>
                                </td> --}}
                                <th id="grandTTL"></th>
                            </tr>
                        </tfoot>
                    </table>
                    {{-- <input type="text" class="form-control col-4" id="grandttl"> --}}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function getDataRegMasuk() {
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();

                if (date1 == '') {
                    toastr.info('Pilih Range Tanggal', 'Info!', {
                        timeOut: 2000,
                        preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                } else {
                    // $('#result').empty();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getLapRegMasuk') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2
                        },
                        success: function(isDataRegMasuk) {
                            var sumall = 0;
                            var table = $('#exm2').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isDataRegMasuk, function(key, datavalue) {
                                const table = $('#exm2').DataTable();
                                // var total_pen = datavalue.total_penjualan;
                                // var ttlPenjualan = total_pen.toLocaleString('id-ID', {
                                //     style: 'currency',
                                //     currency: 'IDR'
                                // });
                                const dataBaru = [
                                    [datavalue.fr_mr, datavalue.fr_nama, datavalue.fr_jenis_kelamin,
                                        datavalue.fr_alamat, datavalue.fr_layanan, datavalue.fr_dokter,
                                        datavalue.fr_session_poli,
                                        datavalue.fr_jaminan
                                    ],
                                ]

                                function injectDataBaru() {
                                    for (const data of dataBaru) {
                                        table.row.add([
                                            data[0],
                                            data[1],
                                            data[2],
                                            data[3],
                                            data[4],
                                            data[5],
                                            data[6],
                                            data[7],
                                        ]).draw(false)
                                    }
                                }

                                injectDataBaru()

                                var ttlInt = parseFloat(datavalue.total_penjualan);
                                sumall += ttlInt;

                                var number = sumall;
                                var formattedNumber = number.toLocaleString('id-ID', {
                                    style: 'currency',
                                    currency: 'IDR'
                                });

                                document.getElementById("grandTTL").innerHTML = formattedNumber;

                                toastr.success('Data Load Complete!', 'Complete!', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                                $('#date1').val('');
                                $('#date2').val('');
                            })
                        }
                    })
                }

                // drawCallback: function() {
                // var sum = $('#penjualan').DataTable().column(3).data().sum();
                // $('#grandttl').html(sum);
                // }
            }


            // var someTableDT = $("#penjualan").on("draw.dt", function() {
            //     $(this).find(".dataTables_empty").parents('tbody').empty();
            // }).DataTable
        </script>
    @endpush
@endsection
