@extends('pages.master')
@section('mytitle', 'Pricelist Obat')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header bg-nial">
                <h3 class="card-title"><i class="fa fa-list">&nbsp;</i>Pricelist</h3>
            </div>

            <div class="card-body">
                <div class="col-2 mb-3 input-group">
                    <select name="tipe_tarif" id="tipe_tarif" class="tipe_tarif form-control" onchange="getTipeTarif()">
                        <option value=""></option>
                        <option value="Reguler">Reguler</option>
                        <option value="Resep">Resep</option>
                        <option value="Nakes">Nakes</option>
                    </select>
                    {{-- <div class="input-group-addon">&nbsp;&nbsp;</div> --}}
                    {{-- <button class="btn btn-success" onclick="getDataPenjualan()" id="btnProses">Proses</button> --}}
                </div>
                <div>
                    <table id="penjualan" class="penjualan table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Nama Obat</th>
                                <th>Harga Jual</th>
                                <th>Satuan</th>
                                {{-- <th>Harga Jual <i id="HrgJualView"></i></th> --}}
                                {{-- <th>Isi</th> --}}
                            </tr>
                        </thead>
                        <tbody id="result">

                        </tbody>
                        {{-- <tfoot align="">
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th id="grandTTL"></th>
                            </tr>
                        </tfoot> --}}
                    </table>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            $('#tipe_tarif').select2({
                placeholder: 'Select Tipe Tarif',
            });

            function getTipeTarif() {
                var tes = $('#tipe_tarif').val();

                if (tes == 'Reguler') {
                    toastr.info('Harga Reguler!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#result').val('');
                    $.ajax({
                        success: function(isObatReguler) {
                            $('#penjualan').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('pricelistHrgReguler') }}",
                                columns: [{
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    // {
                                    //     data: 'fm_hrg_jual_non_resep',
                                    //     name: 'fm_hrg_jual_non_resep'
                                    // },
                                    {
                                        data: 'HrgJualGlobal',
                                        name: 'HrgJualGlobal',
                                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rp ')
                                    },
                                    {
                                        data: 'fm_satuan_pembelian',
                                        name: 'fm_satuan_pembelian'
                                    },
                                    // {
                                    //     data: 'fm_isi_satuan_pembelian',
                                    //     name: 'fm_isi_satuan_pembelian'
                                    // },
                                ]
                            });
                        }
                    })

                } else if (tes == 'Resep') {
                    $("#getListObatx").empty();
                    toastr.info('Harga Resep!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#result').val('');
                    $.ajax({
                        success: function(isObatResep) {
                            $('#penjualan').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('pricelistHrgResep') }}",
                                columns: [{
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    // {
                                    //     data: 'fm_hrg_jual_resep',
                                    //     name: 'fm_hrg_jual_resep'
                                    // },
                                    {
                                        data: 'HrgJualGlobalResep',
                                        name: 'HrgJualGlobalResep',
                                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rp ')
                                    },
                                    {
                                        data: 'fm_satuan_pembelian',
                                        name: 'fm_satuan_pembelian'
                                    },
                                    // {
                                    //     data: 'fm_isi_satuan_pembelian',
                                    //     name: 'fm_isi_satuan_pembelian'
                                    // },
                                ]
                            });
                        }
                    })
                } else {
                    toastr.info('Harga Nakes!', {
                        timeOut: 600,
                        // preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#result').val('');
                    $.ajax({
                        success: function(isObatNakes) {
                            $('#penjualan').DataTable({
                                processing: true,
                                serverSide: true,
                                responsive: true,
                                "bDestroy": true,
                                ajax: "{{ url('pricelistHrgNakes') }}",
                                columns: [{
                                        data: 'fm_nm_obat',
                                        name: 'fm_nm_obat'
                                    },
                                    // {
                                    //     data: 'fm_hrg_jual_nakes',
                                    //     name: 'fm_hrg_jual_nakes'
                                    // },
                                    {
                                        data: 'HrgJualGlobalNakes',
                                        name: 'HrgJualGlobalNakes',
                                        render: $.fn.dataTable.render.number(',', '.', 0, 'Rp ')

                                    },
                                    {
                                        data: 'fm_satuan_pembelian',
                                        name: 'fm_satuan_pembelian'
                                    },
                                    // {
                                    //     data: 'fm_isi_satuan_pembelian',
                                    //     name: 'fm_isi_satuan_pembelian'
                                    // },
                                ]
                            });
                        }
                    })
                }
            };
        </script>
    @endpush
@endsection
