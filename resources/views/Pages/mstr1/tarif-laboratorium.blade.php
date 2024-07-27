@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right btn-xs" data-toggle="modal"
                    data-target="#TambahSupplier"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
                <h3 class="card-title">MSTR TARIF LABORATORIUM</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="exm2" class="table table-hover table-bordered table-striped">
                        <thead class="">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Tarif</th>
                                <th>Rekap Cetak</th>
                                <th>Nilai Tarif</th>
                                <th>Keterangan</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isData as $tz)
                                <td id="">{{ $tz->kd_tarif }}</td>
                                <td id="">{{ $tz->nm_tarif }}</td>
                                <td id="">{{ $tz->rekap_cetak }}</td>
                                <td id="">@currency($tz->nilai_tarif)</td>
                                <td id="">{{ $tz->keterangan_tarif }}</td>
                                <td id="">{{ $tz->user }}</td>
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#EditSupplier{{ $tz->kd_jenis_pemeriksaan_lab }}">Edit</button>
                                    <button class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#DeleteSupplier{{ $tz->kd_jenis_pemeriksaan_lab }}">Hapus</button>
                                </td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


        <!-- The modal Create -->
        <div class="modal fade" id="TambahSupplier">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Tarif Laboratorium</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('add-tariflab') }}" method="post"
                        onkeydown="return event.key != 'Enter';">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Kode Tarif</label>
                                    <input type="text" class="form-control form-control-sm" name="kd_tarif"
                                        id="kd_tarif" readonly value="{{ $kd_tarif }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Nama Tarif</label>
                                    <input type="text" class="form-control form-control-sm" name="nm_tarif"
                                        id="nm_tarif" value="" placeholder="Input Nama Tarif" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Rekap Cetak</label>
                                    <select name="rekap_cetak" id="rekap_cetak" class="form-control form-control-sm">
                                        <option value="">___Pilih___</option>
                                        {{-- @foreach ($satuan as $st)
                                <option value="{{ $st->nm_satuan}}">{{ $st->nm_satuan }}</option>
                                @endforeach --}}
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Nilai Tarif</label>
                                    <input type="number" class="form-control form-control-sm" name="nilai_tarif"
                                        id="nilai_tarif" value="" placeholder="Input Nilai Tarif" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan_tarif" id="keterangan_tarif" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-center">Komponen Pemeriksaan</h5>
                            <div class="">
                                <button class="btn btn-primary btn-xs float-right mb-2"
                                    onClick="addKomponenTrf()" data-toggle="modal" data-target="#addKomponenTarif"><i
                                        class="far fa-plus-square"></i>&nbsp;Add</button>
                            </div>
                            <div class="value-nilai-rujukan">
                                <table class="table table-scroll table-stripped table-bordered">
                                    <thead style="background-color: rgb(205, 218, 243)">
                                        <tr>
                                            <th width="">Kode Jenis</th>
                                            <th width="">Jenis Pemeriksaan</th>
                                            <th>Sex</th>
                                            <th>Batas Bawah</th>
                                            <th>Batas Atas</th>
                                            <th>Nilai Normal</th>
                                            <th>Satuan Hasil</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody class="value-nilai-rujukan-body spaceKomponen" id="spaceKomponen">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="buat" class="btn btn-success float-right"><i
                                    class="fa fa-save"></i>
                                &nbsp;
                                Save</button>
                        </div>
                </div>
            </div>
        </div>
        </form>

        <div class="modal fade" id="addKomponenTarif">
            <div class="modal-dialog" role="document">
                <div class="modal-content document">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Komponen</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- <div class="row"> --}}
                        <table class="table table-hover table-stripped table-bordered" id="viewKomponen"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Komponen</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="" id="">
                            </tbody>
                        </table>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- The modal Delete -->
    {{-- <div class="modal fade" id="DeleteSupplier{{ $tz->fm_kd_supplier }}">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Konfirmasi</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    Hapus data Supplier : <b> {{ $tz->fm_nm_supplier }} </b> ?
                                </div>
                            </div>
                            <div class="modal-footer">
                                <form class="d-inline" action="{{ url('destroy-mstr-supplier', [$tz->fm_kd_supplier]) }}"
                                    method="POST">
                                    @csrf
                                    <input type="hidden" value="DELETE" name="_method">
                                    <button type="submit" id="Delete" value="Delete"
                                        class="btn btn-danger float-right">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}
    {{-- @endforeach --}}

    @push('scripts')
        <script>
            function addKomponenTrf() {
                //    console.log('oke');
                $.ajax({
                    success: function(isKomponenLab) {
                        $('#viewKomponen').DataTable({
                            processing: true,
                            serverSide: true,
                            responsive: true,
                            "bDestroy": true,
                            ajax: "{{ url('getListJenisPemeriksaan') }}",
                            columns: [{
                                    data: 'kd_jenis_pemeriksaan_lab',
                                    name: 'kd_jenis_pemeriksaan_lab'
                                },
                                {
                                    data: 'nm_jenis_pemeriksaan_lab',
                                    name: 'nm_jenis_pemeriksaan_lab'
                                },
                                {
                                    data: 'action',
                                    name: 'action'
                                },
                            ]
                        });

                    }
                })
            }

            function SelectItem(f) {
                var kd_jenis_pemeriksaan_lab = $(f).data('kdpemeriksaan');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getSelectedItem') }}/" + kd_jenis_pemeriksaan_lab,
                    type: 'GET',
                    data: {
                        kd_jenis_pemeriksaan_lab: kd_jenis_pemeriksaan_lab
                    },
                    success: function(isSelectedItem) {
                        $("#ListObatJual").empty();
                        var getValues = isSelectedItem;
                        for (var getVals = 0; getVals < getValues.length; getVals++) {
                            $("#spaceKomponen").append(`
                                        <tr>
                                            <td>
                                                <input class="form-control form-control-sm" id="kd_jenis_pemeriksaan_lab"
                                                    name="kd_jenis_pemeriksaan_lab[]" aria-placeholder="" value="${getValues[getVals].kd_jenis_pemeriksaan_lab}">
                                            </td>
                                            <td>
                                                <input class="form-control form-control-sm" id="nm_jenis_pemeriksaan_lab"
                                                    name="nm_jenis_pemeriksaan_lab[]" aria-placeholder="" value="${getValues[getVals].nm_jenis_pemeriksaan_lab}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control-sm form-control" id="jenis_kelamin"
                                                    name="jenis_kelamin[]" value="${getValues[getVals].jenis_kelamin}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control-sm form-control" id="batas_bawah"
                                                    name="batas_bawah[]" value="${getValues[getVals].batas_bawah}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control-sm form-control" id="batas_atas"
                                                    name="batas_atas[]" value="${getValues[getVals].batas_atas}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control-sm form-control"
                                                    id="ket_normal" name="ket_normal[]" value="${getValues[getVals].ket_normal}">
                                            </td>
                                             <td>
                                                <input type="text" class="form-control-sm form-control"
                                                    id="satuan_hasil" name="satuan_hasil[]" value="${getValues[getVals].satuan_hasil}">
                                            </td>
                                            <td>
                                                <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>

                        `);
                        }
                    }
                })
            }
        </script>
    @endpush
@endsection
