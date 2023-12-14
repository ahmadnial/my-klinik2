@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="template">
            <style>
                input,
                textarea {
                    margin-bottom: 5px;
                }

                .center {
                    /* display: block; */
                    margin-left: 150px;
                    margin-right: 20px;
                    /* width: 50%; */
                }
            </style>
            <div class="heading">
                <div class="row">
                    <h3 class="col-12">
                        PENGKAJIAN AWAL MEDIS
                    </h3>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row borderblok">
                            <div class="col-lg-6 col-sm-12">
                                <div class="row">
                                    <div class="col f-group">
                                        <label class="col-3">Tanggal :</label>
                                        <div class="col">
                                            <input type="date" name="fd_tanggal" class="form-control tgl_now" />
                                        </div>
                                    </div>
                                    <div class="col f-group">
                                        <label class="col-3">Jam : </label>
                                        <div class="col">
                                            <label class="input-group">
                                                <input type="time" name="ft_jam_kdtgn" class="form-control jam_now"
                                                    step="1">
                                                <span class="input-group-append input-group-text">WIB</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="f-group">
                                    <label for="">Sumber Data :</label>
                                    <div class="form-inline" style="margin-left: -10px;">
                                        <label class="kt-radio kt-radio-outline">
                                            <input type="radio" name="fb_sbr_data" value="0">
                                            Pasien
                                            <span></span>
                                        </label>
                                        <label class="kt-radio kt-radio-outline">
                                            <input type="radio" name="fb_sbr_data" value="1">
                                            Keluarga
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <!-- <div class="row">
                                                                                        <label class="col-3">Dokter Pemeriksa:&ensp;</label>
                                                                                        <div class="col">
                                                                                            <input class="form-control" type="text" style="width: 20em;" name="fs_dokter_assessment" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <label class="col-3">Waktu Pengkajian:</label>
                                                                                        <div class="col">
                                                                                            <label class="input-group" style="width:15em">
                                                                                                <input type="time" name="ft_wkt_pngkjian" class="form-control" step="1">
                                                                                                <span class="input-group-append input-group-text">WIB</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div> -->
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="card card-default f-group">
                        <div class="card-heading">
                            {{-- <h5 class="sub-ttl">KELUHAN UTAMA</h5> --}}
                            <h5 class="sub-ttl">KELUHAN UTAMA</h5>
                        </div>
                        <div class="card-body">
                            <textarea type="text" name="fs_keluhan_utama" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">ANAMNESIS</h5>
                        </div>
                        <div class="card-body">
                            <textarea type="text" name="fs_anamnesis" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">PERJALANAN PENYAKIT SEKARANG</h5>
                            <label for="">(Lokasi, onset, dan kronologis, kualitas, kuantitas, faktor memperberat,
                                faktor
                                memperingan, gejala penyerta)</label>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12 mt-4 mb-2">
                                    <input name="imgData" id="imgData" type="text" value="" hidden
                                        style="margin: auto;" />
                                    <canvas id="badan" width="360" height="434" class="imgData"
                                        style="margin: auto; display: none;"></canvas>
                                    <img class="imgData" style="width: 360px; margin: auto;" alt="badan"
                                        src="./assets/media/img-assesment/img-badan.jpg">
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <textarea name="fs_ket_gambar" rows="10" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">RIWAYAT PENYAKIT TERDAHULU</h5>
                        </div>
                        <div class="card-body">
                            <textarea type="text" name="fs_rwyt_penyakit" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">RIWAYAT PENYAKIT KELUARGA</h5>
                        </div>
                        <div class="card-body">
                            <textarea type="text" name="fs_rwyt_skt_klrg" rows="4" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">RIWAYAT PENGOBATAN SEBELUMNYA</h5>
                        </div>
                        <div class="card-body">
                            <textarea type="text" name="fs_rwyt_obt_sebelum" rows="4" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="card card-default f-group">
                        <div class="card-heading">
                            <h5 class="sub-ttl">RIWAYAT ALERGI</h5>
                        </div>
                        <div class="card-body">
                            <div class="p-2">
                                <label class="kt-radio kt-radio-outline">
                                    <input type="radio" name="fb_rwyt_alergi" value="0">Tidak
                                    <span></span>
                                </label>
                                <div>
                                    <label class="kt-radio kt-radio-outline">
                                        <input type="radio" id="fb_alergi" name="fb_rwyt_alergi" value="1">Ya,
                                        sebutkan
                                        <span></span>
                                    </label>
                                    <div class="f-group" id="alergi">
                                        <ol>
                                            <li>
                                                <input type="text" name="fs_rwyt_alergi_1" class="form-control"
                                                    onkeyup="if (this.value != '') document.getElementById('fb_alergi').checked = true;">
                                            </li>
                                            <li>
                                                <input type="text" name="fs_rwyt_alergi_2" class="form-control">
                                            </li>
                                            <li>
                                                <input type="text" name="fs_rwyt_alergi_3" class="form-control">
                                            </li>
                                            <li>
                                                <input type="text" name="fs_rwyt_alergi_4" class="form-control">
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card card-default">
                        <div class="card-heading">
                            <h4 class="group-ttl">PEMERIKSAAN FISIK</h4>
                        </div>

                        <div class="card-body">
                            <div class="">
                                <h5 for="" class="sub-ttl">Kesadaran Umum</h5>
                                <div class="f-group">
                                    <label for="">GCS</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">E</label>
                                                </span>
                                                <input type="text" name="fs_gcs_e" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">V</label>
                                                </span>
                                                <input type="text" name="fs_gcs_V" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">M</label>
                                                </span>
                                                <input type="text" name="fs_gcs_m" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row f-group">
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Tekanan Darah:&ensp;</label>
                                        <label class="input-group">
                                            <input style="width: 5em;" name="fs_td" type="text"
                                                class="form-control" />
                                            <span class="input-group-append input-group-text">mmHg</span>
                                        </label>&emsp;
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Nadi:&ensp;</label>
                                        <label class="input-group">
                                            <input style="width: 6em;" name="fs_N_1" type="number"
                                                class="form-control" />
                                            <span class="input-group-append input-group-text">x/mnt</span>
                                        </label>&emsp;
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Respirasi:&ensp;</label>
                                        <label class="input-group">
                                            <input style="width: 6em;" name="fs_R_1" type="number"
                                                class="form-control" />
                                            <span class="input-group-append input-group-text">x/mnt</span>
                                        </label>&emsp;
                                    </div>
                                    <div class="col-lg-6 col-sm-12">
                                        <label>Suhu:&ensp;</label>
                                        <label class="input-group">
                                            <input style="width: 6em;" name="fs_S_1" type="number"
                                                class="form-control" />
                                            <span class="input-group-append input-group-text"><sup>o</sup>C</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="f-group">
                                <label class="col-2">Kepala</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_kepala" value="Normal" />
                                </div>
                            </div>
                            <div class="f-group">
                                <label class="col-2">Leher</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_leher" value="Normal" />
                                </div>
                            </div>
                            <div class="f-group">
                                <label class="col-2">Thorax</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_thorax" value="Normal" />
                                </div>
                            </div>
                            <div class="f-group">
                                <label class="col-2">Abdomen</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_abdomen" value="Normal" />
                                </div>
                            </div>
                            <div class="f-group">
                                <label class="col-2">Ekstremitas</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_ekstremitas" value="Normal" />
                                </div>
                            </div>
                            <div class="f-group">
                                <label class="col-2">Genetalia</label>
                                <div class="col">
                                    <input type="text" class="form-control" name="fs_genetalia" value="Normal" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h5 class="sub-ttl">PEMERIKSAAN PENUNJANG</h5>
                            </div>

                            <div class="card-body">
                                <textarea rows="3" name="fs_periksa_penunjang" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h5 class="sub-ttl">DIAGNOSA BANDING</h5>
                            </div>

                            <div class="card-body">
                                <textarea rows="3" name="fs_diag_banding" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h5 class="sub-ttl">DIAGNOSA KERJA</h5>
                            </div>

                            <div class="card-body">
                                <textarea rows="3" name="fs_diag_kerja" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card card-default">
                        <div class="card-heading">
                            <h5 class="sub-ttl">MASALAH MEDIS</h5>
                        </div>

                        <div class="card-body">
                            <textarea rows="4" name="fs_mslh_medis" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-heading">
                            <h4 class="group-ttl">PERENCANAAN</h4>
                        </div>
                        <div class="card-body">
                            <div class="f-group">
                                <h5 class="sub-ttl">INSTRUKSI MEDIS</h5>
                                <textarea name="fs_instruksi_medis" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="f-group">
                        <!-- <h5 class="sub-ttl">
                                                                                    RENCANA TINDAK LANJUT
                                                                                </h5>
                                                                                <textarea name="fs_rcn_tindak_lanjut" rows="3" class="form-control"></textarea> -->
                        <div class="">
                            <div>
                                <h4 class="group-ttl">RENCANA TINDAK LANJUT</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-2">
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td style="width:25%">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi" value="1">
                                                        <span></span>Dipulangkan, Kontrol Poliklinik
                                                    </label>
                                                </td>
                                                <td><input type="text" name="fs_kontrol_klinik" class="form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi2" value="1">
                                                        <span></span>Rujuk, Ke
                                                    </label>
                                                </td>
                                                <td><input type="text" name="fs_rujuk" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi3" value="1">
                                                        <span></span>Pulang Paksa / Menolak
                                                    </label>
                                                </td>
                                                <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi4" value="1">
                                                        <span></span>Pindah RS lain Atas Permintaan Sendiri
                                                    </label>
                                                </td>
                                                <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi5" value="1">
                                                        <span></span>Rawat Inap, Indikasi :
                                                    </label>
                                                </td>
                                                <!-- <td><input type="text" name="fs_rawat_inap" class="form-control col-6 form-inline"></td> -->
                                                <!-- <td><label for="">Indikasi :</label></td> -->
                                                <td><input type="text" name="fs_rawat_inap_indikasi"
                                                        class="form-control col-6 form-inline"></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi6" value="1">
                                                        <span></span>Melarikan Diri
                                                    </label>
                                                </td>
                                                <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" name="fb_disposisi7" value="1">
                                                        <span></span>Meninggal :
                                                    </label>
                                                </td>
                                                <!-- <td><input type="text" name="fs_rawat_inap" class="form-control col-6 form-inline"></td> -->
                                                <!-- <td><label for="">Indikasi :</label></td> -->
                                                <td><input type="text" name="fs_meninggal"
                                                        class="form-control col-6 form-inline"></td>
                                            </tr>

                                            <!-- <tr>
                                                                                                        <td colspan="2">
                                                                                                            <label for="">Konsul Ke</label>
                                                                                                            <div>
                                                                                                                <label class="kt-checkbox kt-checkbox-outline">
                                                                                                                    <input type="checkbox" name="fb_konsul1" value="1">
                                                                                                                    <span></span>Ahli Gizi
                                                                                                                </label>
                                                                                                                <label class="kt-checkbox kt-checkbox-outline">
                                                                                                                    <input type="checkbox" name="fb_konsul2" value="1">
                                                                                                                    <span></span>Rehab Medis
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </td>
                                                                                                    </tr> -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <!-- <div class="f-group">
                                                                                    <label for="">Rawat Inap</label>
                                                                                    <div class="row">
                                                                                        <label class="kt-radio kt-radio-outline col-lg-2 col-sm-4">
                                                                                            <input type="radio" id="fb_ri-tdk" name="fb_ri" value="0">Tidak
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <div class="col-lg-4 col-sm-8 form-inline">
                                                                                            <label class="kt-radio kt-radio-outline">
                                                                                                <input type="radio" id="fb_ri-ya" name="fb_ri" value="1">Ya,
                                                                                                <span></span>
                                                                                            </label>
                                                                                            <div class="form-inline" id="ruang">
                                                                                                <label for="">Ruang&nbsp;</label>
                                                                                                <input type="text" name="fs_ruang_rwt" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                        <!-- <div class="f-group">
                                                                                    <label for="">Tindakan lanjutan di</label>
                                                                                    <div class="row">
                                                                                        <label class="kt-radio kt-radio-outline col-lg-3 col-sm-6">
                                                                                            <input type="radio" id="fb_tindakan1" name="fb_r_tindakan" value="0">Kamar Operasi
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col-lg-3 col-sm-6">
                                                                                            <input type="radio" id="fb_tindakan2" name="fb_r_tindakan" value="1">Kamar Bersalin
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col-lg-3 col-sm-6">
                                                                                            <input type="radio" id="fb_tindakan3" name="fb_r_tindakan" value="2">Kamar HD
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col-lg-3 col-sm-6">
                                                                                            <input type="radio" id="fb_tindakan4" name="fb_r_tindakan" value="3">Lainnya
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="f-group">
                                                                                    <label for="">Rujuk Ke</label>
                                                                                    <input type="text" name="fs_rujuk_ke" class="form-control">
                                                                                </div>
                                                                                <div class="f-group">
                                                                                    <label for="">Dipulangkan</label>
                                                                                    <div class="row">
                                                                                        <label class="kt-radio kt-radio-outline col">
                                                                                            <input type="radio" name="fb_pulang" value="0">Diijinkan Dokter
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col">
                                                                                            <input type="radio" name="fb_pulang" value="1">Meninggal
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col">
                                                                                            <input type="radio" name="fb_pulang" value="2">Melarikan Diri
                                                                                            <span></span>
                                                                                        </label>
                                                                                        <label class="kt-radio kt-radio-outline col">
                                                                                            <input type="radio" name="fb_pulang" value="3">APS
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                            </div>
                                                                        </div> -->
                    </div>
                </div>
                <div class="col-md">
                    <div class="card card-default">
                        <div class="card-heading">
                            <h5 class="sub-ttl">
                                Kondisi saat keluar IGD
                            </h5>
                            <div class="f-group">
                                <label for="">Pukul</label>
                                <input type="time" name="fs_jam_klr_igd" class="form-control w-25">
                            </div>
                            <div class="f-group">
                                <label for="">Tanda-tanda Vital</label>
                                <div class="f-group">
                                    <label for="">GCS</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">E</label>
                                                </span>
                                                <input type="text" name="fs_gcs_e_igd" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">V</label>
                                                </span>
                                                <input type="text" name="fs_gcs_v_igd" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <span class="input-group-prepend"><label for=""
                                                        class="input-group-text">M</label>
                                                </span>
                                                <input type="text" name="fs_gcs_m_igd" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row f-group">
                                <div class="col-lg-6 col-sm-12">
                                    <label>Tekanan Darah:&ensp;</label>
                                    <label class="input-group">
                                        <input style="width: 5em;" name="fs_td_igd" type="text"
                                            class="form-control" />
                                        <span class="input-group-append input-group-text">mmHg</span>
                                    </label>&emsp;
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label>Nadi:&ensp;</label>
                                    <label class="input-group">
                                        <input style="width: 6em;" name="fs_N_1_igd" type="number"
                                            class="form-control" />
                                        <span class="input-group-append input-group-text">x/menit</span>
                                    </label>&emsp;
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label>Respirasi:&ensp;</label>
                                    <label class="input-group">
                                        <input style="width: 6em;" name="fs_R_1_igd" type="number"
                                            class="form-control" />
                                        <span class="input-group-append input-group-text">x/menit</span>
                                    </label>&emsp;
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <label>Suhu:&ensp;</label>
                                    <label class="input-group">
                                        <input style="width: 6em;" name="fs_S_1_igd" type="number"
                                            class="form-control" />
                                        <span class="input-group-append input-group-text"><sup>o</sup>C</span>
                                    </label>
                                </div>
                            </div>
                            <div class="f-group">
                                <label for="">(catatan penting kondisi saat ini)</label>
                                <input type="text" name="fs_ctt_penting" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card card-default">
                            <div class="card-heading">
                                <h5 class="sub-ttl">
                                    Edukasi
                                </h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <p>
                                        Edukasi awal di sampaikan tentang Diagnosis, Renaca dan Tujuan Terapi kepada :
                                    </p>
                                    <div class="row">
                                        <div class="col f-group">
                                            <label for="">Pasien</label>
                                            <input type="text" name="fs_pasien" id="fs_nama_psn"
                                                class="form-control">
                                        </div>
                                        <div class="col f-group">
                                            <label for="">Paraf</label>
                                            <img style="width: 100px;">
                                        </div>
                                    </div>
                                    <div>
                                        <label for="">Keluarga Pasien</label>
                                        <div class="row">
                                            <div class="col f-group">
                                                <label for="">Nama</label>
                                                <input type="text" name="fs_klrg_pasien" class="form-control">
                                            </div>
                                            <div class="col f-group">
                                                <label for="">Paraf</label>
                                                <img style="width: 100px;">
                                            </div>
                                        </div>
                                    </div>
                                    <p>Tidak dapat memeberikan edukasi kepada pasien dan keluarga, karena :</p>
                                    <input type="text" name="fs_tdk_dpt_edu" class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="row">

                            <div class="col-md-7"></div>
                            <div class="col-md-5" style="align-items: center">
                                <div>
                                    <div class="form-inline">
                                        <label for="">Tanggal/ Jam</label>
                                        <div class="input-group">
                                            <input type="date" name="fd_tgl_ttd" class="form-control tgl_now">
                                            <span class="input-group-append"><label
                                                    class="input-group-text">/</label></span>
                                            <input type="time" name="fs_jam_ttd" class="form-control jam_now">
                                            <span class="input-group-append"><label
                                                    class="input-group-text">WIB</label></span>
                                        </div>
                                    </div>
                                    <div style="text-align: center">
                                        <label>Dokter</label>
                                    </div>
                                </div>
                                <div>
                                    <!-- <div class="col-md-4 pull-left">
                                                                                            <img style="max-width:200px;height:100px;" />
                                                                                            <img src="./ttd/ttd.png" alt="contoh3" width="150" height="150" class="center" />
                                                                                        </div> -->
                                    <div class="text-center">
                                        <img id="tanda_tangan_dokter" style="max-width:200px;height:100px;" />
                                    </div>
                                </div>
                                <div>
                                    <div style="text-align: center">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-append input-group-text">(</span>
                                                <input type="text" name="fs_dokter_assessment"
                                                    class="form-control text-center">
                                                <span class="input-group-append input-group-text">)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var mt_kanan = new Coret({
            cvs: "badan",
            src: "src/plugins/Assesment/img-badan.jpg",
            // src: "./assets/media/img-assesment/img-badan.jpg",
            imgData: "imgData",
            type: "hybrid",
            pointingBtn: "noluk",
            pointingConfig: {
                fontColor: "blue",
                fontFamily: "Courier New",
                fontSize: "20px"
            }
        });

        $(".btn").tooltip({
            container: 'body'
        });
    </script>
@endpush
