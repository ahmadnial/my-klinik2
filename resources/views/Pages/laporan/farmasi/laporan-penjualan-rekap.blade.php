@extends('pages.master')
@section('mytitle', 'Laporan Apotek')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-truck">&nbsp;</i>Laporan Penjualan Apotek Rekap</h3>
            </div>

            <div class="card-body">
                <div class="col-5 mb-4 input-group input-daterange">
                    <input type="date" id="date1" class="form-control">
                    <div class="input-group-addon">&nbsp; s.d&nbsp;</div>
                    <input type="date" id="date2" class="form-control">
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="user" class="form-control">
                        <option value="">Select User</option>
                        @foreach ($isUser as $iu)
                            <option value="{{ $iu->name }}">{{ $iu->name }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <select id="tipeTarif" class="form-control">
                        <option value="">Tipe Tarif</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Resep">Resep</option>
                        <option value="Nakes">Nakes</option>
                    </select>
                    <div class="input-group-addon">&nbsp;&nbsp;&nbsp;</div>
                    <button id="btnProsesRekap" class="btn btn-success mb-3">
                        <i class="fa fa-search"></i> Proses
                    </button>
                    <div class="spinLoad d-flex align-items-center ml-4">
                        {{-- <strong>Loading...</strong> --}}
                        <div class="spinLoad spinner-border text-success ms-auto" role="status" aria-hidden="true"
                            id="spinLoad">
                        </div>
                    </div>
                </div>
                <div>
                    <table id="penjualanRekap" class="table table-bordered table-striped w-100">
                        <thead>
                            <tr>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Satuan</th>
                                <th>Total Qty</th>
                                <th>Harga Jual</th>
                                <th>Total Penjualan</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">GRAND TOTAL</th>
                                <th id="grandTotalRekap">0</th>
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
            let tablePenjualanRekap;

            $(document).ready(function() {

                tablePenjualanRekap = $('#penjualanRekap').DataTable({
                    processing: true,
                    serverSide: false,
                    destroy: false,
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
                        url: "{{ route('getLaporanPenjualanRekap') }}",
                        type: 'GET',
                        data: function(d) {
                            d.date1 = $('#date1').val();
                            d.date2 = $('#date2').val();
                        },
                        dataSrc: function(json) {
                            return json;
                        }
                    },

                    columns: [{
                            data: 'kd_obat'
                        },
                        {
                            data: 'nm_obat'
                        },
                        {
                            data: 'satuan'
                        },
                        {
                            data: 'total_qty'
                        },
                        {
                            data: 'hrg_obat',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        },
                        {
                            data: 'total_penjualan',
                            render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                        }
                    ],

                    footerCallback: function(row, data) {
                        let total = 0;

                        data.forEach(function(v) {
                            total += parseFloat(v.total_penjualan || 0);
                        });

                        $('#grandTotalRekap').html(
                            'Rp ' + total.toLocaleString('id-ID')
                        );
                    }
                });

                $('#btnProsesRekap').on('click', function() {
                    tablePenjualanRekap.ajax.reload();
                });

            });

            $('.spinLoad')
                .hide() // Hide it initially
                .ajaxStart(function() {
                    $(this).show();
                })
                .ajaxStop(function() {
                    $(this).hide();
                });
        </script>
    @endpush
@endsection
