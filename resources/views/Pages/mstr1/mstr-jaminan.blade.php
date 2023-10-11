@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahLayanan">Tambah
                    Jaminan</button>
                <h3 class="card-title">Jaminan</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Jaminan</th>
                                <th>Jaminan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isjaminan as $tz)
                                <td id="kdlayananview">{{ $tz->fm_kd_jaminan }}</td>
                                <td id="namalayananview">{{ $tz->fm_nm_jaminan }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditLayanan{{ $tz->fm_kd_jaminan }}">Edit</button>
                                    <button class="btn btn-xs btn-danger">Hapus</button>
                                </td>
                                <!-- The modal Create -->
                                <div class="modal fade" id="EditLayanan{{ $tz->fm_kd_jaminan }}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Jaminan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group col-sm">
                                                    <label for="">Kode Jaminan</label>
                                                    <input type="text" class="form-control" name="fm_kd_layanan"
                                                        id="" readonly value="">
                                                </div>
                                                <div class="form-group col-sm">
                                                    <label for="">Nama Jaminan</label>
                                                    <input type="text" class="form-control" name="fm_nm_layanan"
                                                        id="" placeholder="Nama Layanan">
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
                    <h4 class="modal-title">Tambah Jaminan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm">
                        <label for="">Kode Jaminan</label>
                        <input type="text" class="form-control" name="fm_kd_jaminan" id="fm_kd_jaminan" value="">
                    </div>
                    <div class="form-group col-sm">
                        <label for="">Nama Jaminan</label>
                        <input type="text" class="form-control" name="fm_nm_jaminan" id="fm_nm_jaminan"
                            placeholder="Nama Jaminan">
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
                var fm_kd_jaminan = $('#fm_kd_jaminan').val();
                var fm_nm_jaminan = $('#fm_nm_jaminan').val();
                // alert(fm_nm_layanan);
                if (fm_nm_jaminan != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-jaminan') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fm_kd_jaminan: fm_kd_jaminan,
                            fm_nm_jaminan: fm_nm_jaminan,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('mstr-jaminan') }}")
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
                url: "{{ route('view-mstr-jaminan') }}",
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
