@extends('pages.master')
@section('mytitle', 'Laporan Apotek')

@section('konten')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-chart-bar"></i> Laporan Penjualan Apotek</h3>
        </div>

        <div class="card-body">
            {{-- FILTER --}}
            <div class="row align-items-end mb-3">
                <div class="col-auto">
                    <input type="date" id="date1" class="form-control form-control-sm">
                </div>

                <div class="col-auto text-center px-1">
                    <small>s.d</small>
                </div>

                <div class="col-auto">
                    <input type="date" id="date2" class="form-control form-control-sm">
                </div>

                <div class="col-auto">
                    <select id="filterUser" class="form-control form-control-sm">
                        <option value="">Semua User</option>
                        @foreach ($isUser as $u)
                            <option value="{{ $u->name }}">{{ $u->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <select id="filterTipeTarif" class="form-control form-control-sm">
                        <option value="">Semua Tarif</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Resep">Resep</option>
                        <option value="Nakes">Nakes</option>
                    </select>
                </div>

                <div class="col-auto">
                    <button id="btnProses" class="btn btn-sm btn-success">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>


            {{-- TABS --}}
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabDetail">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabRekap">Rekap Per Obat</a>
                </li>
            </ul>

            <div class="tab-content mt-3">
                {{-- ================= TAB DETAIL ================= --}}
                <div class="tab-pane fade show active" id="tabDetail">
                    <table id="tblDetail" class="table table-bordered w-100">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Kode Trs</th>
                                <th>Nama Obat</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Diskon</th>
                                <th>Tuslah</th>
                                <th>Embalase</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">TOTAL</th>
                                <th id="fDiskon"></th>
                                <th id="fTuslah"></th>
                                <th id="fEmbalase"></th>
                                <th id="fGrand"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- ================= TAB REKAP ================= --}}
                <div class="tab-pane fade" id="tabRekap">
                    <table id="rekapLaporan" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Total Qty</th>
                                <th>Omzet</th>
                                <th>HPP</th>
                                <th>Laba</th>
                                <th>Margin (%)</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">GRAND TOTAL</th>
                                <th id="sumOmzet">Rp 0</th>
                                <th id="sumHpp">Rp 0</th>
                                <th id="sumLaba">Rp 0</th>
                                <th>-</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        let tblDetail, tblRekap;

        $(document).ready(function() {

            /* ============================
             * DATATABLE DETAIL
             * ============================ */
            tblDetail = $('#tblDetail').DataTable({
                processing: true,
                serverSide: false,
                responsive: true,
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-sm btn-secondary'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-sm btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-info'
                    }
                ],
                ajax: {
                    url: "{{ route('laporan.apotek.detail') }}",
                    type: 'GET',
                    data: function(d) {
                        d.date1 = $('#date1').val();
                        d.date2 = $('#date2').val();
                        d.user = $('#filterUser').val();
                        d.tipe_tarif = $('#filterTipeTarif').val(); 
                    },
                    dataSrc: json => json
                },
                columns: [{
                        data: 'tgl_trs'
                    },
                    {
                        data: 'kd_trs'
                    },
                    {
                        data: 'nm_obat'
                    },
                    {
                        data: 'qty',
                        className: 'text-right'
                    },
                    {
                        data: 'hrg_obat',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'diskon',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'tuslah',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'embalase',
                        className: 'text-right',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'sub_total',
                        className: 'text-right font-weight-bold',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    }
                ],
                footerCallback: function(row, data) {
                    let totalDiskon = 0,
                        totalTuslah = 0,
                        totalEmbalase = 0,
                        grandTotal = 0;

                    data.forEach(v => {
                        totalDiskon += +v.diskon || 0;
                        totalTuslah += +v.tuslah || 0;
                        totalEmbalase += +v.embalase || 0;
                        grandTotal += +v.sub_total || 0;
                    });

                    $('#fDiskon').html('Rp ' + totalDiskon.toLocaleString('id-ID'));
                    $('#fTuslah').html('Rp ' + totalTuslah.toLocaleString('id-ID'));
                    $('#fEmbalase').html('Rp ' + totalEmbalase.toLocaleString('id-ID'));
                    $('#fGrand').html('<b>Rp ' + grandTotal.toLocaleString('id-ID') + '</b>');
                }
            });

            /* ============================
             * DATATABLE REKAP OBAT
             * ============================ */
            tblRekap = $('#rekapLaporan').DataTable({
                processing: true,
                serverSide: false,
                dom: 'lBfrtip',
                buttons: [{
                        extend: 'excel',
                        className: 'btn btn-sm btn-success'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-sm btn-danger'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-sm btn-info'
                    }
                ],
                ajax: {
                    url: "{{ route('laporan.apotek.rekap') }}",
                    type: 'GET',
                    data: function(d) {
                        d.date1 = $('#date1').val();
                        d.date2 = $('#date2').val();
                        d.user = $('#filterUser').val();
                        d.tipe_tarif = $('#filterTipeTarif').val();
                    },
                    dataSrc: json => json
                },
                columns: [{
                        data: 'kd_obat'
                    },
                    {
                        data: 'nm_obat'
                    },
                    {
                        data: 'total_qty',
                        className: 'text-right'
                    },
                    {
                        data: 'omzet',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'total_hpp',
                        render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                    },
                    {
                        data: 'laba_obat',
                        render: d => `<span class="text-success font-weight-bold">
                    Rp ${Number(d).toLocaleString('id-ID')}
                </span>`
                    },
                    {
                        data: 'margin_persen',
                        render: d => d + ' %'
                    }
                ],
                footerCallback: function(row, data) {
                    let totalOmzet = 0,
                        totalHpp = 0,
                        totalLaba = 0;

                    data.forEach(v => {
                        totalOmzet += +v.omzet || 0;
                        totalHpp += +v.total_hpp || 0;
                        totalLaba += +v.laba_obat || 0;
                    });

                    $('#sumOmzet').html('Rp ' + totalOmzet.toLocaleString('id-ID'));
                    $('#sumHpp').html('Rp ' + totalHpp.toLocaleString('id-ID'));
                    $('#sumLaba').html(
                        `<span class="text-success font-weight-bold">
                    Rp ${totalLaba.toLocaleString('id-ID')}
                </span>`
                    );
                }
            });

            /* ============================
             * BUTTON PROSES
             * ============================ */
            $('#btnProses').on('click', function() {

                if (!$('#date1').val() || !$('#date2').val()) {
                    alert('Tanggal harus diisi');
                    return;
                }

                tblDetail.ajax.reload(null, false);
                tblRekap.ajax.reload(null, false);
            });

        });
    </script>
@endpush
