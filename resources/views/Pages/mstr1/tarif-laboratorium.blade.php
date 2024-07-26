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
                    <table id="example2" class="table table-hover table-bordered table-striped">
                        <thead class="">
                            <tr>
                                <th>Kode</th>
                                <th>Nama Jenis Pemeriksaan</th>
                                <th>Satuan Hasil</th>
                                <th>Grup PEriksa</th>
                                <th>Metode Uji</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($isData as $tz)
                                <td id="">{{ $tz->kd_jenis_pemeriksaan_lab }}</td>
                                <td id="">{{ $tz->nm_jenis_pemeriksaan_lab }}</td>
                                <td id="">{{ $tz->satuan_hasil }}</td>
                                <td id="">{{ $tz->grup_periksa_sub }}</td>
                                <td id="">{{ $tz->metode_uji }}</td>
                                <td id="">{{ $tz->user }}</td>
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"
                                        data-target="#EditSupplier{{ $tz->kd_jenis_pemeriksaan_lab }}">Edit</button>
                                    <button class="btn btn-xs btn-danger" data-toggle="modal"
                                        data-target="#DeleteSupplier{{ $tz->kd_jenis_pemeriksaan_lab }}">Hapus</button>
                                </td>
                        </tbody>
                        @endforeach --}}
                    </table>
                </div>
            </div>
        </div>


        <!-- The modal Create -->
        <div class="modal fade" id="TambahSupplier">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Jenis Pemeriksaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('add-jenis-pemeriksaan') }}" method="post"
                        onkeydown="return event.key != 'Enter';">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="">Kode Tarif</label>
                                    <input type="text" class="form-control form-control-sm" name="kd_tarif"
                                        id="kd_tarif" readonly value="">
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
                                    <input type="number" class="form-control form-control-sm" name="nm_tarif"
                                        id="nm_tarif" value="" placeholder="Input Nilai Tarif" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Keterangan</label>
                                    <textarea name="keterangan_tarif" id="keterangan_tarif" class="form-control form-control-sm"></textarea>
                                </div>
                            </div>

                            <hr>

                            <h5 class="text-center">Komponen Pemeriksaan</h5>
                            <div class="">
                                <button type="buton" class="btn btn-primary btn-xs float-right mb-2"
                                    onClick="addKomponenTrf()" data-toggle="modal" data-target="#addKomponenTarif"><i
                                        class="far fa-plus-square"></i>&nbsp;Add</button>
                            </div>
                            <div class="value-nilai-rujukan">
                                <table class="table table-scroll table-stripped table-bordered">
                                    <thead style="background-color: rgb(205, 218, 243)">
                                        <tr>
                                            <th width="">Kode Jenis</th>
                                            <th width="">Jenis Pemeriksaan</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody class="value-nilai-rujukan-body" id="">
                                        {{-- <tr>
                                    <td>
                                         <input class="form-control form-control-sm" id="batas_atas"
                                             name="batas_atas[]" aria-placeholder="" value="" >
                                     </td>
                                     <td>
                                         <input class="form-control form-control-sm" id="batas_atas"
                                             name="batas_atas[]" aria-placeholder="" value="" >
                                     </td>
                                     <td>
                                         <button class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button>
                                     </td>
                                      <td>
                                         <input type="text" class="form-control-sm form-control"
                                             id="ket_normal" name="ket_normal[]" 
                                             value="">
                                     </td>
                                </tr> --}}
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
                        <table class="table table-hover table-stripped table-bordered" id="viewKomponen" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Komponen</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody class="getListObatx" id="getListObatx">
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            {{-- <button type="" class=""></button> --}}
                            {{-- <button type="button" id="buat" class="btn btn-success float-right"><i
                                class="fa fa-save"></i>
                            &nbsp;
                            Save</button> --}}
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

            function SelectItem() {
                alert('oke');
            }
        </script>
    @endpush
@endsection
