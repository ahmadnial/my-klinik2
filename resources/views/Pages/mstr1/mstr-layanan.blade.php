@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahLayanan">Tambah
                    Layanan</button>
                <h3 class="card-title">Layanan</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Layanan</th>
                                <th>Layanan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isview as $tz)
                                <td id="kdlayananview">{{ $tz->fm_kd_layanan }}</td>
                                <td id="namalayananview">{{ $tz->fm_nm_layanan }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditLayanan{{ $tz->fm_kd_layanan }}">Edit</button>
                                    <button class="btn btn-xs btn-danger">Hapus</button>
                                </td>
                                <!-- The modal Create -->
                                <div class="modal fade" id="EditLayanan{{ $tz->fm_kd_layanan }}">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Layanan</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group col-sm">
                                                    <label for="">Kode Layanan</label>
                                                    <input type="text" class="form-control" name="fm_kd_layanan"
                                                        id="" readonly value="">
                                                </div>
                                                <div class="form-group col-sm">
                                                    <label for="">Nama Layanan</label>
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
                    <h4 class="modal-title">Tambah Layanan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm">
                        <label for="">Kode Layanan</label>
                        <input type="text" class="form-control" name="fm_kd_layanan" id="fm_kd_layanan" readonly
                            value="{{ $kd_layanan }}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="">Nama Layanan</label>
                        <input type="text" class="form-control" name="fm_nm_layanan" id="fm_nm_layanan"
                            placeholder="Nama Layanan">
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
                var fm_kd_layanan = $('#fm_kd_layanan').val();
                var fm_nm_layanan = $('#fm_nm_layanan').val();
                // alert(fm_nm_layanan);
                if (fm_nm_layanan != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-layanan') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fm_kd_layanan: fm_kd_layanan,
                            fm_nm_layanan: fm_nm_layanan,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('mstr-layanan') }}")
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
                url: "{{ route('view-mstr-layanan') }}",
                type: 'get',
                success: function(isview) {
                    console.log(isview);
                    var kd_layanan = isview.fm_kd_layanan;
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
