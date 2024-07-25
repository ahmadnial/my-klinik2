@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahSupplier">Tambah</button>
                <h3 class="card-title">MSTR JENIS PEMERIKSAAN LAB</h3>
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
                            @foreach ($isview as $tz)
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
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

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
                <form action="{{ url('add-jenis-pemeriksaan') }}" onkeydown="return event.key != 'Enter';" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode</label>
                            <input type="text" class="form-control form-control-sm" name="kd_jenis_pemeriksaan" id="kd_jenis_pemeriksaan" readonly
                                value="{{$kd_jenis}}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Nama Jenis Pemeriksaan</label>
                            <input type="text" class="form-control form-control-sm" name="nm_jenis_pemeriksaan" id="nm_jenis_pemeriksaan"
                                value="" placeholder="Input Nama jenis Pemeriksaan" required>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Satuan Hasil</label>
                            <select name="satuan_hasil" id="satuan_hasil" class="form-control form-control-sm">
                                <option value="">Pilih Satuan Hasil</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Grup Periksa Sub</label>
                            <select name="grup_periksa_sub" id="grup_periksa_sub" class="form-control form-control-sm">
                                <option value="">Pilih Satuan Hasil</option>
                            </select>
                        </div>
                         <div class="form-group col-sm-6">
                            <label for="">Metode Uji</label>
                            <select name="metode_uji" id="metode_uji" class="form-control form-control-sm">
                                <option value="">Pilih Satuan Hasil</option>
                            </select>
                        </div>

                    </div>
                    <hr>
                    <h5 class="text-center">Nilai Rujukan</h5>
                    <div class="value-nilai-rujukan">
                        <table class="table table-scroll table-stripped table-bordered">
                            <thead style="background-color: rgb(205, 218, 243)">
                                <tr>
                                    <th width="">Sex</th>
                                    <th width="">Batas Atas</th>
                                    <th width="">Batas Bawah</th>
                                    <th width="">Keterangan Normal</th>
                                </tr>
                            </thead>

                            <tbody class="" id="">
                                <tr>
                                     <td>
                                        <select name="jenis_kelamin[]" id="jenis_kelamin" class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                     </td>
                                     <td>
                                         <input class="form-control form-control-sm" id="batas_atas"
                                             name="batas_atas[]" aria-placeholder="" value="" >
                                     </td>
                                     <td>
                                         <input type="text" class="form-control-sm form-control"
                                             id="batas_bawah" name="batas_bawah[]" 
                                             value="">
                                     </td>
                                      <td>
                                         <input type="text" class="form-control-sm form-control"
                                             id="ket_normal" name="ket_normal[]" 
                                             value="">
                                     </td>
                                     
                                </tr>
                                <tr>
                                     <td>
                                        <select name="jenis_kelamin[]" id="jenis_kelamin" class="form-control form-control-sm">
                                            <option value="">Pilih</option>
                                            <option value="Pria">Pria</option>
                                            <option value="Wanita">Wanita</option>
                                        </select>
                                     </td>
                                     <td>
                                         <input class="form-control form-control-sm" id="batas_atas"
                                             name="batas_atas[]" aria-placeholder="" value="" >
                                     </td>
                                     <td>
                                         <input type="text" class="form-control-sm form-control"
                                             id="batas_bawah" name="batas_bawah[]" 
                                             value="">
                                     </td>
                                      <td>
                                         <input type="text" class="form-control-sm form-control"
                                             id="ket_normal" name="ket_normal[]" 
                                             value="">
                                     </td>
                                     
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="buat" class="btn btn-success float-right"><i
                            class="fa fa-save"></i>
                        &nbsp;
                        Save</button>
                </div>
            </div>
        </form>


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
        @endsection

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#buat').on('click', function() {
                        var fm_kd_supplier = $('#fm_kd_supplier').val();
                        var fm_nm_supplier = $('#fm_nm_supplier').val();
                        var fm_email = $('#fm_email').val();
                        var fm_no_tlp = $('#fm_no_tlp').val();
                        var fm_alamat = $('#fm_alamat').val();
                        var fm_kota = $('#fm_kota').val();
                        var fm_kd_pos = $('#fm_kd_pos').val();
                        var fm_npwp = $('#fm_npwp').val();
                        if (fm_nm_supplier != "") {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ route('add-mstr-supplier') }}",
                                type: "POST",
                                data: {
                                    type: 2,
                                    fm_kd_supplier: fm_kd_supplier,
                                    fm_nm_supplier: fm_nm_supplier,
                                    fm_email: fm_email,
                                    fm_no_tlp: fm_no_tlp,
                                    fm_alamat: fm_alamat,
                                    fm_kota: fm_kota,
                                    fm_kd_pos: fm_kd_pos,
                                    fm_npwp: fm_npwp
                                },
                                cache: false,
                                success: function(dataResult) {
                                    // $('.close').click();
                                    // document.getElementById("fm_nm_kategori_produk").value = "";
                                    toastr.success('Saved!', 'Your fun', {
                                        timeOut: 2000,
                                        preventDuplicates: true,
                                        positionClass: 'toast-top-right',
                                    });
                                    return window.location.href = "{{ url('mstr-supplier') }}";
                                }
                            });
                        } else {
                            alert('Please fill all the field !');
                        }
                    });
                });
            </script>
        @endpush
