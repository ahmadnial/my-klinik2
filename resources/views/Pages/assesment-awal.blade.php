@extends('pages.master')

@section('konten')
    <style>
        .search-px {
            position: static;

        }

        .side-panel {
            /* position: inherit; */
            background: #ffffff;
            overflow-x: hidden;
            padding: 8px 0;
        }
    </style>



    <div class="form-box bg-light p-2" style="min-height: 594vh;">
        <div class="row">
            <div class="card col-3 side-panel">
                <div class="card-header">
                    <h3 class="card-title">History</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                <i class="fas fa-inbox"></i> 23 September 2023
                                {{-- <span class="badge bg-primary float-right">12</span> --}}
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-envelope"></i> Sent
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-file-alt"></i> Drafts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-filter"></i> Junk
                                <span class="badge bg-warning float-right">65</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-trash-alt"></i> Trash
                            </a>
                        </li> --}}
                    </ul>
                </div>
            </div>
            <div class="col square1 thin mb-2" style="max-height: 90vh;">
                <div style="width:100%; background-color: white;" id="mainAssesment" class="p-0">
                    <div class="form-box p-2" style="margin-bottom:8px;background-color: white;" id="template-select">
                        <div class="col-md-12 px-0 bg-white">
                            <ul class="nav nav-tabs" style="margin:0px !important;">
                                <li class="nav-item">
                                    <a data-toggle="pill" style="background:none"
                                        class="nav-link kt-font-bolder text-primary navContent active" href="#menu0"
                                        id="tabNew">
                                        <i class="flaticon-list-1"></i>New/Edit Assesment
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" style="background:none; opacity: 0.5;"
                                        class="nav-link kt-font-bolder navContent text-primary" href="#menu1"
                                        id="tabView">
                                        <i class="flaticon-medical"></i>View Assesment
                                    </a>
                                </li>
                                <div class="col p-0 componen-view" style="top: -2px; right: 0px; display: none;"
                                    id="actionViewAssesment">
                                    <button class="btn btn-success border-radius3 pull-right" id="printView"
                                        data-toggle="modal" style="display: none;" data-target="#modalPrint" value="">
                                        <i class="flaticon2-fax"></i> Print
                                    </button>
                                </div>
                                <div class="col p-0 componen-new" style="top: -2px;right: 0;" id="actionNewAssesment">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span
                                                        class="btn pull-left align-items-center kt-font-bold p-0 pt-2 btn-header-chart-his pointer pl-2"
                                                        id="statusSMASS" style="display: none;" title="saving status">
                                                        <i class="flaticon-multimedia-3 text-muted fa-2x"
                                                            id="iconStatusSMASS"></i>
                                                        <span id="lblStatusSMASS" class="kt-font-success"
                                                            style="position: relative; top: 1px;"></span>
                                                    </span>
                                                    <span class="kt-font-normal ml-2" id="statusPaperName"
                                                        style="position: absolute; top: 8px;" title="Paper name">

                                                    </span>
                                                    <button
                                                        class="btn btn-sm btn-icon-only-blue mr-3 mt-2 kt-font-bold pull-right"
                                                        id="collapseAllSection" style="display: none;">
                                                        <i class="flaticon-interface-5 fa-lg" id="iconCollapseSection"></i>
                                                        Collapse All
                                                    </button>
                                                </div>
                                                <div class="col-8">
                                                    <div style="display: none;" id="divDokterInstructorAssesment">
                                                        <select class="form-control bootstrap-select"
                                                            id="dokterInstructorAssesment" multiple="true"></select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-sm-4" style="display: none;"
                                                    id="divTglAssesOpsional">
                                                    <div class="btn-group pull-right mr-3 mt-0">
                                                        <input type="text" id="tglAssesOpsional"
                                                            class="form-control form-control-sm text-right kt-font-lg border-info border-radius3 hasDatepicker"
                                                            im-insert="true">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 text-right" id="divSimpanAssesment">
                                            <button class="btn btn-primary pull-right border-radius3" id="simpanAssesment"
                                                disabled="">
                                                <i class="flaticon-interface-5"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </ul>
                        </div>
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
                                            ASSESMENT AWAL MEDIS
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
                                                            <label class="col-3">Tanggal</label>
                                                            <div class="col">
                                                                <input type="date" name="fd_tanggal"
                                                                    class="form-control tgl_now" />
                                                            </div>
                                                        </div>
                                                        <div class="col f-group">
                                                            <label class="col-3">Jam</label>
                                                            <div class="col">
                                                                <label class="input-group">
                                                                    <input type="time" name="ft_jam_kdtgn"
                                                                        class="form-control jam_now" step="1">
                                                                    <span
                                                                        class="input-group-append input-group-text">WIB</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <div class="f-group">
                                                        <label for="">Sumber Data</label>
                                                        <div class="form-inline" style="margin-left: -10px;">
                                                            <label class="kt-radio kt-radio-outline">
                                                                <input type="radio" name="fb_sbr_data" value="0">
                                                                Pasien
                                                                <span></span>
                                                            </label> &nbsp;&nbsp;&nbsp;
                                                            <label class="kt-radio kt-radio-outline">
                                                                <input type="radio" name="fb_sbr_data" value="1">
                                                                Keluarga
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="">
                                            <h5 class="sub-ttl">KELUHAN UTAMA</h5>
                                            <textarea type="text" name="fs_keluhan_utama" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                        </div>

                                        <div class="card-heading">
                                            <h5 class="sub-ttl">ANAMNESIS</h5>
                                            <textarea type="text" name="fs_anamnesis" rows="3" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                        <div class="card-heading">
                                            <h5 class="sub-ttl">PERJALANAN PENYAKIT SEKARANG</h5>
                                            <label for="">(Lokasi, onset, dan kronologis, kualitas,
                                                kuantitas, faktor memperberat,
                                                faktor
                                                memperingan, gejala penyerta)</label>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-12 mt-4 mb-2">
                                                    <input name="imgData" id="imgData" type="text" value=""
                                                        hidden style="margin: auto;" />
                                                    <canvas id="badan" width="360" height="434" class="imgData"
                                                        style="margin: auto; display: none;"></canvas>
                                                    <img src="src/img/img-badan.jpg" style="width: 360px; margin: auto;"
                                                        alt="badan">
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <textarea name="fs_ket_gambar" rows="10" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-heading">
                                            <h5 class="sub-ttl">RIWAYAT PENYAKIT TERDAHULU</h5>
                                            <textarea type="text" name="fs_rwyt_penyakit" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                        <div class="card-heading">
                                            <h5 class="sub-ttl">RIWAYAT PENYAKIT KELUARGA</h5>
                                            <textarea type="text" name="fs_rwyt_skt_klrg" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                        </div>
                                        <div class="card-heading">
                                            <h5 class="sub-ttl">RIWAYAT PENGOBATAN SEBELUMNYA</h5>
                                            <textarea type="text" name="fs_rwyt_obt_sebelum" rows="4" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                        </div>

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
                                                        <input type="radio" id="fb_alergi" name="fb_rwyt_alergi"
                                                            value="1">Ya,
                                                        sebutkan
                                                        <span></span>
                                                    </label>
                                                    <div class="f-group" id="alergi">
                                                        <ol>
                                                            <li>
                                                                <input type="text" name="fs_rwyt_alergi_1"
                                                                    class="form-control"
                                                                    onkeyup="if (this.value != '') document.getElementById('fb_alergi').checked = true;">
                                                            </li>
                                                            <li>
                                                                <input type="text" name="fs_rwyt_alergi_2"
                                                                    class="form-control">
                                                            </li>
                                                            <li>
                                                                <input type="text" name="fs_rwyt_alergi_3"
                                                                    class="form-control">
                                                            </li>
                                                            <li>
                                                                <input type="text" name="fs_rwyt_alergi_4"
                                                                    class="form-control">
                                                            </li>
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="">
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
                                                                    <span class="input-group-prepend"><label
                                                                            for=""
                                                                            class="input-group-text">E</label>
                                                                    </span>
                                                                    <input type="text" name="fs_gcs_e"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend"><label
                                                                            for=""
                                                                            class="input-group-text">V</label>
                                                                    </span>
                                                                    <input type="text" name="fs_gcs_V"
                                                                        class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="input-group">
                                                                    <span class="input-group-prepend"><label
                                                                            for=""
                                                                            class="input-group-text">M</label>
                                                                    </span>
                                                                    <input type="text" name="fs_gcs_m"
                                                                        class="form-control">
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
                                                                <span
                                                                    class="input-group-append input-group-text">mmHg</span>
                                                            </label>&emsp;
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label>Nadi:&ensp;</label>
                                                            <label class="input-group">
                                                                <input style="width: 6em;" name="fs_N_1" type="number"
                                                                    class="form-control" />
                                                                <span
                                                                    class="input-group-append input-group-text">x/mnt</span>
                                                            </label>&emsp;
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label>Respirasi:&ensp;</label>
                                                            <label class="input-group">
                                                                <input style="width: 6em;" name="fs_R_1" type="number"
                                                                    class="form-control" />
                                                                <span
                                                                    class="input-group-append input-group-text">x/mnt</span>
                                                            </label>&emsp;
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <label>Suhu:&ensp;</label>
                                                            <label class="input-group">
                                                                <input style="width: 6em;" name="fs_S_1" type="number"
                                                                    class="form-control" />
                                                                <span
                                                                    class="input-group-append input-group-text"><sup>o</sup>C</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="f-group">
                                                    <label class="col-2">Kepala</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_kepala"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                                <div class="f-group">
                                                    <label class="col-2">Leher</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_leher"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                                <div class="f-group">
                                                    <label class="col-2">Thorax</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_thorax"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                                <div class="f-group">
                                                    <label class="col-2">Abdomen</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_abdomen"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                                <div class="f-group">
                                                    <label class="col-2">Ekstremitas</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_ekstremitas"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                                <div class="f-group">
                                                    <label class="col-2">Genetalia</label>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="fs_genetalia"
                                                            value="Normal" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">PEMERIKSAAN PENUNJANG</h5>
                                                <textarea rows="3" name="fs_periksa_penunjang" class="form-control"></textarea>
                                            </div>

                                            <div class="card-body">
                                            </div>
                                        </div>
                                        <div class="">
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">DIAGNOSA BANDING</h5>
                                                <textarea rows="3" name="fs_diag_banding" class="form-control"></textarea>
                                            </div>

                                            <div class="card-body">
                                            </div>
                                        </div>

                                        <div class="">
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">DIAGNOSA KERJA</h5>
                                                <textarea rows="3" name="fs_diag_kerja" class="form-control"></textarea>
                                            </div>

                                            <div class="card-body">
                                            </div>
                                        </div>

                                        <div class="card-heading">
                                            <h5 class="sub-ttl">MASALAH MEDIS</h5>
                                            <textarea rows="4" name="fs_mslh_medis" class="form-control"></textarea>
                                        </div>

                                        <div class="card-body">
                                        </div>
                                        <div class="card-heading">
                                            <h5 class="group-ttl">PERENCANAAN</h5>
                                            <textarea name="fs_instruksi_medis" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="card-body">
                                            <div class="f-group">
                                                <hr>
                                                <h5 class="sub-ttl"><b>INSTRUKSI MEDIS</b></h5>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="f-group">
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
                                                                            <input type="checkbox" name="fb_disposisi"
                                                                                value="1">
                                                                            <span></span>Dipulangkan, Kontrol Poliklinik
                                                                        </label>
                                                                    </td>
                                                                    <td><input type="text" name="fs_kontrol_klinik"
                                                                            class="form-control">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi2"
                                                                                value="1">
                                                                            <span></span>Rujuk, Ke
                                                                        </label>
                                                                    </td>
                                                                    <td><input type="text" name="fs_rujuk"
                                                                            class="form-control"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi3"
                                                                                value="1">
                                                                            <span></span>Pulang Paksa / Menolak
                                                                        </label>
                                                                    </td>
                                                                    <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                                                </tr>
                                                                {{-- <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi4"
                                                                                value="1">
                                                                            <span></span>Pindah RS lain Atas Permintaan
                                                                            Sendiri
                                                                        </label>
                                                                    </td>
                                                          
                                                                </tr> --}}
                                                                {{-- <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi5"
                                                                                value="1">
                                                                            <span></span>Rawat Inap, Indikasi :
                                                                        </label>
                                                                    </td>
                                                                    <td><input type="text"
                                                                            name="fs_rawat_inap_indikasi"
                                                                            class="form-control col-6 form-inline">
                                                                    </td>
                                                                </tr> --}}
                                                                <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi6"
                                                                                value="1">
                                                                            <span></span>Melarikan Diri
                                                                        </label>
                                                                    </td>
                                                                    <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" name="fb_disposisi7"
                                                                                value="1">
                                                                            <span></span>Meninggal :
                                                                        </label>
                                                                    </td>
                                                                    <!-- <td><input type="text" name="fs_rawat_inap" class="form-control col-6 form-inline"></td> -->
                                                                    <!-- <td><label for="">Indikasi :</label></td> -->
                                                                    <td><input type="text" name="fs_meninggal"
                                                                            class="form-control col-6 form-inline">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="col-md-12">
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">
                                                    Edukasi
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div>
                                                    <p>
                                                        Edukasi awal di sampaikan tentang Diagnosis, Renaca dan
                                                        Tujuan Terapi kepada :
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
                                                                <input type="text" name="fs_klrg_pasien"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="col f-group">
                                                                <label for="">Paraf</label>
                                                                <img style="width: 100px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p>Tidak dapat memeberikan edukasi kepada pasien dan keluarga,
                                                        karena :</p>
                                                    <input type="text" name="fs_tdk_dpt_edu" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7"></div>
                                            <div class="col-md-5" style="align-items: center">
                                                <div>
                                                    <div class="form-inline">
                                                        <label for="">Tanggal/ Jam</label>
                                                        <div class="input-group">
                                                            <input type="date" name="fd_tgl_ttd"
                                                                class="form-control tgl_now">
                                                            <span class="input-group-append"><label
                                                                    class="input-group-text">/</label></span>
                                                            <input type="time" name="fs_jam_ttd"
                                                                class="form-control jam_now">
                                                            <span class="input-group-append"><label
                                                                    class="input-group-text">WIB</label></span>
                                                        </div>
                                                    </div>
                                                    <div style="text-align: center">
                                                        <label>Dokter</label>
                                                    </div>
                                                </div>
                                                <div>

                                                    <div class="text-center">
                                                        <img id="tanda_tangan_dokter"
                                                            style="max-width:200px;height:100px;" />
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
                        </section>
                        <div class="tab-content" style="background-color: white;">
                            <div id="menu0" class="tab-pane fade active show">
                                <span class="btn-scroll-top" id="scrollEdit" style="position: fixed; right: 22px;"><i
                                        class="fa fa-chevron-circle-up fa-lg text-warning"></i></span>
                                <form name="form_assesment">
                                    <div id="assesment-content"
                                        class="row scroll-y scrollbar-dusty-grass thin square1 assesment mt-1"
                                        style="max-height: 100%; overflow-x: hidden;"></div>
                                    <div id="assesment-smass"
                                        class="row scroll-y scrollbar-dusty-grass thin square1 assesment mt-1"
                                        style="max-height: 100%; overflow-x: hidden;">
                                        <div class="col-12 px-0">
                                            <div class="col-12 px-0"></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div id="menu1" class="tab-pane">
                                <span class="btn-scroll-top" id="scrollView" style="position: fixed; right: 22px;"><i
                                        class="fa fa-chevron-circle-up fa-lg text-warning"></i></span>
                                <div class="scroll-y scrollbar-dusty-grass thin square1 assesment p-0 mt-1"
                                    style="max-height: 100%; overflow-x: hidden;" id="scrollContent">
                                    <form id="assesment-content-view" name="assesment-content-view"></form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-box p-2" style="margin-bottom:8px;background-color: white; display: none;"
                    id="insight-container">
                    <div class="row mb-2">
                        <div id="insight-content" class="col-12">
                            <div role="group" aria-label="Small button group" class="btn-group btn-group-sm"
                                style="padding-top: 1px;">
                                <div class="input-group col-12"><input type="text" id="tglInsightAwal"
                                        placeholder="dd-mm-yyyy"
                                        class="form-control form-control-sm text-right hasDatepicker">
                                    <div class="input-group-append"><span class="input-group-text"
                                            style="border-radius: 0px !important;"><i class="la la-calendar"></i></span>
                                    </div> <input type="text" id="tglInsightAkhir" placeholder="dd-mm-yyyy"
                                        class="form-control form-control-sm text-right hasDatepicker"
                                        style="border-top-left-radius: 0px !important; border-bottom-left-radius: 0px !important;">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 pt-2" style="display: none;">
                                <div class="table-responsive">
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        <script>
            // Hitung Umur
            function getUmurDetail(dateString) {
                var today = new Date();
                var DOB = new Date(dateString);
                var totalMonths = (today.getFullYear() - DOB.getFullYear()) * 12 + today.getMonth() - DOB.getMonth();
                totalMonths += today.getDay() < DOB.getDay() ? -1 : 0;
                var years = today.getFullYear() - DOB.getFullYear();
                if (DOB.getMonth() > today.getMonth())
                    years = years - 1;
                else if (DOB.getMonth() === today.getMonth())
                    if (DOB.getDate() > today.getDate())
                        years = years - 1;

                var days;
                var months;

                if (DOB.getDate() > today.getDate()) {
                    months = (totalMonths % 12);
                    if (months == 0)
                        months = 11;
                    var x = today.getMonth();
                    switch (x) {
                        case 1:
                        case 3:
                        case 5:
                        case 7:
                        case 8:
                        case 10:
                        case 12: {
                            var a = DOB.getDate() - today.getDate();
                            days = 31 - a;
                            break;
                        }
                        default: {
                            var a = DOB.getDate() - today.getDate();
                            days = 30 - a;
                            break;
                        }
                    }

                } else {
                    days = today.getDate() - DOB.getDate();
                    if (DOB.getMonth() === today.getMonth())
                        months = (totalMonths % 12);
                    else
                        months = (totalMonths % 12) + 1;
                }
                var age = years + ' Tahun ' + months + ' Bulan ' + days + ' Hari';
                return age;
            }

            // Call Hasil Search Registrasi
            $("#ts_kd_reg").on("change", function() {
                $('#kumpulanButton').empty();
                $('#createSOAPP').show();

                toastr.info('Pasein Pinned!', {
                    timeOut: 600,
                    // preventDuplicates: true,
                    positionClass: 'toast-top-right',
                });
                var kdReg = $('#ts_kd_reg').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('SearchRegister') }}/" + kdReg,
                    type: 'GET',
                    data: {
                        'fr_kd_reg': kdReg
                    },
                    success: function(isRegSearch) {
                        $.each(isRegSearch, function(key, dataregvalue) {
                            // $('#tr_no_mr').val(dataregvalue.fr_mr);
                            // $('#tr_nm_pasien').val(dataregvalue.fr_nama);
                            // $('#tr_jenis_kelamin').val(dataregvalue.fr_jenis_kelamin);
                            // $('#tr_layanan').val(dataregvalue.fr_layanan);
                            // $('#tr_dokter').val(dataregvalue.fr_dokter);
                            // $('#tr_alamat').val(dataregvalue.fr_alamat);
                            $('#tr_tgl_lahir').val(dataregvalue.fr_tgl_lahir);

                            $('#namaHdr').val(dataregvalue.fr_nama);
                            $('#noMRHdr').val(dataregvalue.fr_mr);
                            $('#noRGHdr').val(dataregvalue.fr_kd_reg);
                            $('#dokterHdr').val(dataregvalue.fr_dokter);
                            $('#layananHdr').val(dataregvalue.fr_layanan);
                            $('#jkHdr').val(dataregvalue.fr_jenis_kelamin);
                            $('#alamatHdr').val(dataregvalue.fr_alamat);
                            $('#alergiHdr').val(dataregvalue.fr_alergi);
                            $('#lastTarifDsrHdr').val(dataregvalue.tcmr.fs_last_tarif_dasar);


                            $('#chart_kd_reg').val(dataregvalue.fr_kd_reg);
                            $('#chart_mr').val(dataregvalue.fr_mr);
                            $('#chart_nm_pasien').val(dataregvalue.fr_nama);
                            $('#chart_layanan').val(dataregvalue.fr_layanan);
                            $('#chart_dokter').val(dataregvalue.fr_dokter);

                            // $('#keluhanutama').val(dataregvalue.keluhan_utama);
                            // $('.ta_Chart_S').val(dataregvalue.keluhan_utama);

                            var isDateBirthday = dataregvalue.fr_tgl_lahir;
                            var isAgeNow = getUmurDetail(isDateBirthday);
                            $('#tr_umur').val(isAgeNow);
                            $('#umurHdr').val(isAgeNow);
                            $('#tglLahirHdr').val(isDateBirthday);

                            // Get MR & save  di sessionStorage
                            var mr = {};
                            mr.Text = $("#tr_no_mr").val();

                            var kdReg = {};
                            kdReg.Text = $("#tr_kd_reg").val();

                            var ChartID = {};
                            ChartID.Text = $("#chart_id").val();

                            var UserActive = {};
                            UserActive.Text = $("#userActive").val();
                            // mr.isProcessed = false;
                            sessionStorage.setItem("dataMR", JSON.stringify(mr));
                            sessionStorage.setItem("kdReg", JSON.stringify(kdReg));
                            sessionStorage.setItem("ChartID", JSON.stringify(ChartID));
                            sessionStorage.setItem("UserActive", JSON.stringify(UserActive));
                        })
                    }
                })
            });

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
