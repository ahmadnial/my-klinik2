@extends('pages.master')
@section('mytitle', 'Assesment Awal')
@section('konten')
    <style>
        .search-px {
            position: static;

        }

        .side-panel {
            position: static;
            background: #ffffff;
            /* overflow-x: hidden; */
            overflow-y: scroll;
            padding: 8px 0;
        }

        .folder {
            cursor: pointer;
        }

        ul {
            list-style-type: none;
        }

        ul ul {
            display: none;
        }
    </style>

    <div class="form-box bg-light p-2" style="overflow-y:scroll;">
        <div class="row">
            <div class="card col-3 side-panel">
                <div class="static-card-timeline mb-2">
                    <div class="justify-content-between px-1"
                        style="display: flex !important; z-index:100; border: 1px solid #e0cff0; background-color: #FFFFFF;">

                        <div class="" id="" style="align-content: center">
                            <div class="accordion m-1 form-inline  text-light" id="DetailPasien">
                                <div class="card ml-3 mt-1" style="align-content: center">
                                    <div class="form-control card-header row" name="PasienHdr"
                                        style="background-color:#a07ccf">
                                        <div class="text-light collapsed pointer" id="collapseCoverPasien"
                                            data-toggle="collapse" data-target="#DetPsn" aria-expanded="false"
                                            aria-controls="DetPsn" style="background-color:#a07ccf; border: none;">
                                            <label style="width: 2vw;overflow: hidden;text-overflow: " name="nmPasienHdr"
                                                id="nmPasienHdr" class="text-warning pointer">
                                                <i class="fa fa-user"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div id="DetPsn"
                                        style="position: fixed; margin-top: 40px; z-index: 9999; min-width: 324px; border: 1px solid rgb(119, 94, 151);"
                                        class="bg-light text-dark shadow collapse" aria-labelledby="headingOne"
                                        data-parent="#DetailPasien">
                                        <div class="scrollbar-dusty-grass square1 thin scroll-y scrollbox"
                                            style="max-height: 480px;">
                                            <div class="card-body">
                                                <div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color: #d2eaff" name="">
                                                            <b>Nama :</b> <input type="text" class="form-control-xs"
                                                                name="" id="namaHdr"
                                                                style="background-color: #d2eaff; border:none">
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color: #d2eaff" name="noMRHdr">
                                                            <b>No. RM :</b><input type="text" class="form-control-xs"
                                                                name="" id="noMRHdr"
                                                                style="background-color: #d2eaff; border:none">
                                                        </div>
                                                        {{-- <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color: #d2eaff;" name="tglPeriksaHdr">
                                                            01-01-3000 00:00:00
                                                            <!-- <span name="tglPeriksaHdr"></span> -->
                                                            <!-- <span name="jamPeriksaHdr"></span> -->
                                                        </div> --}}
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8f5d6;" name="layananCoverHdr">
                                                            <b>No. Reg :</b><input type="text" class="form-control-xs"
                                                                name="" id="noRGHdr"
                                                                style="background-color:#f8f5d6; border:none">
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8f5d6;" name="">
                                                            <b>Dokter :</b><input type="text" class="form-control-xs"
                                                                name="" id="dokterHdr"
                                                                style="background-color:#f8f5d6; border:none">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            title="" style="background-color:#f8d6e2;" name="">
                                                            <b>Layanan :</b><input type="text" class="form-control-xs"
                                                                name="" id="layananHdr"
                                                                style="background-color: #f8d6e2; border:none">
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8d6e2;" name="">
                                                            <b>J/K :</b><input type="text" class="form-control-xs"
                                                                name="" id="jkHdr"
                                                                style="background-color:#f8d6e2; border:none">
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8d6e2;">
                                                            <span name="usiaHdr">
                                                                <b>Umur :</b><input type="text" class="form-control-xs"
                                                                    name="" id="umurHdr"
                                                                    style="background-color:#f8d6e2; border:none">
                                                            </span>

                                                            || Tgl. Lahir : <input type="text" class="form-control-xs"
                                                                name="" id="tglLahirHdr"
                                                                style="background-color:#f8d6e2; border:none">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8d6e2; border:none" name="alergiHdr"
                                                            id="">
                                                            <b>Alergi :</b><input type="text" class="form-control-xs"
                                                                name="" id="alergiHdr"
                                                                style="background-color:#f8d6e2; border:none">
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color:#f8d6e2; border:none"
                                                            name="lastTarifDsrHdr" id="">
                                                            <b>Last tarif Dasar :</b><input type="text"
                                                                class="form-control-xs" name=""
                                                                id="lastTarifDsrHdr"
                                                                style="background-color:#f8d6e2; border:none">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-wrap">
                                                        {{-- <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color: #9976c73d;color: #5000b9;"
                                                            name="pendidikanHdr">EDU : -
                                                        </div>
                                                        <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                            style="background-color: #9976c73d;color: #5000b9;"
                                                            name="pekerjaanHdr">
                                                            WORK : -
                                                        </div> --}}
                                                    </div>
                                                    {{-- <div class=""> --}}
                                                    <div class="px-2 py-1 m-1 rounded rounded-sm"
                                                        style="background-color:#d6f8dd;" name="alamatHdr">
                                                        <i class="fa fa-home"></i>
                                                        <input type="text" class="form-control-xs col-8"
                                                            name="" id="alamatHdr"
                                                            style="background-color:#d6f8dd; border:none">
                                                    </div>
                                                </div>
                                                <div class="col-12 p-0 hide">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group col-sm-6">
                                    <label for="">Search Registrasi</label>
                                    <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;"
                                        name="tr_kd_reg">
                                        @foreach ($isRegActive as $reg)
                                        <option value="">--Select--</option>
                                        <option value="{{ $reg->fr_kd_reg }}">
                                            {{ $reg->fr_kd_reg . '-' . $reg->fr_nama }}
                                        </option>
                                        @endforeach
                                    </select> --}}
                            </div>
                        </div>

                        <div class="border-right"></div>
                        <div class="">
                        </div>
                        <div class="p-0 col-4 pr-2" style="padding-top: 10px !important;">
                            <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;" name="tr_kd_reg">
                                @foreach ($isRegActive as $reg)
                                    <option value="">--Select--</option>
                                    <option value="{{ $reg->fr_kd_reg }}">
                                        {{ $reg->fr_kd_reg . '-' . $reg->fr_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="border-right"></div>

                        <div class="p-0 col-4 pr-2 pt-2" id="panelFilterInstalasi" style="padding-top: 10px !important;">
                            <input type="date" class="form-control form-control-sm" name="tr_tgl_trs" id="tr_tgl_trs"
                                value="{{ $dateNow }}" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-header bg-nial">
                    <h3 class="card-title">History</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <div class="showListLabelAss" id="showListLabelAss">

                            </div>
                            {{-- <input type="text" name="labelAssHdr" id="labelAssHdr"
                                    class="form-control form-control-sm" style="border: none"> --}}
                            {{-- <span class="badge bg-primary float-right">12</span> --}}
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
                    {{-- <div id="folder-structure">
                        <ul>
                            <li class="folder">Folder 1
                                <ul>
                                    <li>File 1</li>
                                    <li>File 2</li>
                                </ul>
                            </li>
                            <li class="folder">Folder 2
                                <ul>
                                    <li>File 3</li>
                                    <li>File 4</li>
                                </ul>
                            </li>
                        </ul>
                    </div> --}}
                    {{-- <ul class="folder-structure">
                        <li><span class="folder"
                                data-subfolders='[{"name": "file1.txt"},{"name": "file2.txt"}]'>MyFolder<i
                                    class="fas fa-caret-down"></i></span>
                            <ul class="nested">
                                <!-- Subfolders will be added here by the JavaScript code -->
                            </ul>
                        </li>
                    </ul> --}}
                </div>
            </div>
            <div class="col square1 thin mb-2" style="max-height: 90vh; overflow-y:scroll;">
                <div style="width:100%; background-color: white;" id="mainAssesment" class="p-0">
                    <div class="form-box p-2" style="margin-bottom:8px;background-color: white;" id="template-select">
                        <div class="col-md-12 px-0 bg-white">
                            <ul class="nav nav-tabs" style="margin:0px !important;">
                                <li class="nav-item">
                                    <a data-toggle="pill" style="background:none"
                                        class="nav-link kt-font-bolder text-primary navContent active" href="#"
                                        id="tabNew" onclick="editAssDisable()">
                                        <i class="flaticon-list-1"></i>View Assesment
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a data-toggle="pill" style="background:none; opacity: 0.5;"
                                        class="nav-link kt-font-bolder navContent text-primary" href=""
                                        id="tabView" onclick="editAssEnable()">
                                        <i class="flaticon-medical"></i>Edit Assesment
                                    </a>
                                </li>
                                <div class="col p-0 componen-view" style="top: -2px; right: 0px; display: none;"
                                    id="actionViewAssesment">
                                    <button class="btn btn-success border-radius3 pull-right" id="printView"
                                        data-toggle="modal" style="display: none;" data-target="#modalPrint"
                                        value="">
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
                                                        <i class="flaticon-interface-5 fa-lg"
                                                            id="iconCollapseSection"></i>
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
                                        {{-- <div class="col-3 text-right" id="divSimpanAssesment">
                                            <button class="btn btn-primary btn-sm pull-right border-radius3"
                                                id="simpanAssesment">
                                                <i class="fa fa-save"></i> Save
                                            </button>
                                        </div> --}}
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
                                <div class="heading" style="background-color: #e9e7eb">
                                    <div class="row">
                                        <h3 class="col-12 text-center mt-3">
                                            ASSESMENT AWAL MEDIS RAWAT JALAN
                                        </h3>
                                    </div>
                                </div>
                                <form action="addAssesment" method="POST">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="row">
                                                    {{-- <div class="col-lg-6 col-sm-12">
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
                                                </div> --}}
                                                    {{-- <div class="col-lg-6 col-sm-12">
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
                                                </div> --}}
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="">
                                                <h5 class="sub-ttl">KELUHAN UTAMA</h5>
                                                <textarea type="text" name="fs_keluhan_utama" id="fs_keluhan_utama" rows="3" class="form-control">{{ old('fs_keluhan_utama') }}</textarea>
                                            </div>
                                            <div class="card-body">
                                            </div>

                                            <div class="card-heading">
                                                <h5 class="sub-ttl">ANAMNESIS</h5>
                                                <textarea type="text" name="fs_anamnesis" id="fs_anamnesis" rows="3" class="form-control">{{ old('fs_anamnesis') }}</textarea>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            {{-- <div class="card-heading">
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
                                        </div> --}}

                                            <div class="card-heading">
                                                <h5 class="sub-ttl">RIWAYAT PENYAKIT TERDAHULU</h5>
                                                <textarea type="text" name="fs_rwyt_penyakit" id="fs_rwyt_penyakit" rows="4" class="form-control">{{ old('fs_rwyt_penyakit') }}</textarea>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">RIWAYAT PENYAKIT KELUARGA</h5>
                                                <textarea type="text" name="fs_rwyt_skt_klrg" id="fs_rwyt_skt_klrg" rows="4" class="form-control">{{ old('fs_rwyt_skt_klrg') }}</textarea>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                            <div class="card-heading">
                                                <h5 class="sub-ttl">RIWAYAT PENGOBATAN SEBELUMNYA</h5>
                                                <textarea type="text" name="fs_rwyt_obt_sebelum" id="fs_rwyt_obt_sebelum" rows="4" class="form-control">{{ old('fs_rwyt_obt_sebelum') }}</textarea>
                                            </div>
                                            <div class="card-body">
                                            </div>

                                            <div class="card-heading">
                                                <h5 class="sub-ttl">RIWAYAT ALERGI</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="p-2">
                                                    <label class="kt-radio kt-radio-outline">
                                                        <input type="radio" name="fb_rwyt_alergi" id="fb_rwyt_alergi"
                                                            value="0">Tidak
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
                                                                        id="fs_rwyt_alergi_1" class="form-control"
                                                                        onkeyup="if (this.value != '') document.getElementById('fb_alergi').checked = true;"
                                                                        value="{{ old('fs_rwyt_alergi_1') }}">
                                                                </li>
                                                                <li>
                                                                    <input type="text" name="fs_rwyt_alergi_2"
                                                                        id="fs_rwyt_alergi_2" class="form-control"
                                                                        value="{{ old('fs_rwyt_alergi_2') }}">
                                                                </li>
                                                                <li>
                                                                    <input type="text" name="fs_rwyt_alergi_3"
                                                                        id="fs_rwyt_alergi_3" class="form-control"
                                                                        value="{{ old('fs_rwyt_alergi_3') }}">
                                                                </li>
                                                                <li>
                                                                    <input type="text" name="fs_rwyt_alergi_4"
                                                                        id="fs_rwyt_alergi_4" class="form-control"
                                                                        value="{{ old('fs_rwyt_alergi_4') }}">
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
                                                                            id="fs_gcs_e" class="form-control"
                                                                            value="{{ old('fs_gcs_e') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend"><label
                                                                                for=""
                                                                                class="input-group-text">V</label>
                                                                        </span>
                                                                        <input type="text" name="fs_gcs_V"
                                                                            id="fs_gcs_V" class="form-control"
                                                                            value="{{ old('fs_gcs_V') }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="input-group">
                                                                        <span class="input-group-prepend"><label
                                                                                for=""
                                                                                class="input-group-text">M</label>
                                                                        </span>
                                                                        <input type="text" name="fs_gcs_m"
                                                                            id="fs_gcs_m" class="form-control"
                                                                            value="{{ old('fs_gcs_m') }}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row f-group">
                                                            <div class="col-lg-6 col-sm-12">
                                                                <label>Tekanan Darah:&ensp;</label>
                                                                <label class="input-group">
                                                                    <input style="width: 5em;" name="fs_td"
                                                                        id="fs_td" type="text"
                                                                        value="{{ old('fs_td') }}"
                                                                        class="form-control" />
                                                                    <span
                                                                        class="input-group-append input-group-text">mmHg</span>
                                                                </label>&emsp;
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <label>Nadi:&ensp;</label>
                                                                <label class="input-group">
                                                                    <input style="width: 6em;" name="fs_N_1"
                                                                        id="fs_N_1" type="number"
                                                                        value="{{ old('fs_N_1') }}"
                                                                        class="form-control" />
                                                                    <span
                                                                        class="input-group-append input-group-text">x/mnt</span>
                                                                </label>&emsp;
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <label>Respirasi:&ensp;</label>
                                                                <label class="input-group">
                                                                    <input style="width: 6em;" name="fs_R_1"
                                                                        id="fs_R_1" type="number"
                                                                        value="{{ old('fs_R_1') }}"
                                                                        class="form-control" />
                                                                    <span
                                                                        class="input-group-append input-group-text">x/mnt</span>
                                                                </label>&emsp;
                                                            </div>
                                                            <div class="col-lg-6 col-sm-12">
                                                                <label>Suhu:&ensp;</label>
                                                                <label class="input-group">
                                                                    <input style="width: 6em;" name="fs_S_1"
                                                                        id="fs_S_1" type="number"
                                                                        value="{{ old('fs_S_1') }}"
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
                                                                id="fs_kepala" value="Normal" />
                                                        </div>
                                                    </div>
                                                    <div class="f-group">
                                                        <label class="col-2">Leher</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="fs_leher"
                                                                id="fs_leher" value="Normal" />
                                                        </div>
                                                    </div>
                                                    <div class="f-group">
                                                        <label class="col-2">Thorax</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="fs_thorax"
                                                                id="fs_thorax" value="Normal" />
                                                        </div>
                                                    </div>
                                                    <div class="f-group">
                                                        <label class="col-2">Abdomen</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control" name="fs_abdomen"
                                                                id="fs_abdomen" value="Normal" />
                                                        </div>
                                                    </div>
                                                    <div class="f-group">
                                                        <label class="col-2">Ekstremitas</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control"
                                                                name="fs_ekstremitas" id="fs_ekstremitas"
                                                                value="Normal" />
                                                        </div>
                                                    </div>
                                                    <div class="f-group">
                                                        <label class="col-2">Genetalia</label>
                                                        <div class="col">
                                                            <input type="text" class="form-control"
                                                                name="fs_genetalia" id="fs_genetalia" value="Normal" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="card-heading">
                                                    <h5 class="sub-ttl">PEMERIKSAAN PENUNJANG</h5>
                                                    <textarea rows="3" name="fs_periksa_penunjang" id="fs_periksa_penunjang" class="form-control"></textarea>
                                                </div>

                                                <div class="card-body">
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="card-heading">
                                                    <h5 class="sub-ttl">DIAGNOSA BANDING</h5>
                                                    <textarea rows="3" name="fs_diag_banding" id="fs_diag_banding" class="form-control">{{ old('fs_diag_banding') }}</textarea>
                                                </div>

                                                <div class="card-body">
                                                </div>
                                            </div>

                                            <div class="">
                                                <div class="card-heading">
                                                    <h5 class="sub-ttl">DIAGNOSA KERJA</h5>
                                                    <textarea rows="3" name="fs_diag_kerja" id="fs_diag_kerja" class="form-control">{{ old('fs_diag_kerja') }}</textarea>
                                                </div>

                                                <div class="card-body">
                                                </div>
                                            </div>

                                            <div class="card-heading">
                                                <h5 class="sub-ttl">MASALAH MEDIS</h5>
                                                <textarea rows="4" name="fs_mslh_medis" id="fs_mslh_medis" class="form-control">{{ old('fs_mslh_medis') }}</textarea>
                                            </div>

                                            <div class="card-body">
                                            </div>
                                            <div class="card-heading">
                                                <h5 class="group-ttl">PERENCANAAN</h5>
                                                <textarea name="fs_instruksi_medis" id="fs_instruksi_medis" rows="5" class="form-control">{{ old('fs_instruksi_medis') }}</textarea>
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
                                                                                    id="fb_disposisi" value="1">
                                                                                <span></span>Dipulangkan, Kontrol Poliklinik
                                                                            </label>
                                                                        </td>
                                                                        <td><input type="text" name="fs_kontrol_klinik"
                                                                                id="fs_kontrol_klinik"
                                                                                class="form-control">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="kt-checkbox kt-checkbox-outline">
                                                                                <input type="checkbox"
                                                                                    name="fb_disposisi2"
                                                                                    id="fb_disposisi2" value="1">
                                                                                <span></span>Rujuk, Ke
                                                                            </label>
                                                                        </td>
                                                                        <td><input type="text" name="fs_rujuk"
                                                                                id="fs_rujuk" class="form-control"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="kt-checkbox kt-checkbox-outline">
                                                                                <input type="checkbox"
                                                                                    name="fb_disposisi3"
                                                                                    id="fb_disposisi3" value="1">
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
                                                                                <input type="checkbox"
                                                                                    name="fb_disposisi6"
                                                                                    id="fb_disposisi6" value="1">
                                                                                <span></span>Melarikan Diri
                                                                            </label>
                                                                        </td>
                                                                        <!-- <td><input type="text" name="fs_rawat_jalan" class="form-control"></td> -->
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <label class="kt-checkbox kt-checkbox-outline">
                                                                                <input type="checkbox"
                                                                                    name="fb_disposisi7"
                                                                                    id="fb_disposisi7" value="1">
                                                                                <span></span>Meninggal :
                                                                            </label>
                                                                        </td>
                                                                        <!-- <td><input type="text" name="fs_rawat_inap" class="form-control col-6 form-inline"></td> -->
                                                                        <!-- <td><label for="">Indikasi :</label></td> -->
                                                                        <td><input type="text" name="fs_meninggal"
                                                                                id="fs_meninggal"
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
                                                                <input type="text" name="fs_pasien" id="fs_pasien"
                                                                    class="form-control" value="{{ old('fs_pasien') }}">
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
                                                                        id="fs_klrg_pasien" class="form-control"
                                                                        alue="{{ old('fs_klrg_pasien') }}">
                                                                </div>
                                                                <div class="col f-group">
                                                                    <label for="">Paraf</label>
                                                                    <img style="width: 100px;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>Tidak dapat memeberikan edukasi kepada pasien dan keluarga,
                                                            karena :</p>
                                                        <input type="text" name="fs_tdk_dpt_edu" id="fs_tdk_dpt_edu"
                                                            class="form-control" alue="{{ old('fs_tdk_dpt_edu') }}">
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
                                                                <input type="date" name="fd_tgl_ttd" id="fd_tgl_ttd"
                                                                    class="form-control" value="{{ $dateNow }}">
                                                                <span class="input-group-append"><label
                                                                        class="input-group-text">/</label></span>
                                                                <input type="time" name="fs_jam_ttd" id="fs_jam_ttd"
                                                                    class="form-control" value="{{ $timeNow }}"
                                                                    step="1">
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
                                                                    <span
                                                                        class="input-group-append input-group-text">(</span>
                                                                    <input type="text" name="fs_dokter_assessment"
                                                                        id="fs_dokter_assessment"
                                                                        class="form-control text-center"
                                                                        value="{{ Auth::user()->name }}">
                                                                    <span
                                                                        class="input-group-append input-group-text">)</span>
                                                                </div>
                                                            </div>
                                                            <div class="btn-group pb-4 float-right"
                                                                id="divSimpanAssesment" role="group">

                                                                <button class="btn btn-primary float-right border-radius3"
                                                                    id="simpanAssesment">
                                                                    <i class="fa fa-save"></i> Save
                                                                </button>
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="">
                                <input type="hidden" id="assId" name="assId" value="{{ $ass_id }}">
                                <input type="hidden" id="tglTrs" name="tglTrs" value="{{ $dateNow }}">
                                <input type="hidden" id="jamTrs" name="jamTrs" value="{{ $timeNow }}">
                                <input type="hidden" id="kdReg" name="kdReg">
                                <input type="hidden" id="noMr" name="noMr">
                                <input type="hidden" id="pasienName" name="pasienName">
                                <input type="hidden" id="jeniskelamin" name="jeniskelamin">
                                <input type="hidden" id="dokter" name="dokter">
                                <input type="hidden" id="umur" name="umur">
                                <input type="hidden" id="layanan" name="layanan">
                            </div>
                            </form>
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

            $('#tr_kd_reg').select2({
                placeholder: 'Pilih Pasien',
            });


            // Call Hasil Search Registrasi
            $("#tr_kd_reg").on("change", function() {
                // $('#kumpulanButton').empty();
                // $('#createSOAPP').show();


                var kdReg = $('#tr_kd_reg').val();
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
                            $('#noMr').val(dataregvalue.fr_mr);
                            $('#pasienName').val(dataregvalue.fr_nama);
                            $('#jeniskelamin').val(dataregvalue.fr_jenis_kelamin);
                            $('#layanan').val(dataregvalue.fr_layanan);
                            $('#dokter').val(dataregvalue.fr_dokter);
                            $('#kdReg').val(dataregvalue.fr_kd_reg);

                            $('#namaHdr').val(dataregvalue.fr_nama);
                            $('#noMRHdr').val(dataregvalue.fr_mr);
                            $('#noRGHdr').val(dataregvalue.fr_kd_reg);
                            $('#dokterHdr').val(dataregvalue.fr_dokter);
                            $('#layananHdr').val(dataregvalue.fr_layanan);
                            $('#jkHdr').val(dataregvalue.fr_jenis_kelamin);
                            $('#alamatHdr').val(dataregvalue.fr_alamat);
                            $('#alergiHdr').val(dataregvalue.fr_alergi);
                            $('#lastTarifDsrHdr').val(dataregvalue.tcmr.fs_last_tarif_dasar);


                            // $('#chart_kd_reg').val(dataregvalue.fr_kd_reg);
                            // $('#chart_mr').val(dataregvalue.fr_mr);
                            // $('#chart_nm_pasien').val(dataregvalue.fr_nama);
                            // $('#chart_layanan').val(dataregvalue.fr_layanan);
                            // $('#chart_dokter').val(dataregvalue.fr_dokter);

                            var isDateBirthday = dataregvalue.fr_tgl_lahir;
                            var isAgeNow = getUmurDetail(isDateBirthday);
                            $('#umur').val(isAgeNow);
                            $('#umurHdr').val(isAgeNow);
                            $('#tglLahirHdr').val(isDateBirthday);

                            toastr.info('Pasein\t' + `${dataregvalue.fr_nama}` + '\tPinned!', {
                                timeOut: 700,
                                positionClass: 'toast-top-right',
                            });
                            // Get MR & save  di sessionStorage
                            var mr = {};
                            mr.Text = $("#noMRHdr").val();

                            var kdReg = {};
                            kdReg.Text = $("#noRGHdr").val();

                            // var ChartID = {};
                            // ChartID.Text = $("#chart_id").val();

                            var UserActive = {};
                            UserActive.Text = $("#userActive").val();
                            // mr.isProcessed = false;
                            sessionStorage.setItem("dataMR", JSON.stringify(mr));
                            sessionStorage.setItem("kdReg", JSON.stringify(kdReg));
                            // sessionStorage.setItem("ChartID", JSON.stringify(ChartID));
                            sessionStorage.setItem("UserActive", JSON.stringify(UserActive));

                            var allInputtextarea = document.querySelectorAll("textarea");
                            var allInputText = document.querySelectorAll(
                                "input[type=text],input[type=number],input[type=radio],input[type=checkbox]"
                            );
                            $(allInputtextarea).prop('disabled', false);
                            $(allInputText).prop('disabled', false);

                            $('#simpanAssesment').prop('disabled', false)
                            $('#updateAssesment').remove()
                        })

                        getLabelPasien()
                    }
                })
            });

            function editAssEnable() {
                var allInputtextarea = document.querySelectorAll("textarea");
                var allInputText = document.querySelectorAll(
                    "input[type=text],input[type=number],input[type=radio],input[type=checkbox]"
                );
                $(allInputtextarea).prop('disabled', false);
                $(allInputText).prop('disabled', false);
            }

            function editAssDisable() {
                var allInputtextarea = document.querySelectorAll("textarea");
                var allInputText = document.querySelectorAll(
                    "input[type=text],input[type=number],input[type=radio],input[type=checkbox]"
                );
                $(allInputtextarea).prop('disabled', true);
                $(allInputText).prop('disabled', true);
            }

            getLabelPasien()

            function getLabelPasien() {
                var data = sessionStorage.getItem("dataMR");
                var noMr;

                if (data != null) {
                    noMr = JSON.parse(data);
                }
                $('.showListLabelAss').empty();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getLabelAssHdr') }}/" + noMr,
                    type: 'GET',
                    data: {
                        'noMr': noMr
                    },
                    success: function(isRegSearch) {
                        $.each(isRegSearch, function(key, datarmvalue) {
                            // $('.showListLabelAss').empty();
                            var dateFormat = datarmvalue.tglTrs
                            var dateView = moment(dateFormat).format(
                                "D MMMM YYYY");
                            $('.showListLabelAss').append(
                                `<a href="#" class="nav-link" onclick="showContent(this)" data-assid="${datarmvalue.assId}">
                                    <div class="" id="labelAssHdr">
                                        <i class="fas fa-archive"></i> &nbsp; <span>${dateView + '\n-\n' + datarmvalue.jamTrs + '\n-\n' + datarmvalue.assLabel +'\n-\n' + datarmvalue.layanan + '\n-\n' + datarmvalue.user}</span>
                                    </div>
                                </a>`
                            )
                            // $('#labelAssHdr span').text(datarmvalue.tglTrs + '-' + datarmvalue.assLabel +
                            //     '-' + datarmvalue.assLabel);
                        })
                    }
                })
            }

            function showContent(r) {
                var assId = $(r).data('assid');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getAssDetail') }}/" + assId,
                    type: 'GET',
                    data: {
                        'AssId': assId
                    },
                    success: function(isAssDetail) {
                        $.each(isAssDetail, function(key, datavalue) {
                            $('#fs_keluhan_utama').val(datavalue.fs_keluhan_utama);
                            $('#fs_anamnesis').val(datavalue.fs_anamnesis);
                            $('#fs_rwyt_penyakit').val(datavalue.fs_rwyt_penyakit);
                            $('#fs_rwyt_skt_klrg').val(datavalue.fs_rwyt_skt_klrg);
                            $('#fs_rwyt_obt_sebelum').val(datavalue.fs_rwyt_obt_sebelum);

                            $('#fb_rwyt_alergi').val(datavalue.fb_rwyt_alergi);
                            $('#fs_rwyt_alergi_1').val(datavalue.fs_rwyt_alergi_1);
                            $('#fs_rwyt_alergi_2').val(datavalue.fs_rwyt_alergi_2);
                            $('#fs_rwyt_alergi_3').val(datavalue.fs_rwyt_alergi_3);
                            $('#fs_rwyt_alergi_4').val(datavalue.fs_rwyt_alergi_4);

                            $('#fs_gcs_e').val(datavalue.fs_gcs_e);
                            $('#fs_gcs_V').val(datavalue.fs_gcs_V);
                            $('#fs_gcs_m').val(datavalue.fs_gcs_m);
                            $('#fs_td').val(datavalue.fs_td);
                            $('#fs_N_1').val(datavalue.fs_N_1);
                            $('#fs_R_1').val(datavalue.fs_R_1);
                            $('#fs_S_1').val(datavalue.fs_S_1);

                            $('#fs_kepala').val(datavalue.fs_kepala);
                            $('#fs_leher').val(datavalue.fs_leher);
                            $('#fs_thorax').val(datavalue.fs_thorax);
                            $('#fs_abdomen').val(datavalue.fs_abdomen);
                            $('#fs_ekstremitas').val(datavalue.fs_ekstremitas);
                            $('#fs_genetalia').val(datavalue.fs_genetalia);

                            $('#fs_periksa_penunjang').val(datavalue.fs_periksa_penunjang);
                            $('#fs_diag_banding').val(datavalue.fs_diag_banding);
                            $('#fs_diag_kerja').val(datavalue.fs_diag_kerja);
                            $('#fs_mslh_medis').val(datavalue.fs_mslh_medis);
                            $('#fs_instruksi_medis').val(datavalue.fs_instruksi_medis);

                            $('#fb_disposisi').val(datavalue.fb_disposisi);
                            $('#fb_disposisi2').val(datavalue.fb_disposisi2);
                            $('#fb_disposisi3').val(datavalue.fb_disposisi3);
                            $('#fb_disposisi6').val(datavalue.fb_disposisi6);
                            $('#fb_disposisi7').val(datavalue.fb_disposisi7);
                            $('#fs_kontrol_klinik').val(datavalue.fs_kontrol_klinik);
                            $('#fs_rujuk').val(datavalue.fs_rujuk);
                            $('#fs_meninggal').val(datavalue.fs_meninggal);

                            $('#fs_pasien').val(datavalue.fs_pasien);
                            $('#fs_klrg_pasien').val(datavalue.fs_klrg_pasien);
                            $('#fs_tdk_dpt_edu').val(datavalue.fs_tdk_dpt_edu);

                            $('#fd_tgl_ttd').val(datavalue.fd_tgl_ttd);
                            $('#fs_jam_ttd').val(datavalue.fs_jam_ttd);
                            $('#fs_dokter_assessment').val(datavalue.fs_dokter_assessment);

                            $('#simpanAssesment').prop('disabled', true)
                            $('#updateAssesment').remove()

                            var getSessionUser = '{{ Auth::user()->name }}';

                            if (getSessionUser == datavalue.fs_dokter_assessment) {
                                $('#divSimpanAssesment').append(
                                    `<button class="btn btn-success float-right border-radius3"
                                        id="updateAssesment">
                                        <i class="fa fa-save"></i> Update
                                    </button>`
                                )
                            }
                            var allInputtextarea = document.querySelectorAll("textarea");
                            var allInputText = document.querySelectorAll(
                                "input[type=text],input[type=number],input[type=radio],input[type=checkbox]"
                            );
                            $(allInputtextarea).prop('disabled', true);
                            $(allInputText).prop('disabled', true);
                        })
                    }
                })
            }

            getHeaderInfo();

            function getHeaderInfo() {
                var data = sessionStorage.getItem("kdReg");
                var kdReg;

                if (data != null) {
                    kdReg = JSON.parse(data);
                }
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
                            // $('#tr_jenis_kelamin').val(dataregvalue
                            //     .fr_jenis_kelamin);
                            // $('#tr_layanan').val(dataregvalue.fr_layanan);
                            // $('#tr_dokter').val(dataregvalue.fr_dokter);
                            // $('#tr_alamat').val(dataregvalue.fr_alamat);
                            // $('#tr_tgl_lahir').val(dataregvalue.fr_tgl_lahir);

                            $('#namaHdr').val(dataregvalue.fr_nama);
                            $('#noMRHdr').val(dataregvalue.fr_mr);
                            $('#noRGHdr').val(dataregvalue.fr_kd_reg);
                            $('#dokterHdr').val(dataregvalue.fr_dokter);
                            $('#layananHdr').val(dataregvalue.fr_layanan);
                            $('#jkHdr').val(dataregvalue.fr_jenis_kelamin);
                            $('#alamatHdr').val(dataregvalue.fr_alamat);
                            $('#alergiHdr').val(dataregvalue.fr_alergi);
                            $('#lastTarifDsrHdr').val(dataregvalue.tcmr
                                .fs_last_tarif_dasar);

                            $('#chart_kd_reg').val(dataregvalue.fr_kd_reg);
                            $('#chart_mr').val(dataregvalue.fr_mr);
                            $('#chart_nm_pasien').val(dataregvalue.fr_nama);
                            $('#chart_layanan').val(dataregvalue.fr_layanan);
                            $('#chart_dokter').val(dataregvalue.fr_dokter);

                            var isDateBirthday = dataregvalue.fr_tgl_lahir;
                            var isAgeNow = getUmurDetail(isDateBirthday);
                            $('#tr_umur').val(isAgeNow);
                            $('#umurHdr').val(isAgeNow);
                            $('#tglLahirHdr').val(isDateBirthday);

                        })
                    }
                })
            }

            // getLabelAssHdr();

            function getLabelAssHdr() {
                var data = sessionStorage.getItem("dataMR");
                var noMr;

                if (data != null) {
                    noMr = JSON.parse(data);
                }
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getLabelAssHdr') }}/" + noMr,
                    type: 'GET',
                    data: {
                        'noMr': noMr
                    },
                    success: function(isRegSearch) {
                        $.each(isRegSearch, function(key, datarmvalue) {
                            var dateFormat = datarmvalue.tglTrs
                            var dateView = moment(dateFormat).format(
                                "dddd, D MMMM YYYY");
                            $('.showListLabelAss').append(
                                `<a href="#" class="nav-link" onclick="showContent(this)" data-assid="${datarmvalue.assId}">
                                    <div class="" id="labelAssHdr">
                                        <i class="fas fa-inbox"></i> &nbsp; <span>${dateView + '\n-\n' + datarmvalue.jamTrs + '\n-\n' + datarmvalue.assLabel +'\n-\n' + datarmvalue.layanan}</span>
                                    </div>
                                </a>`
                            )
                            // $('#labelAssHdr span').text(datarmvalue.tglTrs + '-' + datarmvalue.assLabel +
                            //     '-' + datarmvalue.assLabel);
                        })
                    }
                })
            }


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

            // Get Data setelah reload

            $(".btn").tooltip({
                container: 'body'
            });
        </script>
    @endpush
