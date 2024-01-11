@extends('pages.master')
@section('mytitle', 'Laporan Registrasi Klinik')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Info Registrasi Masuk</h3>
            </div>

            <div class="card-body">
                <div class="col-8 mb-3 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="medis" class="form-control">
                        <option value="">Select Dokter</option>
                        @foreach ($isMstrMedis as $md)
                            <option value="{{ $md->fm_nm_medis }}">{{ $md->fm_nm_medis }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="session" class="form-control">
                        <option value="">Session Poli</option>
                        <option value="Pagi">Pagi</option>
                        <option value="Sore">Sore</option>
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getDataRegMasuk()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
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
                                {{-- <th id="grandTTL"></th> --}}
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
                var medis = $('#medis').val();
                var session = $('#session').val();

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
                            date2: date2,
                            medis: medis,
                            session: session
                        },
                        success: function(isDataRegMasuk) {
                            var sumall = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isDataRegMasuk, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();

                                const dateString = datavalue.fr_tgl_reg;
                                const date = new Date(dateString);
                                const day = date.getDate();
                                const month = date.getMonth() + 1;
                                const year = date.getFullYear();
                                const formattedDate = `${day}-${month}-${year}`;

                                const dataBaru = [
                                    [formattedDate, datavalue.fr_mr, datavalue.fr_nama, datavalue
                                        .fr_jenis_kelamin,
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
                                            data[8]
                                        ]).draw(false)
                                    }
                                }

                                injectDataBaru();

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
