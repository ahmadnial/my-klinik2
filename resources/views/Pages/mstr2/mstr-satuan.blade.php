@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahSatuan">Tambah Satuan</button>
                <h3 class="card-title">MSTR SATUAN</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example2" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Satuan</th>
                                {{-- <th></th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($satuan as $tz)
                                {{-- <td id="">{{ $tz->fm_kd_jaminan }}</td> --}}
                                <td id="">{{ $tz->fm_nm_satuan }}</td>
                                <td><button class="btn btn-xs btn-success"
                                        data-toggle="modal"data-target="#EditSatuan{{ $tz->id }}">Edit</button>
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
    <div class="modal fade" id="TambahSatuan">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Satuan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <div class="form-group col-sm">
                        <label for="">Kode </label>
                        <input type="text" class="form-control" name="fm_kd_jenis_obat" id="fm_kd_jenis_obat"
                            value="">
                    </div> --}}
                    <div class="form-group col-sm">
                        <label for="">Satuan</label>
                        <input type="text" class="form-control" name="fm_nm_satuan" id="fm_nm_satuan"
                            placeholder="Masukan Satuan">
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


    @foreach ($satuan as $tz)
        <!-- The modal Create -->
        <div class="modal fade" id="EditSatuan{{ $tz->id }}">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Satuan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-sm">
                            <label for="">Nama Satuan</label>
                            <input type="text" class="form-control" name="fm_nm_satuan" id="fm_nm_satuan"
                                value="{{ $tz->fm_nm_satuan }}">
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
                            Yakin data : <b> {{ $tz->fm_nm_satuan }} </b> akan di Hapus?
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="" class=""></button> --}}
                        <form class="d-inline" action="{{ url('destroy-mstr-satuan', [$tz->id]) }}" method="POST">
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
                var fm_nm_satuan = $('#fm_nm_satuan').val();
                // alert(fm_nm_layanan);
                if (fm_nm_satuan != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('add-mstr-satuan') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fm_nm_satuan: fm_nm_satuan,
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
                            return window.location.href = "{{ url('mstr-satuan') }}";
                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });
    </script>
@endpush
