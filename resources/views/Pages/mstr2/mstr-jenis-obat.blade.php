@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahJenisObat">Tambah
                    Jenis Obat</button>
                <h3 class="card-title">MSTR Jenis Obat</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Jenis Obat</th>
                                {{-- <th>Jaminan</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenbat as $tz)
                                <td>{{ $tz->fm_nm_jenis_obat }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditJenisObat{{ $tz->id }}">Edit</button>
                                    <button class="btn btn-xs btn-danger"
                                        data-toggle="modal"data-target="#Delete{{ $tz->id }}">Hapus</button>
                                </td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahJenisObat">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Jenis Obat</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group col-sm">
                        <label for="">Jenis Obat</label>
                        <input type="text" class="form-control" name="fm_nm_jenis_obat" id="fm_nm_jenis_obat"
                            placeholder="Jenis Obat">
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

    @foreach ($jenbat as $tz)
        <!-- The modal Edit -->
        <div class="modal fade" id="EditJenisObat{{ $tz->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Jenis Obat</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-sm">
                            <label for="">Jenis Obat</label>
                            <input type="text" class="form-control" name="fm_nm_jenis_obat"
                                value="{{ $tz->fm_nm_jenis_obat }}" id="">
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <button type="button" id="edits" class="btn btn-success float-right"><i class="fa fa-save"></i>
                            &nbsp;
                            Save</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modal --}}

        <!-- The modal Delete -->
        <div class="modal fade" id="Delete{{ $tz->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Konfirmasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            Yakin data : <b> {{ $tz->fm_nm_jenis_obat }} </b> akan di Hapus?
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <form class="d-inline" action="{{ url('destroy-mstr-jenis-obat', [$tz->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" value="DELETE" name="_method">
                            <button type="submit" id="Delete" value="Delete" class="btn btn-danger float-right">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $('#buat').on('click', function() {
                var fm_nm_jenis_obat = $('#fm_nm_jenis_obat').val();
                // alert(fm_nm_layanan);
                if (fm_nm_jenis_obat != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-jenis-obat') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fm_nm_jenis_obat: fm_nm_jenis_obat,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            // document.getElementById("fm_nm_layanan").value = "";
                            window.location.replace("{{ url('mstr-jenis-obat') }}")
                            toastr.success('Saved');
                            // view()
                            // url = "{{ url('mstr-layanan') }}";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });
    </script>
@endpush
