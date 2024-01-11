@extends('pages.master')
@section('mytitle', 'Info Tindakan')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Info Tindakan Medis</h3>
            </div>

            <div class="card-body">
                <div class="col-8 mb-3 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="medis" class="form-control">
                        <option value="">Select Dokter</option>
                        @foreach ($isMstrMedis as $dr)
                            <option value="{{ $dr->fm_nm_medis }}">{{ $dr->fm_nm_medis }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="tindakan" class="form-control">
                        <option value="">Tindakan</option>
                        @foreach ($isMstrTdk as $tdk)
                            <option value="{{ $tdk->id }}">{{ $tdk->nm_tindakan }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button class="btn btn-success" onclick="getInfoTdk()" id="btnProses">Proses</button>
                </div>
                <div>
                    <table id="penjualan" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Tindakan</th>
                                <th>Dokter</th>
                                <th>No.Registrasi</th>
                                <th>No.RM</th>
                                <th>Nama</th>
                                <th>Kd Transaksi</th>
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        {{-- <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <td><b><input type="text" id="grandTTL" class="form-control" style="border: none"
                                            readonly></b>
                                </td>
                                <th id="grandTTL"></th>
                            </tr>
                        </tfoot> --}}
                    </table>
                    {{-- <input type="text" class="form-control col-4" id="grandttl"> --}}
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            function getInfoTdk() {
                var date1 = $('#date1').val();
                var date2 = $('#date2').val();
                var medis = $('#medis').val();
                var tindakan = $('#tindakan').val();

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
                        url: "{{ url('getInfoTindakan') }}",
                        type: 'GET',
                        data: {
                            date1: date1,
                            date2: date2,
                            medis: medis,
                            tindakan: tindakan
                        },
                        success: function(isDataTindakan) {
                            var sumall = 0;
                            var table = $('#penjualan').DataTable();
                            var rows = table
                                .rows()
                                .remove()
                                .draw();
                            $.each(isDataTindakan, function(key, datavalue) {
                                const table = $('#penjualan').DataTable();

                                const dateString = datavalue.tgl_trs;
                                const date = new Date(dateString);
                                const day = date.getDate();
                                const month = date.getMonth() + 1;
                                const year = date.getFullYear();
                                const formattedDate = `${day}-${month}-${year}`;

                                const dataBaru = [
                                    [formattedDate, datavalue.nm_tindakan, datavalue.nm_dokter_jm,
                                        datavalue.kd_reg, datavalue.mr_pasien, datavalue.nm_pasien,
                                        datavalue.kd_trs,
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
                                            data[6]
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
