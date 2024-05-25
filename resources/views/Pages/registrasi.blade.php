@extends('pages.master')
@php
    function hitung_umur($tanggal_lahir)
    {
        $birthDate = new DateTime($tanggal_lahir);
        $today = new DateTime('today');
        if ($birthDate > $today) {
            exit('0 tahun 0 bulan 0 hari');
        }
        $y = $today->diff($birthDate)->y;
        $m = $today->diff($birthDate)->m;
        $d = $today->diff($birthDate)->d;
        return $y . ' tahun ' . $m . ' bulan ' . $d . ' hari';
    }

    // echo hitung_umur('1980-12-01');

@endphp
@section('mytitle', 'Registrasi')
@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registrasi Pasien</h3>
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPasien">Registrasi
                    Pasien</button>
            </div>

            <div class="card-body">
                <div class="button"></div>
                <div id="result" class="">
                    <table id="example1" class="table table-hover">
                        <thead class="">
                            <tr>
                                <th>Kode Registrasi</th>
                                <th>No.MR</th>
                                <th>Nama Pasien</th>
                                <th>Layanan</th>
                                <th>Dokter</th>
                                <th>Umur</th>
                                <th>Kunjungan</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody id="tb">
                            @foreach ($isviewreg as $item)
                                <tr>
                                    <td>{{ $item->fr_kd_reg }}</td>
                                    <td>{{ $item->fr_mr }}</td>
                                    <td>{{ $item->fr_nama }}</td>
                                    <td>{{ $item->fr_layanan }}</td>
                                    <td>{{ $item->fr_dokter }}</td>
                                    <td>
                                        @php
                                            echo hitung_umur($item->fr_tgl_lahir);
                                        @endphp
                                    </td>
                                    <td>
                                        {{-- @if ($item->fs_tgl_kunjungan_terakhir != '')
                                            <span class="badge badge-primary">Pasien Lama</span>
                                        @else
                                            <span class="badge badge-warning text-white">Pasien Baru</span>
                                        @endif --}}
                                    </td>
                                    <td>
                                        <button class="btn btn-xs btn-success"
                                            data-toggle="modal"data-target="#Edit{{ $item->fr_kd_reg }}">Edit</button>
                                        <button class="btn btn-xs btn-danger" onclick="voidReg(this)"
                                            data-kodereg="{{ $item->fr_kd_reg }}"
                                            data-namereg="{{ $item->fr_nama }}">Void</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahPasien">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title">Registrasi Pasien</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Kode Registrasi</label>
                            <input type="text" class="form-control" name="fr_kd_reg" id="fr_kd_reg" readonly
                                value="">
                        </div>
                        <input type="hidden" id="fr_nama" name="fr_nama">
                        <div class="form-group col-sm-6">
                            <label for="">Tanggal Registrasi</label>
                            <input type="date" class="form-control" name="fr_tgl_reg" id="fr_tgl_reg"
                                value="{{ $dateNow }}">
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Nama / No.RM Pasien</label>
                            <select class="form-control-pasien" id="fr_mr" style="width: 100%;" name="fr_mr"
                                onchange="getData()"></select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="fr_tgl_lahir" id="fr_tgl_lahir"
                                placeholder="Tanggal Lahir Pasien" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jenis Kelamin</label>
                            <select name="fr_jenis_kelamin" id="fr_jenis_kelamin" class="form-control" readonly>
                                <option value=""></option>
                                <option value="Laki-laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <hr>
                        <hr> <br>
                        <div class="form-group col-sm-6">
                            <label for="">Layanan</label>
                            <select name="fr_layanan" id="fr_layanan" class="fr_layanan form-control" required>
                                <option value="">--Select--</option>
                                @foreach ($layanan as $lay)
                                    <option value="{{ $lay->fm_nm_layanan }}">{{ $lay->fm_nm_layanan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Dokter</label>
                            <select name="fr_dokter" id="fr_dokter" class="fr_dokter form-control" required>

                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Jaminan</label>
                            <select name="fr_jaminan" id="fr_jaminan" class="form-control" required>
                                <option value="">--Select--</option>
                                @foreach ($jaminan as $jam)
                                    <option value="{{ $jam->fm_nm_jaminan }}">{{ $jam->fm_nm_jaminan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Session Poli</label>
                            <select name="fr_session_poli" id="fr_session_poli" class="form-control" required>
                                <option value="">--Select--</option>
                                <option value="Pagi">Pagi</option>
                                <option value="Sore">Sore</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Kunjungan Terakhir</label>
                            <input type="text" class="form-control" style="background-color:#edfafa; border:none"
                                id="kunjungan_terakhir" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group col-sm-12">
                        <label for="">Keluhan Utama</label>
                        <textarea type="text" class="form-control" name="keluhan_utama" id="keluhan_utama" required></textarea>
                    </div>
                    {{-- VITAL SIGN --}}
                    {{-- <div id="collapseVitalSign" class="bg-light border collapse show" aria-labelledby="headerVitalSign"
                        data-parent="#btnVitalSign" style="">
                        <div class="row py-2" id="inputMonitoringMC">
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Body Weight</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadBW" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyBW" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessBW"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_BW" name="ttv_BW" data-satuan="kg"
                                            data-monitorname="Body Weight" class="form-control form-control-sm vital-sign"
                                            min="0" value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">kg</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Body Height</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadBH" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyBH" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessBH"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_BH" name="ttv_BH" data-satuan="cm"
                                            data-monitorname="Body Height" class="form-control form-control-sm vital-sign"
                                            min="0" value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">cm</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Blood Pressure Sistole</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadBP" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyBP" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessBP"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_BPs" name="ttv_BPs" data-satuan="mmHg"
                                            data-monitorname="Blood Pressure Sistole"
                                            class="form-control form-control-sm vital-sign" min="0"
                                            value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">mmHg</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Blood Pressure Diastole</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadBPd" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyBPd" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessBPd"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_BPd" name="ttv_BPd" data-satuan="mmHg"
                                            data-monitorname="Blood Pressure Diastole"
                                            class="form-control form-control-sm vital-sign" min="0"
                                            value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">mmHg</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Body Temperatur</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadBT" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyBT" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessBT"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_BT" name="ttv_BT" data-satuan="°C"
                                            data-monitorname="Body Temperatur"
                                            class="form-control form-control-sm vital-sign" min="0"
                                            value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">°C</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Heart Rate</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadHR" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyHR" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessHR"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_HR" name="ttv_HR" data-satuan="x/mnt"
                                            data-monitorname="Heart Rate" class="form-control form-control-sm vital-sign"
                                            min="0" value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">x/mnt</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Respiratory Rate</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadRR" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptyRR" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessRR"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_RR" name="ttv_RR" data-satuan="x/mnt"
                                            data-monitorname="Respiratory Rate"
                                            class="form-control form-control-sm vital-sign" min="0"
                                            value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">x/mnt</span>
                                    </div>

                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">Skala Nyeri NRS</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadSN" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptySN" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessSN"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_SN" name="ttv_SN" data-satuan=""
                                            data-monitorname="Skala Nyeri NRS"
                                            class="form-control form-control-sm vital-sign" min="0" max="10"
                                            value="">
                                        <span class="input-group-text" style="width:7em; text-align:center"></span>
                                    </div>
                                    <div class="invalid-feedback" id="invFeedbackSkalaNyeri">maksimal
                                        skala 10 !</div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                <i class="mb-1">SpO2</i>
                                <div class="input-group input-group-sm mb-3">
                                    <div class="invalid-feedback" id="feedbackLoadSP" style="display: none;">load
                                        restricted, data &gt; 2 jam yang
                                        lalu !
                                    </div>
                                    <div class="invalid-feedback" id="feedbackLoadEmptySP" style="display: none;">data
                                        not found !</div>
                                    <div class="valid-feedback text-info" id="feedbackLoadSuccessSP"
                                        style="display: none;">load success</div>
                                    <div class="input-group-append input-group-sm">
                                        <input type="number" id="ttv_SPO2" name="ttv_SPO2" data-satuan="%"
                                            data-monitorname="SpO2" class="form-control form-control-sm vital-sign"
                                            min="0" value="">
                                        <span class="input-group-text" style="width:7em; text-align:center">%</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- END VITAL SIGN --}}


                    <div class="form-group col-sm-12 mt-2">
                        <label for="">Alergi</label>
                        <input type="text" class="form-control" name="fr_alergi" id="fr_alergi"
                            placeholder="Alergi Pasien" readonly>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Alamat</label>
                        <textarea type="date" class="form-control" name="fr_alamat" id="fr_alamat" readonly></textarea>
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="">Nomor Telephone</label>
                        <input type="text" class="form-control" name="fr_no_hp" id="fr_no_hp"
                            placeholder="Nomor Telephone/WA Pasien">
                    </div>
                </div>
                <input type="hidden" name="fr_user" id="fr_user" value="{{ Auth::user()->name }}">
                <div class="modal-footer">
                    {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                    <button type="submit" id="create" class="btn btn-success float-rights"><i
                            class="fa fa-save"></i>
                        &nbsp;
                        Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- The modal Edit -->
    @foreach ($isviewreg as $e)
        <div class="modal fade" id="Edit{{ $e->fr_kd_reg }}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Registrasi Pasien</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="">Kode Registrasi</label>
                                <input type="text" class="form-control" name="fr_kd_reg" id="fr_kd_reg_e" readonly
                                    value="{{ $e->fr_kd_reg }}">
                            </div>
                            <input type="hidden" id="fr_nama" name="fr_nama">
                            {{-- <div class="form-group col-sm-6">
                                <label for="">Nama Pasien/No. MR</label>
                                <select class="form-control-pasien" id="fr_mr" style="width: 100%;" name="fr_mr"
                                    onchange="getData()"></select>
                            </div> --}}
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Registrasi</label>
                                <input type="date" class="form-control" name="fr_tgl_reg" id="fr_tgl_reg_e"
                                    value="{{ $e->fr_tgl_reg }}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Nama Pasien/No. MR</label>
                                <input type="text" class="form-control" name="fr_mr" id="fr_mr"
                                    value="{{ $e->fr_nama . '-' . $e->fr_mr }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="fr_tgl_lahir" id="fr_tgl_lahir"
                                    value="{{ $e->fr_tgl_lahir }}" readonly>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="fr_jenis_kelamin" id="fr_jenis_kelamin"
                                    value="{{ $e->fr_jenis_kelamin }}" readonly>
                            </div>
                            <hr>
                            <hr> <br>
                            <div class="form-group col-sm-6">
                                <label for="">Layanan</label>
                                <select name="fr_layanan" id="fr_layanan_e" class="fr_layanan form-control">
                                    <option value="{{ $e->fr_layanan }}">{{ $e->fr_layanan }}</option>
                                    @foreach ($layanan as $lay)
                                        <option value="{{ $lay->fm_nm_layanan }}">{{ $lay->fm_nm_layanan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Dokter</label>
                                <select name="fr_dokter" id="fr_dokter_e" class="fr_dokter form-control">
                                    <option value="{{ $e->fr_dokter }}">{{ $e->fr_dokter }}</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Jaminan</label>
                                <select name="fr_jaminan" id="fr_jaminan_e" class="form-control">
                                    <option value="{{ $e->fr_jaminan }}">{{ $e->fr_jaminan }}</option>
                                    @foreach ($jaminan as $jam)
                                        <option value="{{ $jam->fm_nm_jaminan }}">{{ $jam->fm_nm_jaminan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="">Session Poli</label>
                                <select name="fr_session_poli" id="fr_session_poli_e" class="form-control">
                                    <option value="{{ $e->fr_session_poli }}">{{ $e->fr_session_poli }}</option>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Sore">Sore</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="form-group col-sm-12">
                            <label for="">Berat Badan</label>
                            <input type="number" class="form-control" name="fr_bb" id="fr_bb_e"
                                value="{{ $e->fr_bb }}">
                        </div> --}}
                        <div class="form-group col-sm-12">
                            <label for="">Keluhan Utama</label>
                            <textarea type="text" class="form-control" name="keluhan_utama" id="keluhan_utama_e">{{ $e->keluhan_utama }}</textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="">Alergi</label>
                            <input type="text" class="form-control" name="fr_alergi" id="fr_alergi"
                                placeholder="Alergi Pasien" value="{{ $e->fr_alergi }}" readonly>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="">Alamat</label>
                            <textarea type="date" class="form-control" name="fr_alamat" id="fr_alamat" readonly>{{ $e->fr_alamat }}</textarea>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="">Nomor Telephone</label>
                            <input type="text" class="form-control" name="fr_no_hp" id="fr_no_hp"
                                placeholder="Nomor Telephone/WA Pasien" value="{{ $e->fr_no_hp }}" readonly>
                        </div>
                        <div class="float-left">
                            <i class="text-danger float-left">Last Save by {{ $e->fr_user }}</i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="" data-dismiss="modal"></button> --}}
                        <button type="button" id="editdatareg" onclick="editReg()"
                            class="btn btn-success float-rights"><i class="fa fa-save"></i> &nbsp;
                            Update</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="voidReg" role="dialog" aria-labelledby="modalLabelLarge" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 class="modal-title" id="modalLabelLarge">Konfirmasi Void Registrasi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    {{-- <form action="{{ url('') }}" method="POST">
                        @csrf --}}
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" style="border: none" id="getRegVoid"
                                name="getRegVoid" readonly>
                            <span>Void Registrasi:</span>
                            <input type="text" class="form-control" style="border: none" id="showValueName" readonly>
                        </div>
                        <div class="modal-footer">
                            {{-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button> --}}
                            <button type="submit" onclick="executeVoidReg()" class="btn btn-danger"><i
                                    class="fa fa-trash"></i> &nbsp;
                                Void</button>
                        </div>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        // Ajax Search RM untuk Registrasi
        var path = "{{ route('registrasiSearch') }}";

        $('#fr_mr').select2({
            placeholder: 'Nama / Nomor RM Pasien',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 150,
                processResults: function(isdata) {
                    return {
                        results: $.map(isdata, function(item) {
                            return {
                                // text: item.fs_mr,
                                text: item.fs_mr + ' - ' + item.fs_nama + ' - ' + item.fs_alamat,
                                id: item.fs_mr,
                                alamat: item.fs_alamat,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Call Hasil Search MR
        function getData() {
            var fs_mr = $('#fr_mr').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getDasos') }}/" + fs_mr,
                type: 'GET',
                data: {
                    'fs_mr': fs_mr
                },
                success: function(isdata2) {
                    // var json = isdata2;
                    $.each(isdata2, function(key, datavalue) {
                        $('#fr_nama').val(datavalue.fs_nama);
                        $('#fr_alamat').val(datavalue.fs_alamat);
                        $('#fr_no_hp').val(datavalue.fs_no_hp);
                        $('#fr_tgl_lahir').val(datavalue.fs_tgl_lahir);
                        $('#fr_jenis_kelamin').val(datavalue.fs_jenis_kelamin);
                        $('#fr_alergi').val(datavalue.fs_alergi);
                        $('#kunjungan_terakhir').val(datavalue.fs_tgl_kunjungan_terakhir);
                    })
                }
            })
        };

        // Dependent Select Layanan Medis
        $(document).ready(function() {
            $('.fr_layanan').on('change', function() {
                var id_layanan = $(this).val();
                // console.log(id_layanan);
                if (id_layanan) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getLayananMedis') }}/" + id_layanan,
                        type: 'get',
                        data: {
                            'fm_layanan': id_layanan
                        },
                        dataType: 'json',
                        success: function(islayananMedis) {
                            // console.log(islayananMedis);
                            $('.fr_dokter').empty();
                            $('.fr_dokter').append('<option value="">--Select--</option>');
                            $.each(islayananMedis, function(key, value) {
                                $('.fr_dokter').append('<option value="' + value
                                    .fm_nm_medis +
                                    '">' + value.fm_nm_medis +
                                    '</option>');
                            })
                        }
                    });
                }
            });

        });

        // View Registrasi
        // $(document).ready(function() {
        //     viewRegistrasi()
        // });

        // function viewRegistrasi() {
        //     $.get("{{ url('registrasiView') }}", {}, function(isviewreg, status) {
        //         // $.each(isviewreg, function(key, datavalue) {
        //         var container = document.getElementById("result");
        //         isviewreg.forEach(function(count) {
        //             // console.log(count);
        //             let tableBody = document.getElementById("tb");
        //             tableBody.innerHTML += '<tr><td>' + count.fr_kd_reg +
        //                 '</td><td>' +
        //                 count.fr_mr + '</td><td>' +
        //                 count.fr_nama + '</td><td>' +
        //                 count.fr_layanan + '</td></tr>';
        //         })
        //         // container.innerHTML = '</table></div>'
        //         // })
        //     });
        // }

        // Create Registrasi
        $(document).ready(function() {

            $('#create').on('click', function() {
                var fr_kd_reg = $('#fr_kd_reg').val();
                var fr_mr = $('#fr_mr').val();
                var fr_nama = $('#fr_nama').val();
                var fr_tgl_lahir = $('#fr_tgl_lahir').val();
                var fr_tgl_reg = $('#fr_tgl_reg').val();
                var fr_jenis_kelamin = $('#fr_jenis_kelamin').val();
                var fr_alamat = $('#fr_alamat').val();
                var fr_no_hp = $('#fr_no_hp').val();
                var fr_layanan = $('#fr_layanan').val();
                var fr_dokter = $('#fr_dokter').val();
                var fr_jaminan = $('#fr_jaminan').val();
                var fr_session_poli = $('#fr_session_poli').val();
                var fr_bb = $('#fr_bb').val();
                var fr_alergi = $('#fr_alergi').val();
                var fr_user = $('#fr_user').val();
                var keluhan_utama = $('#keluhan_utama').val();
                var ttv_BW = $('#ttv_BW').val();
                var ttv_BH = $('#ttv_BH').val();
                var ttv_BPs = $('#ttv_BPs').val();
                var ttv_BPd = $('#ttv_BPd').val();
                var ttv_BT = $('#ttv_BT').val();
                var ttv_HR = $('#ttv_HR').val();
                var ttv_RR = $('#ttv_RR').val();
                var ttv_SN = $('#ttv_SN').val();
                var ttv_SPO2 = $('#ttv_SPO2').val();
                // alert(fm_nm_layanan);
                if (fr_mr != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('create-registrasi') }}",
                        type: "POST",
                        data: {
                            type: 2,
                            fr_kd_reg: fr_kd_reg,
                            fr_mr: fr_mr,
                            fr_nama: fr_nama,
                            fr_tgl_lahir: fr_tgl_lahir,
                            fr_tgl_reg: fr_tgl_reg,
                            fr_jenis_kelamin: fr_jenis_kelamin,
                            fr_alamat: fr_alamat,
                            fr_no_hp: fr_no_hp,
                            fr_layanan: fr_layanan,
                            fr_dokter: fr_dokter,
                            fr_jaminan: fr_jaminan,
                            fr_session_poli: fr_session_poli,
                            fr_bb: fr_bb,
                            fr_alergi: fr_alergi,
                            fr_user: fr_user,
                            keluhan_utama: keluhan_utama,
                            ttv_BW: ttv_BW,
                            ttv_BH: ttv_BH,
                            ttv_BPs: ttv_BPs,
                            ttv_BPd: ttv_BPd,
                            ttv_BT: ttv_BT,
                            ttv_HR: ttv_HR,
                            ttv_RR: ttv_RR,
                            ttv_SN: ttv_SN,
                            ttv_SPO2: ttv_SPO2
                        },
                        cache: false,
                        success: function(sessionFlash) {
                            $('.close').click();
                            if (sessionFlash == 'success') {
                                toastr.success('Saved!', 'Berhasil Tersimpan', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                            } else {
                                toastr.success('Error', 'Gagal Tersimpan', {
                                    timeOut: 2000,
                                    preventDuplicates: true,
                                    positionClass: 'toast-top-right',
                                });
                            }
                            window.location.replace("{{ url('registrasi') }}")
                            // viewRegistrasi()
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

        // Edits Registrasi
        // $(document).ready(function() {

        // $('#editdatareg').on('click', function() {
        function editReg() {
            // alert('op');
            var fr_tgl_reg = $('#fr_tgl_reg_e').val();
            var fr_kd_reg = $('#fr_kd_reg_e').val();
            var fr_layanan = $('#fr_layanan_e').val();
            var fr_dokter = $('#fr_dokter_e').val();
            var fr_jaminan = $('#fr_jaminan_e').val();
            var fr_session_poli = $('#fr_session_poli_e').val();
            var keluhan_utama = $('#keluhan_utama_e').val();
            // var fr_bb = $('#fr_bb').val();
            // var fr_alergi = $('#fr_alergi').val();
            // var fr_user = $('#fr_user_e').val();
            // alert(fm_nm_layanan);
            if (fr_kd_reg != "") {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('edit-registrasi') }}",
                    type: "POST",
                    data: {
                        fr_tgl_reg: fr_tgl_reg,
                        fr_kd_reg: fr_kd_reg,
                        fr_layanan: fr_layanan,
                        fr_dokter: fr_dokter,
                        fr_jaminan: fr_jaminan,
                        fr_session_poli: fr_session_poli,
                        keluhan_utama: keluhan_utama
                        // fr_bb: fr_bb,
                        // fr_alergi: fr_alergi,
                        // fr_user: fr_user
                    },
                    cache: false,
                    success: function(dataResult) {
                        $('.close').click();
                        // // document.getElementById("fm_nm_layanan").value = "";
                        window.location.replace("{{ url('registrasi') }}")
                        // // viewRegistrasi()
                        // // toastr.success('Saved');
                        // // view()
                        // // url = "{{ url('mstr-layanan') }}";
                    }
                });
            } else {
                alert('Please fill the field !');
            }
        };

        // Void Chart
        function voidReg(d) {
            $('#voidReg').modal('show');
            var kdReg = $(d).data('kodereg');
            var nameReg = $(d).data('namereg');
            // alert(kdReg)
            $('#getRegVoid').val(kdReg)
            $('#showValueName').val(nameReg)
        }

        function executeVoidReg() {
            let regID = $('#getRegVoid').val();
            // alert(regID)
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('voidRegister') }}/" + regID,
                type: 'POST',
                data: {
                    fr_kd_reg: regID
                },
                success: function(sessionFlash) {
                    if (sessionFlash == 'Error') {
                        toastr.error('Register Locked! Sudah Ada Transaksi Lain', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        $('#voidReg').modal('hide');
                    } else {
                        toastr.success('Register Void!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        window.location.reload()
                    }
                }
            })

        }

        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
@endpush
