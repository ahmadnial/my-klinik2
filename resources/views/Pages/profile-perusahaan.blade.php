@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Profile Perusahaan</h3>
            </div>

            <div class="card-body">
                <div id="" class="comtainer-fluid">
                    {{-- <div class="box-body"> --}}
                    <form action="{{ url('createProfile') }}" method="POST">
                        @csrf
                        @foreach ($profil as $item)
                            <div class="col-6">
                                <div class="form-group">
                                    <div class="form-group field-identitasklinik-aptnama required has-success">
                                        <label class="control-label col-sm-3" for="identitasklinik-aptnama">Nama</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-aptnama" class="form-control"
                                                name="nmPerusahaan" value="{{ $item->nmPerusahaan ?? '' }}"
                                                placeholder="Nama">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-aptpemilik">
                                        <label class="control-label col-sm-3"
                                            for="identitasklinik-aptpemilik">Pemilik</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-aptpemilik" class="form-control"
                                                name="pemilikPerusahaan" value="{{ $item->pemilikPerusahaan ?? '' }}"
                                                maxlength="255" placeholder="Pemilik">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-aptpenanggung">
                                        <label class="control-label col-sm-3" for="identitasklinik-aptpenanggung">Penanggung
                                            Jawab</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-aptpenanggung" class="form-control"
                                                name="pjPerusahaan" value="{{ $item->pjPerusahaan ?? '' }}"
                                                placeholder="PJ Perusahaan" maxlength="255">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>

                                    {{-- <div class="form-group field-identitasklinik-apt_kodepos">
                                <label class="control-label col-sm-3" for="identitasklinik-apt_kodepos">Kode
                                    Pos</label>
                                <div class="col-sm-9">
                                    <input type="text" id="identitasklinik-apt_kodepos" class="form-control"
                                        name="IdentitasKlinik[apt_kodepos]" value="34868" readonly=""
                                        style="background-color: transparent;">

                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group field-identitasklinik-apt_rw">
                                <label class="control-label col-sm-3" for="identitasklinik-apt_rw">RW</label>
                                <div class="col-sm-9">
                                    <input type="text" id="identitasklinik-apt_rw" class="form-control"
                                        name="IdentitasKlinik[apt_rw]" value="000">

                                    <div class="help-block"></div>
                                </div>
                            </div>
                            <div class="form-group field-identitasklinik-apt_rt">
                                <label class="control-label col-sm-3" for="identitasklinik-apt_rt">RT</label>
                                <div class="col-sm-9">
                                    <input type="text" id="identitasklinik-apt_rt" class="form-control"
                                        name="IdentitasKlinik[apt_rt]" value="000">

                                    <div class="help-block"></div>
                                </div>
                            </div> --}}
                                    <div class="form-group field-identitasklinik-aptalamat required">
                                        <label class="control-label col-sm-3" for="identitasklinik-aptalamat">Alamat</label>
                                        <div class="col-sm-9">
                                            <textarea id="identitasklinik-aptalamat" class="form-control" name="alamat" maxlength="255" rows="3"
                                                style="resize:none">{{ $item->alamat ?? '' }}</textarea>

                                            <div class="help-block"></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group field-identitasklinik-apt_type_code required">
                                        <label class="control-label col-sm-3"
                                            for="identitasklinik-apt_type_code">Tipe</label>
                                        <div class="col-sm-9">
                                            <select id="" class="form-control" name="tipePerusahaan"
                                                data-s2-options="" aria-hidden="true">
                                                <option value="">Pilih Tipe...</option>
                                                <option value="Klinik">Klinik</option>
                                                <option value="Praktek Mandiri">Praktek Mandiri</option>
                                                <option value="Apotek">Apotek</option>
                                                <option value="Klinik & Apotek">Klinik & Apotek</option>
                                            </select>
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-sipnap">
                                        <label class="control-label col-sm-3" for="identitasklinik-sipnap">NIB</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-sipnap" class="form-control"
                                                name="NIB" value="{{ $item->NIB ?? '' }}">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-sipnap">
                                        <label class="control-label col-sm-3" for="identitasklinik-sipnap">Kode
                                            Faskes</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-sipnap" class="form-control"
                                                name="kd_faskes" value="{{ $item->kd_faskes ?? '' }}">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-apttlp">
                                        <label class="control-label col-sm-3" for="identitasklinik-apttlp">Telepon</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-apttlp" class="form-control"
                                                name="noTlp" value="{{ $item->noTlp ?? '' }}" maxlength="255">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-aptemail">
                                        <label class="control-label col-sm-3" for="identitasklinik-aptemail">Email</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-aptemail" class="form-control"
                                                name="email" value="{{ $item->email ?? '' }}">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-aptwebsite">
                                        <label class="control-label col-sm-3"
                                            for="identitasklinik-aptwebsite">Website</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="" class="form-control" name="website"
                                                value="{{ $item->website ?? '' }}" maxlength="255">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group field-identitasklinik-apt_npwp">
                                        <label class="control-label col-sm-3" for="identitasklinik-apt_npwp">NPWP</label>
                                        <div class="col-sm-9">
                                            <input type="text" id="identitasklinik-apt_npwp" class="form-control"
                                                name="NPWP" value="{{ $item->NPWP ?? '' }}">

                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="">
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </section>

    @push('scripts')
        <script>
            $('#role_id').select2({
                placeholder: 'Hak Akses User',
            });

            $(document).ready(function() {

                $('#buat').on('click', function() {
                    var name = $('#name').val();
                    var email = $('#email').val();
                    var password = $('#password').val();
                    var role_id = $('#role_id').val();
                    // alert(fm_nm_layanan);
                    if (name != "" && email != '' && password != '' && role_id != '') {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: "{{ route('userCreate') }}",
                            type: "POST",
                            data: {
                                name: name,
                                email: email,
                                password: password,
                                role_id: role_id,
                            },
                            cache: false,
                            success: function(user) {
                                window.location.replace("{{ url('hak-akses') }}")
                            }
                        });
                    } else {
                        alert('Please fill all the field !');
                    }
                });
            });
        </script>
    @endpush
@endsection
