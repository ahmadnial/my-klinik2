@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahLayanan">Tambah
                    Tarif</button>
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
                            @foreach ($istindakan as $tz)
                                <td id="kdlayananview">{{ $tz->nm_tindakan }}</td>
                                <td id="namalayananview">{{ $tz->tarif_tindakan }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditLayanan{{ $tz->id }}">Edit</button>
                                    <button class="btn btn-xs btn-danger">Hapus</button>
                                </td>
                                <!-- The modal Create -->
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
                                                        id="" readonly value="{{ $tz->nm_tindakan }}">
                                                </div>
                                                <div class="form-group col-sm">
                                                    <label for="">Nilai Tindakan</label>
                                                    <input type="text" class="form-control" name="tarif_tindakan"
                                                        id="" placeholder="Nilai Tarif Tindakan"
                                                        value="{{ $tz->tarif_tindakan }}">
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
                        <input type="text" class="form-control" name="nm_tindakan" id="nm_tindakan" value=""
                            placeholder="Nama Tindakan">
                    </div>
                    <div class="form-group col-sm">
                        <label for="">Nilai Tindakan</label>
                        <input type="text" class="form-control" name="tarif_tindakan" id="tarif_tindakan"
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
        $(document).ready(function() {

            $('#buat').on('click', function() {
                var nm_tindakan = $('#nm_tindakan').val();
                var tarif_tindakan = $('#tarif_tindakan').val();
                // alert(fm_nm_layanan);
                if (nm_tindakan != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-tindakan') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            nm_tindakan: nm_tindakan,
                            // tarif_tindakan: tarif_tindakan,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('mstr-tindakan') }}")
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
