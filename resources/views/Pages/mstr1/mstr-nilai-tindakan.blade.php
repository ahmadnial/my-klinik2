@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahLayanan">Tambah
                    Nilai Tindakan</button>
                <h3 class="card-title"></h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Nama Tindakan</th>
                                <th>Nilai Tindakan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isnilaitindakan as $tz)
                                <td id="">{{ $tz->id_tindakan }}</td>
                                <td id="">{{ $tz->nilai_tarif }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditLayanan{{ $tz->id }}">Edit</button>
                                    <button class="btn btn-xs btn-danger">Hapus</button>
                                </td>
                                <!-- The modal Edit -->
                                <div class="modal fade" id="EditLayanan{{ $tz->id }}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Tindakan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group col-sm">
                                                    <label for="">Nama Tindakan</label>
                                                    <input type="text" class="form-control" name="nm_tindakan"
                                                        id="nm_tindakan" readonly value="{{ $tz->nm_tindakan }}">
                                                </div>
                                                <div class="form-group col-sm">
                                                    <label for="">Nilai Tindakan</label>
                                                    <input type="text" class="form-control" name="" id=""
                                                        placeholder="Nilai Tarif Tindakan" value="{{ $tz->nilai_tarif }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                {{-- <button type="" class=""></button> --}}
                                                <button type="button" id="edits" class="btn btn-success float-right"><i
                                                        class="fa fa-save"></i>
                                                    &nbsp;
                                                    Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Modal --}}
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahLayanan">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Tindakan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm">
                        <label for="">Nama Tindakan</label>
                        <select type="text" class="nm_tindakan form-control" style="width:100%;" name="id_tindakan"
                            id="id_tindakan" value="" placeholder="Nama Tindakan">
                            @foreach ($istindakan as $f)
                                <option value="">--Select--</option>
                                <option value="{{ $f->id }}">{{ $f->nm_tindakan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm">
                        <label for="">Nilai Tindakan</label>
                        <input type="number" class="form-control" name="nilai_tarif" id="nilai_tarif"
                            placeholder="Nilai Tarif Tindakan">
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="" class=""></button> --}}
                    <button type="button" id="buat" class="btn btn-success float-right"><i class="fa fa-save"></i>
                        &nbsp;
                        Save</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    <script>
        $('.nm_tindakan').select2({
            placeholder: 'Search Tindakan',
        });

        $(document).ready(function() {

            $('#buat').on('click', function() {
                var id_tindakan = $('#id_tindakan').val();
                var nilai_tarif = $('#nilai_tarif').val();
                // alert(fm_nm_layanan);
                if (id_tindakan != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-nilai-tindakan') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            id_tindakan: id_tindakan,
                            nilai_tarif: nilai_tarif,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('mstr-nilai-tindakan') }}")
                            // toastr.success('Saved');
                            // view()
                            // url = "{{ url('mstr-layanan') }}";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });

        function view() {
            $.ajax({
                url: "{{ route('view-mstr-tindakan') }}",
                type: 'get',
                success: function(isv) {
                    console.log(isv);
                    var kd_jaminan = isview.fm_kd_jaminan;
                    // $("#namalayananview").val(kd_layanan);
                }
            });
        }

        // $(document).ready(function() {
        //     $('#table1').DataTable({
        //         processing: true,
        //         serverside: true,
        //         ajax: "{{ route('view-mstr-layanan') }}",
        //         cloumns: [{
        //             data: 'fm_kd_layanan',
        //             name: 'fm_kd_layanan',

        //         }, {
        //             data: 'fm_nm_layanan',
        //             name: 'fm_nm_layanan',
        //         }]
        //     })
        // })
    </script>
@endpush
