@extends('Pages.master')

@section('konten')
    <style>
        .splitRight {
            right: 0%;
            height: 100%;
            width: 43%;
            position: absolute;
            z-index: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 95px;
            padding-bottom: 45px;
        }

        .splitLeft {
            left: auto;
            right: auto;
            /* height: 100%; */
            width: auto;
            /* position: absolute; */
            z-index: 0;
            top: 0;
            overflow-x: hidden;
            padding-top: 0px;
            padding-bottom: 45px;
        }

        @media (min-width: 576px) {
            #Right {
                position: fixed;
                width: 50%;
                max-width: 44%;
                top: 0;
                bottom: 0;
                right: 0;
                left: unset;
            }
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>


    <section class="splitRight col-lg content" id="Right">
        <div class="card">
            <div class="card-body">

                <div class="col-12">
                    {{-- <div name="headerPinPasien" class="kt-header__topbar pr-2 headerTopBar">
                        <div class="kt-header__topbar-item kt-header__topbar-item--user mx-0">
                            <div class="kt-header__topbar-wrapper"> --}}
                    {{-- <div class="kt-header__topbar-user-pasien-info" style="background: transparent !important;"> --}}
                    <div class="accordion m-1 form-inline accordion-toggle-arrow text-light" id="DetailPasien"
                        style="position:relative; margin-right:0px; z-index:500;">
                        <!-- min-width:300px; max-width:500px -->
                        <div class="card" style="border:none; margin-right:0px; margin-top: 1px;">
                            <!-- min-width:300px;  -->
                            <div class="form-control card-header row" name="PasienHdr" style="background-color:#a07ccf">
                                <span data-toggle="tooltip" title="Clear" class="text-center">
                                    <div class="kt-link pointer text-danger ml-2" name="clearPinnedPasienHdr"
                                        style="margin-top: 7px; display: none;">
                                        <i class="fa fa-times-circle clearPinPsnHdr"></i>
                                    </div>
                                </span>
                                <div class="text-light collapsed pointer" id="collapseCoverPasien" data-toggle="collapse"
                                    data-target="#DetPsn" aria-expanded="false" aria-controls="DetPsn"
                                    style="background-color:#a07ccf; border: none;">
                                    {{-- style="justify-content: space-between; padding: 6px 13px 7px 0px"> --}}
                                    <label style="width: 2vw;overflow: hidden;text-overflow: " name="nmPasienHdr"
                                        id="nmPasienHdr" class="text-warning pointer">
                                        <i class="fa fa-user mb-3"></i>
                                    </label>
                                    {{-- <input type="text" class="form-control text-light" name="" id="nmPasienHdr"
                                        style="background-color:#6c558a; border: none; width: 17vw;"> --}}
                                    {{-- <span id="1MonthUp" name="1MonthUp" class="badge badge-warning kt-font-bold"
                                        style="border-radius: 3px;padding: 2px 5px;margin-right: 10px; display: none;"
                                        title="Terakhir periksa"></span>
                                    <strong>
                                        <label name="noMrHdr" class="pointer mr-2">00-00-00-00</label>
                                    </strong>
                                    <label
                                        style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;background: #ed2121; font-size: 0.9rem; display: none;"
                                        name="tagAlergiProfile" class="text-white pointer mx-1 kt-font-normal px-2">
                                        Allergy
                                    </label>
                                    <label
                                        style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap; font-size: 0.9rem; display: none;"
                                        name="tagTriageProfile" class="pointer mx-1 kt-font-normal px-2">
                                        Triage
                                    </label> --}}
                                </div>

                                {{-- <div name="divIcare" style="display: none;">
                                    <button type="button" class="btn btn-icare border-radius2" name="btnICare"
                                        title="I Care JKN"></button>
                                </div> --}}
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
                                                <div class="text-center px-2 py-1 m-1 rounded rounded-sm" title=""
                                                    style="background-color:#f8d6e2;" name="">
                                                    <b>Layanan :</b><input type="text" class="form-control-xs"
                                                        name="" id="layananHdr"
                                                        style="background-color: #f8d6e2; border:none">
                                                </div>
                                                <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                    style="background-color:#f8d6e2;" name="">
                                                    <b>J/K :</b><input type="text" class="form-control-xs" name=""
                                                        id="jkHdr" style="background-color:#f8d6e2; border:none">
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
                                                <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                    style="background-color:#f8d6e2; border:none" name="alergiHdr"
                                                    id="">
                                                    <b>Alergi :</b><input type="text" class="form-control-xs"
                                                        name="" id="alergiHdr"
                                                        style="background-color:#f8d6e2; border:none">
                                                </div>
                                                <div class="text-center px-2 py-1 m-1 rounded rounded-sm"
                                                    style="background-color:#f8d6e2; border:none" name="lastTarifDsrHdr"
                                                    id="">
                                                    <b>Last tarif Dasar :</b><input type="text" class="form-control-xs"
                                                        name="" id="lastTarifDsrHdr"
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
                                                <input type="text" class="form-control-xs col-8" name=""
                                                    id="alamatHdr" style="background-color:#d6f8dd; border:none">
                                            </div>
                                            {{-- </div> --}}
                                        </div>
                                        {{-- <table style="width:100%">
                                            <tbody>
                                                <tr>
                                                    <td style="vertical-align: top;"
                                                        class="kt-font-danger kt-font-boldest">
                                                        #Allergy
                                                    </td>
                                                    <td style="vertical-align: top;">:</td>
                                                    <td class="pl-2">
                                                        <div class="dropdown" name="divAddAlergiProfile">
                                                            <button
                                                                class="btn btn-sm btn-default border-radius3 kt-font-bolder pull-right p-1 dropdown-toggle"
                                                                style="position: absolute; right: -10px;"
                                                                title="Tambah Alergi" id="ddAddAlergiProfileHD"
                                                                data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false" type="button">
                                                                <i class="fa fa-plus-circle icon-smass"></i>Add
                                                            </button>
                                                            <div class="dropdown-menu p-2"
                                                                aria-labelledby="ddAddAlergiProfileHD"
                                                                x-placement="bottom-start">
                                                                <h6 class="kt-font-primary mb-3">Add Alergi
                                                                    Pasien</h6>
                                                                <div class="row">
                                                                    <select class="form-control form-control-sm col mb-2"
                                                                        id="listAlergiTypeProfileHD">
                                                                    </select>
                                                                </div>
                                                                <div class="row">
                                                                    <input type="text" id="alergiNameProfileHD"
                                                                        class="form-control form-control-sm col mb-2"
                                                                        autocomplete="off" placeholder="Nama Alergi">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-12 p-0">
                                                                        <button
                                                                            class="btn btn-sm btn-primary border-radius3 kt-font-bolder pull-right p-1"
                                                                            id="addAlergiProfileHD" type="button">
                                                                            <i class="fa fa-save icon-smass"></i>Save
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div name="listAlergiProfile"></div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top;"
                                                        class="kt-font-danger kt-font-boldest">#Vital Sign
                                                    </td>
                                                    <td style="vertical-align: top;">:</td>
                                                    <td class="pl-2">
                                                        <div class="col-12 p-0" style="max-width: 300px;">
                                                            <div class="row" name="listVitalSignProfile">

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="vertical-align: top;"
                                                        class="kt-font-danger kt-font-boldest">#Diagnosis
                                                    </td>
                                                    <td class="pl-2">
                                                        <div class="col-12 p-0" style="max-width: 300px;">
                                                            <div class="row pl-2 scroll-y scrollbar-dusty thin scrollbox"
                                                                name="listDiagnosisProfile" style="max-height: 250px;">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td style="color:red">#allergi</td>
                                                    <td colspan="2"><label name="alergiHdr"
                                                            style="color: red;"></label>
                                                    </td>
                                                </tr>
                                                <tr style="display: none;">
                                                    <td>#vital-sign</td>
                                                    <td colspan="2"><label name="vitalSignHdr"></label>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table> --}}
                                        <div class="col-12 p-0 hide">
                                            {{-- <div class="row pl-2 scroll-y scrollbar-dusty thin border px-3 pt-2 scrollbox"
                                                name="listDiagnosaProfile" style="max-height: 250px;">
                                            </div> --}}
                                        </div>
                                        {{-- <div class="row" id="divQR" style="display: none;">
                                            <div class="col-12 text-center">
                                                <div id="qrcode" style="padding-left: 27%;" class="mt-2"></div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="progress" style="height: 2px;">
                                        <div class="progress-bar kt-bg-info" id="progressLoadImageQR" role="progressbar"
                                            style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div> --}}
                                </div>
                                {{-- <button type="button" class="btn btn-secondary mr-0 col p-0"
                                                    name="closeDetPsnHdr" aria-label="Close" title="collapse">
                                                    <i class="fa fa-chevron-circle-up fa-lg text-brand mb-1 fa-sm"></i>
                                                </button> --}}
                            </div>
                        </div>
                        {{-- <div class="form-group col-sm-6">
                            <label for="">Search Registrasi</label>
                            <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;" name="tr_kd_reg">
                                @foreach ($isRegActive as $reg)
                                    <option value="">--Select--</option>
                                    <option value="{{ $reg->fr_kd_reg }}">
                                        {{ $reg->fr_kd_reg . '-' . $reg->fr_nama }}
                                    </option>
                                @endforeach
                            </select> --}}
                    </div>
                </div>
                {{-- </div> --}}

                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                <div class="col">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="">Search Registrasi</label>
                            <select class="form-control-pasien" id="tr_kd_reg" style="width: 100%;" name="tr_kd_reg">
                                @foreach ($isRegActive as $reg)
                                    <option value="">--Select--</option>
                                    <option value="{{ $reg->fr_kd_reg }}">
                                        {{ $reg->fr_kd_reg . '-' . $reg->fr_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" name="tr_tgl_trs" id="tr_tgl_trs"
                                value="{{ $dateNow }}" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Nomor RM</label> --}}
                            <input type="hidden" class="form-control" name="tr_no_mr" id="tr_no_mr" value=""
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Nama Pasien</label> --}}
                            <input type="hidden" class="form-control" name="tr_nm_pasien" id="tr_nm_pasien"
                                value="" readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Layanan</label> --}}
                            <input type="hidden" class="form-control" name="tr_layanan" id="tr_layanan" value=""
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Dokter</label> --}}
                            <input type="hidden" class="form-control" name="tr_dokter" id="tr_dokter" value=""
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Umur</label> --}}
                            <input type="hidden" class="form-control" name="tr_umur" id="tr_umur" value=""
                                readonly>
                        </div>
                        <div class="form-group col-sm-6">
                            {{-- <label for="">Alamat</label> --}}
                            {{-- <textarea type="hidden" class="form-control" name="tr_alamat" id="tr_alamat" value="" readonly></textarea> --}}
                            <input type="hidden" class="form-control" name="tr_alamat" id="tr_alamat" value="">
                        </div>

                        <input type="hidden" id="tr_tgl_lahir" name="tr_tgl_lahir">
                        <input type="hidden" id="user" name="user" value="tes">
                    </div>
                </div>
                {{-- <input type="text" id="chart_id_show" name="chart_id" value=""> --}}

                {{-- <div class="float-right">
                    <button class="btn btn-success" data-toggle="modal" data-target="#TambahSOAP"><i class="fa fa-plus"></i>
                        SOAP</button>
                </div> --}}
                {{-- <div class="card-body"> --}}
                <form action="{{ url('chartCreate') }}" method="post" id="CHCreate">
                    <div class="row">
                        <div class="col">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Form SOAP
                                    </h3>
                                </div>
                                {{-- Hidden value --}}
                                @csrf
                                <div class="card-body">
                                    <input type="hidden" id="chart_id" name="chart_id" value="{{ $isLastChartID }}">
                                    <input type="hidden" id="chart_kd_reg" name="chart_kd_reg" value="">
                                    <input type="hidden" id="chart_tgl_trs" name="chart_tgl_trs"
                                        value="{{ $dateNow }}">
                                    <input type="hidden" id="chart_mr" name="chart_mr" value="">
                                    <input type="hidden" id="chart_nm_pasien" name="chart_nm_pasien" value="">
                                    <input type="hidden" id="chart_layanan" name="chart_layanan" value="">
                                    <input type="hidden" id="chart_dokter" name="chart_dokter" value="">
                                    <input type="hidden" id="userActive" name="user"
                                        value="{{ Auth::user()->name }}">
                                    {{-- Hidden value --}}
                                    <div class="form-group">
                                        <label for="inputDescription">Subjective</label>
                                        {{-- <input class="form-control" style="border: none" id="keluhanutama"> --}}
                                        <textarea id="chart_S" name="chart_S" class="ta_Chart_S form-control" rows="4"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="s_head">
                                            <div class="btn-group float-right btn-group-xs template-hide" role="group"
                                                aria-label="Button group with nested dropdown">
                                                <button type="button"
                                                    class="btn btn-xs btn-primary mb-1 show-count badge-top-right"
                                                    data-toggle="collapse" data-target="#collapseVitalSign"
                                                    aria-expanded="true" aria-controls="collapseVitalSign"
                                                    data-namainput="attachment-o" data-count="0" id="btnVitalSign">
                                                    Vital Sign
                                                </button>
                                                <!--span class="badge badge-pill badge-success b_pos" style="color:white;">11</span-->
                                            </div>
                                        </div>
                                        <label for="inputDescription">Objective</label>
                                        {{-- VITAL SIGN --}}
                                        <div id="collapseVitalSign" class="bg-light border collapse show"
                                            aria-labelledby="headerVitalSign" data-parent="#btnVitalSign" style="">
                                            <div class="row py-2" id="inputMonitoringMC">
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Body Weight</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadBW"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyBW"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessBW"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_BW" name="ttv_BW"
                                                                data-satuan="kg" data-monitorname="Body Weight"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">kg</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Body Height</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadBH"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyBH"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessBH"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_BH" name="ttv_BH"
                                                                data-satuan="cm" data-monitorname="Body Height"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">cm</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Blood Pressure Sistole</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadBP"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyBP"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessBP"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_BPs" name="ttv_BPs"
                                                                data-satuan="mmHg"
                                                                data-monitorname="Blood Pressure Sistole"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">mmHg</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Blood Pressure Diastole</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadBPd"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyBPd"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessBPd"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_BPd" name="ttv_BPd"
                                                                data-satuan="mmHg"
                                                                data-monitorname="Blood Pressure Diastole"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">mmHg</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Body Temperatur</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadBT"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyBT"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessBT"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_BT" name="ttv_BT"
                                                                data-satuan="°C" data-monitorname="Body Temperatur"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">°C</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Heart Rate</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadHR"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyHR"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessHR"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_HR" name="ttv_HR"
                                                                data-satuan="x/mnt" data-monitorname="Heart Rate"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">x/mnt</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Respiratory Rate</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadRR"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptyRR"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessRR"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_RR" name="ttv_RR"
                                                                data-satuan="x/mnt" data-monitorname="Respiratory Rate"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">x/mnt</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">Skala Nyeri NRS</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadSN"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptySN"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessSN"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_SN" name="ttv_SN"
                                                                data-satuan="" data-monitorname="Skala Nyeri NRS"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" max="10" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center"></span>
                                                        </div>
                                                        <div class="invalid-feedback" id="invFeedbackSkalaNyeri">maksimal
                                                            skala 10 !</div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                    <i class="mb-1">SpO2</i>
                                                    <div class="input-group input-group-sm mb-3">
                                                        <div class="invalid-feedback" id="feedbackLoadSP"
                                                            style="display: none;">load restricted, data &gt; 2 jam yang
                                                            lalu !
                                                        </div>
                                                        <div class="invalid-feedback" id="feedbackLoadEmptySP"
                                                            style="display: none;">data not found !</div>
                                                        <div class="valid-feedback text-info" id="feedbackLoadSuccessSP"
                                                            style="display: none;">load success</div>
                                                        <div class="input-group-append input-group-sm">
                                                            <input type="number" id="ttv_SPO2" name="ttv_SPO2"
                                                                data-satuan="%" data-monitorname="SpO2"
                                                                class="form-control form-control-sm vital-sign"
                                                                min="0" value="">
                                                            <span class="input-group-text"
                                                                style="width:7em; text-align:center">%</span>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="modal-footer p-2">
                                                <div class="col">
                                                    <div class="btn-group pull-left">
                                                        <button type="button"
                                                            class="btn btn-sm btn-warning border-radius3"
                                                            id="loadFromMonitoring">Load</button>
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-icon-only" id="hidePanelVitalSign"
                                                    title="hide vital sign">
                                                    <i class="fa fa-chevron-circle-up"></i>
                                                </button>
                                                <button style="border-radius: 3px; width: 7em; display: none;"
                                                    class="btn btn-sm btn-success" id="saveMonitor">Save</button>
                                            </div> --}}
                                        </div>
                                        {{-- END VITAL SIGN --}}

                                        <textarea id="chart_O" name="chart_O" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Assesment</label>
                                        <select class="chart_A_diagnosa form-control mb-3" style="width: 100%;"
                                            name="chart_A_diagnosa" id="chart_A_diagnosa" onkeyup="getICDX()">
                                            {{-- <option value="">--Select--</option> --}}
                                        </select>
                                        <textarea id="chart_A" name="chart_A" class="form-control mt-3 mb-2" rows="4"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Plan</label>
                                        <div class="float-right mb-1">
                                            <button type="button" id="addTindakann"
                                                class="btn btn-xs btn-warning floar-right text-white" data-toggle="modal"
                                                data-target="#addTindakans">Tindakan</button>
                                            <button type="button" class="btn btn-xs btn-info floar-right"
                                                data-toggle="modal" data-target="#addResep">Resep</button>
                                        </div>
                                        <textarea id="chart_P" name="chart_P" class="form-control" rows="4"></textarea>
                                    </div>
                                    <div class="showOrHideTdk"></div>

                                    <input type="hidden" id="user" name="user_create" value="tes">
                                </div>
                            </div>
                            <div class="modal-footer" id="">
                                <div class="" id="kumpulanButton"></div>
                                {{-- <button type="button" class="btn btn-primary float-rights">Update</button> --}}
                                <button id="createSOAPP" class="btn btn-success float-rights"><i class="fa fa-save"></i>
                                    &nbsp;
                                    Save</button>
                                {{-- </div> --}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </section>


    {{-- ===============ADD TINDAKAN MODAL================= --}}
    <div class="modal fade" id="addTindakans">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tindakan</h4>
                    <button type="button" class="close" id="CloseModalTindakan" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        {{-- <div class="">
                            <label for="">Tarif Dasar</label>
                            <select class="nm_tarif_dasar form-control" style="width:100%;" name="nm_tarif_dasar"
                                id="nm_tarif_dasar">
                                <option value="">--Select--</option>
                                <option value="20000">Tarif 1 - Rp.20.000</option>
                                <option value="30000">Tarif 2 - Rp.30.000</option>
                                <option value="40000">Tarif 3 - Rp.40.000</option>
                                <option value="50000">Tarif 4 - Rp.50.000</option>
                                <option value="60000">Tarif 5 - Rp.60.000</option>
                            </select>
                        </div> --}}
                        {{-- <div class="float-right mb-1 mt-4">
                            <button type="button" class="nm_tarif_add btn btn-xs btn-primary float-right">add more
                            </button>
                        </div> --}}
                        <div class="mt-4">
                            {{-- <table class="table table-bordered">
                                <tbody id="nm_tarif_plus">
                                    <tr>
                                        <td> --}}
                            <label for="">Tarif/Tindakan Tambahan</label>
                            <select class="nm_tarif form-control" multiple style="width:100%;" id="nm_tarif"
                                name="nm_tarif[]">
                                {{-- <option value="" selected></option> --}}
                                <option value=""></option>
                                @foreach ($isTindakanTarif as $t)
                                    <option value="{{ $t->id }}">{{ $t->nm_tindakan }}</option>
                                @endforeach
                            </select>
                            {{-- </td>
                                    </tr>
                                </tbody>
                            </table> --}}
                            {{-- <div class="">
                                <input type="text" name="" id="nm_tarifXXXX">
                            </div> --}}
                        </div>
                    </div>
                    <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}">
                    <input type="hidden" id="sub_total" name="sub_total" value="0">
                    <div class="float-right mt-2">
                        <a type="button" id="exitModal" onclick="exitModalTindakan()" class="btn btn-success">add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ========================END MODAL ADD TINDAKANs============================= --}}

    {{-- ===============ADD RESEP MODAL================= --}}
    <div class="modal fade" id="addResep">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Resep</h4>
                    <button type="button" class="close" id="CloseModalResep" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if (Auth::user()->id == 1)
                            <div class="">
                                <div class="callout callout-danger bg-light">
                                    <label for="">Tarif Dasar</label>
                                    <input type="number" class="form-control" name="nm_tarif_dasar"
                                        id="nm_tarif_dasar">
                                    {{-- <select class="nm_tarif_dasar form-control" style="width:100%;" name="nm_tarif_dasar"
                                        id="nm_tarif_dasar">
                                        <option value="">--Select--</option>
                                        <option value="20000">Tarif 1 - Rp.20.000</option>
                                        <option value="30000">Tarif 2 - Rp.30.000</option>
                                        <option value="40000">Tarif 3 - Rp.40.000</option>
                                        <option value="50000">Tarif 4 - Rp.50.000</option>
                                        <option value="60000">Tarif 5 - Rp.60.000</option>
                                    </select> --}}
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="nm_tarif_dasar" id="nm_tarif_dasar" value="0">
                        @endif
                        <div class="">
                            <div class="callout callout-success bg-light">
                                <table>
                                    <thead>
                                        <tr>
                                            <th width="370px">Obat</th>
                                            <th width="90px">Qty</th>
                                            <th width="150px">Satuan</th>
                                            <th width="200px">Signa</th>
                                            <th width="230px">Cara Pakai</th>
                                        </tr>
                                    </thead>
                                    <tbody id="TESCHCreate">
                                        <tr>
                                            <td>
                                                <select type="text" class="obatResep form-control" id="obatResep"
                                                    style="width: 100%" onchange="pasteTo()"></select>
                                            </td>
                                            <input type="hidden" id="namaObatResep">
                                            <td>
                                                <input type="text" class="form-control" id="qty_obat">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="satuan_jual_obat"
                                                    readonly>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="signa_resep">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" id="cara_pakai_resep">
                                            </td>
                                            <input type="hidden" class="ch_hrg_jual" id="ch_hrg_jual">
                                            <td>
                                                <a class="btn btn-success btn-sm ml-2" id="addItemObatResepp"><i
                                                        class="fa fa-plus"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="resepID callout callout-warning mt-5">

                        </div>
                        {{-- <div class="float-right mb-1 mt-4">
                            <button type="button" class="nm_tarif_add btn btn-xs btn-primary float-right">add more
                            </button>
                        </div> --}}
                    </div>
                    {{-- <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}"> --}}
                    {{-- <input type="hidden" id="sub_total" name="sub_total" value="0"> --}}
                    <div class="float-right mt-2">
                        <a type="button" id="exitModalResep" onclick="exitModalResep()" class="btn btn-success">add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- ========================END MODAL ADD RESEP============================= --}}


    <div class="splitLeft col-sm-7 col-lg-6 col-xs-sm-6 row">
        <div class="col" id="accordion">
            <div class="card card-primary">
                <a class="" data-toggle="" href="#">
                    <div class="card-header">
                        <h4 class="card-title">
                            History Pemeriksaan
                        </h4>
                        <div class="form-group float-right">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1">Timeline</label>
                            </div>
                        </div>
                    </div>
                </a>
                <div id="" class="isTimeline collapse show bg-light" data-parent="#accordion">
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@push('scripts')
    <script>
        $('input:checkbox').change(
            function() {
                if ($(this).is(':checked')) {
                    $(".isTimeline").hide();

                } else {
                    $(".isTimeline").show();
                }
            });
        // Ajax Search Registrasi
        $('#tr_kd_reg').select2({
            placeholder: 'Search Registrasi',
        });

        $('.nm_tarif').select2({
            placeholder: 'Search Tindakan',
        });

        function exitModalTindakan() {
            $('#CloseModalTindakan').click()
        }

        function exitModalResep() {
            $('#CloseModalResep').click()
        }

        // $("#addTindakans").on('hide.bs.modal', function() {

        // });

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
        $("#tr_kd_reg").on("change", function() {
            $('#kumpulanButton').empty();
            $('#createSOAPP').show();

            toastr.info('Pasein Pinned!', {
                timeOut: 600,
                // preventDuplicates: true,
                positionClass: 'toast-top-right',
            });
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
                        $('#tr_no_mr').val(dataregvalue.fr_mr);
                        $('#tr_nm_pasien').val(dataregvalue.fr_nama);
                        $('#tr_jenis_kelamin').val(dataregvalue.fr_jenis_kelamin);
                        $('#tr_layanan').val(dataregvalue.fr_layanan);
                        $('#tr_dokter').val(dataregvalue.fr_dokter);
                        $('#tr_alamat').val(dataregvalue.fr_alamat);
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
                        $('.ta_Chart_S').val(dataregvalue.keluhan_utama);

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


                        getTimeline();
                        // getTimelineTindakan();
                        // $(".isTimeline").empty();

                    })
                }
            })
        });

        function getHeaderInfo() {
            var data = sessionStorage.getItem("kdReg");
            var kdReg;
            // const cekTindakan = getVal.nm_tarif;


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
                        $('#tr_no_mr').val(dataregvalue.fr_mr);
                        $('#tr_nm_pasien').val(dataregvalue.fr_nama);
                        $('#tr_jenis_kelamin').val(dataregvalue.fr_jenis_kelamin);
                        $('#tr_layanan').val(dataregvalue.fr_layanan);
                        $('#tr_dokter').val(dataregvalue.fr_dokter);
                        $('#tr_alamat').val(dataregvalue.fr_alamat);
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

                        var isDateBirthday = dataregvalue.fr_tgl_lahir;
                        var isAgeNow = getUmurDetail(isDateBirthday);
                        $('#tr_umur').val(isAgeNow);
                        $('#umurHdr').val(isAgeNow);
                        $('#tglLahirHdr').val(isDateBirthday);

                    })
                }
            })
        }

        // function getICDX() {
        var path = "{{ route('getIcdX') }}";

        $('#chart_A_diagnosa').select2({
            placeholder: 'Search Diagnosa',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 100,
                processResults: function(isICDX) {
                    return {
                        results: $.map(isICDX, function(xicd) {
                            return {
                                // text: item.fs_mr,
                                text: xicd.code + ' - ' + xicd.name_id,
                                id: xicd.code + '-' + xicd.name_id,
                            }
                        })
                    };
                },
                cache: true
            }
        });
        // }

        $(".nm_tarif_add").on("click", function() {

            var tindakanSelect = $('#nm_tarif').val();

            $("#nm_tarif_plus").append(
                `<tr> 
                <td> 
                <input class="nm_tarif form-control" style="width:100%;" name="nm_tarif[]" readonly value="${tindakanSelect}">
                <a href="javascript:void(0)" class="rmvItm text-danger"><i class="fa fa-trash"></i></a>' 
                </td>
                </tr>`
            );

            $("#CHCreate").append(
                '<tr>' +
                '<td>' +
                '<select class="nm_tarif form-control" style="width:100%;" name="nm_tarif[]">' +
                '<option value="">--Select--</option>' +
                '@foreach ($isTindakanTarif as $t)' +
                '<option value="{{ $t->nm_tindakan }}">{{ $t->nm_tindakan }}</option>' +
                ' @endforeach' +
                '</select>' +
                '<a href="javascript:void(0)" class="rmvItm text-danger"><i class="fa fa-trash"></i></a>' +
                '</td>' +
                '</tr>'
            );

        });


        // Obat Search
        var path = "{{ route('obatSearchCH') }}";

        $('.obatResep').select2({
            placeholder: 'Search Obat',
            ajax: {
                url: path,
                dataType: 'json',
                delay: 150,
                processResults: function(isdataObat) {
                    return {
                        results: $.map(isdataObat, function(item) {
                            return {
                                // text: item.fs_mr,
                                text: item.fm_kd_obat + ' - ' + item.fm_nm_obat + ' - ' + item.qty +
                                    ' ' +
                                    item.satuan,
                                id: item.fm_kd_obat,
                                // alamat: item.fm_nm_obat,
                            }
                        })
                    };
                },
                cache: true
            }
        });

        // Get Satuan Jual
        function pasteTo() {
            var kd_obat = $('#obatResep').val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getObatListCH') }}/" + kd_obat,
                type: 'GET',
                data: {
                    'fm_kd_obat': kd_obat
                },
                success: function(isdataObatList) {
                    $.each(isdataObatList, function(key, datavalue) {
                        $('#satuan_jual_obat').val(datavalue.fm_satuan_jual);
                        $('#namaObatResep').val(datavalue.fm_nm_obat);
                        $('.ch_hrg_jual').val(datavalue.fm_hrg_jual_non_resep);
                    })
                }
            })
        }

        // Append Item yang di tambahkan
        $(document).on('click', '#addItemObatResepp', function() {
            // $(this).parent().remove();
            var obatResep = $('#obatResep').val();
            var namaobatResep = $('#namaObatResep').val();
            var qty_obat = $('#qty_obat').val();
            var satuan_jual_obat = $('#satuan_jual_obat').val();
            var signa_resep = $('#signa_resep').val();
            var cara_pakai_resep = $('#cara_pakai_resep').val();
            var hrg_jual = $('.ch_hrg_jual').val();

            $('#obatResep').empty();
            $('#namaObatResep').val('');
            $('#qty_obat').val('');
            $('#satuan_jual_obat').val('');
            $('#signa_resep').val('');
            $('#cara_pakai_resep').val('');
            $('#ch_hrg_jual').val('');

            $(".resepID").append(
                `
                <table>
                    <thead>
                        <tr class="mt-2">
                            <th width="370px">Obat</th>
                            <th width="90px">Hrg</th>
                            <th width="90px">Qty</th>
                            <th width="150px">Satuan</th>
                            <th width="200px">Signa</th>
                            <th width="230px">Cara Pakai</th>
                        </tr>
                    </thead>
                    <tbody class="mt-2">
                        <tr class="mt-2">
                            <td class="mt-2">
                                <input type="text" class="obatResep form-control" id="ch_kd_obat"
                                    name="ch_kd_obat[]" style="width: 100%" value="${namaobatResep}" readonly>
                            </td>
                            <input type="hidden" id="ch_nm_obat" name="ch_nm_obat[]" value="${obatResep}">
                            <td>
                                <input type="text" class="form-control" id="ch_hrg_jual" name="ch_hrg_jual[]" value="${hrg_jual}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_obat}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_jual_obat}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_resep}" readonly>
                            </td>
                            <td>
                                <input type="text" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_resep}" readonly>
                            </td>                             
                            <td>
                                <button type="button" class="remove btn btn-xs btn-danger"><i
                                class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
               `
            );

            $("#CHCreate").append(
                `
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <input type="hidden" class="obatResep form-control" id="ch_kd_obat"
                                    name="ch_kd_obat[]" style="width: 100%" value="${obatResep}" readonly>
                            </td>
                            <input type="hidden" id="ch_nm_obat" name="ch_nm_obat[]" value="${namaobatResep}">
                            <td>
                                <input type="hidden" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_obat}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_jual_obat}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_resep}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_resep}">
                            </td>
                                <input type="hidden" class="form-control" id="ch_hrg_jual" name="ch_hrg_jual[]" value="${hrg_jual}">
                               
                        </tr>
                    </tbody>
                </table>
               `
            );

            // $("#TESCHCreate").empty();
        });


        function deleteRow(btn) {
            var row = btn.parentNode.parentNode.parentNode.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // $('#removeReal').click();
        }

        function deleteRowReal(btnr) {

            var row = btnr.parentNode.parentNode.parentNode.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }

        // Create 
        $(document).ready(function() {
            $('#createSOAP').on('click', function() {
                var chart_id = $('#chart_id').val();
                var chart_tgl_trs = $('#tr_tgl_trs').val();
                var chart_kd_reg = $('#chart_kd_reg').val();
                var chart_mr = $('#chart_mr').val();
                var chart_nm_pasien = $('#chart_nm_pasien').val();
                var chart_layanan = $('#chart_layanan').val();
                var chart_dokter = $('#chart_dokter').val();
                var user = $('#user').val();
                var chart_S = $('#chart_S').val();
                var chart_O = $('#chart_O').val();
                var chart_A = $('#chart_A').val();
                var chart_A_diagnosa = $('#chart_A_diagnosa').val();
                var chart_P = $('#chart_P').val();

                // var kd_trs = $('#kd_trs').val();
                var nm_tarif = [];
                var sub_total = $('#sub_total').val();

                $('#nm_tarif').val(function() {
                    nm_tarif.push($(this).text());
                });

                // console.log(nm_tarif);
                if (chart_kd_reg != "") {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('chartCreate') }}",
                        type: "POST",
                        data: {
                            chart_id: chart_id,
                            chart_tgl_trs: chart_tgl_trs,
                            chart_kd_reg: chart_kd_reg,
                            chart_mr: chart_mr,
                            chart_nm_pasien: chart_nm_pasien,
                            chart_layanan: chart_layanan,
                            chart_dokter: chart_dokter,
                            user: user,
                            chart_S: chart_S,
                            chart_O: chart_O,
                            chart_A: chart_A,
                            chart_A_diagnosa: chart_A_diagnosa,
                            chart_P: chart_P,
                            nm_tarif: nm_tarif,
                            kd_trs: kd_trs,
                            tgl_trs: chart_tgl_trs,
                            layanan: chart_layanan,
                            kd_reg: chart_kd_reg,
                            mr_pasien: chart_mr,
                            nm_pasien: chart_nm_pasien,
                            nm_dokter_jm: chart_dokter,
                            sub_total: sub_total,
                        },
                        cache: false,
                        success: function(dataResult) {
                            // $('.close').click();
                            toastr.success('Saved!', 'Berhasil Tersimpan', {
                                timeOut: 2000,
                                preventDuplicates: true,
                                positionClass: 'toast-top-right',
                            });
                            return window.location.href =
                                "{{ url('tindakan-medis') }}";
                            getTimeline();

                        }
                    });
                } else {
                    alert('Please fill all the field !');
                }
            });
        });

        function getTimeline() {
            // $('#chart_S').val('')
            $('#chart_O').val('')
            $('#chart_A').val('')
            $('#chart_A_diagnosa').val('')
            $('#chart_P').val('')
            $(".isTimeline").empty();

            var data = sessionStorage.getItem("dataMR");
            var dataObject;
            // const cekTindakan = getVal.nm_tarif;


            if (data != null) {
                dataObject = JSON.parse(data);
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getTimeline') }}/" + dataObject,
                type: 'GET',
                data: {
                    chart_mr: dataObject
                },
                success: function(isTimelineHistory) {
                    // $.each(isTimelineHistory, function(key, getVal) {
                    var getValue = isTimelineHistory;
                    for (var getVal = 0; getVal < getValue.length; getVal++) {
                        var rmvNullS = getValue[getVal].chart_S ?? '';
                        var rmvNullO = getValue[getVal].chart_O ?? '';
                        var rmvNullA = getValue[getVal].chart_A ?? '';
                        var rmvNullAD = getValue[getVal].chart_A_diagnosa ?? '';
                        var rmvNullP = getValue[getVal].chart_P ?? '';

                        $('#tr_kd_reg').val(getValue[getVal].chart_kd_reg);
                        $('#tr_no_mr').val(getValue[getVal].chart_mr);
                        $('#tr_nm_pasien').val(getValue[getVal].chart_nm_pasien);
                        $('#tr_layanan').val(getValue[getVal].chart_layanan);
                        $('#tr_dokter').val(getValue[getVal].chart_dokter);

                        const trstdk = getValue[getVal].trstdk;
                        let html = "";
                        for (i in trstdk) {
                            if (trstdk[i].nm_trf != null) {
                                html += `<tr><td>${trstdk[i].nm_trf.nm_tindakan}</td></tr>`;
                            } else {
                                html += ``;
                            }
                        }

                        const resep = getValue[getVal].resep;
                        let resepShow = "";
                        for (i in resep) {
                            if (resep[i] != null) {
                                resepShow +=
                                    `<tr><td>${resep[i].ch_nm_obat} - <i class="text-danger">${resep[i].ch_cara_pakai}</i></td></tr>`;
                            } else {
                                resepShow += ``;
                            }
                        }
                        var getSessionName = '{{ Auth::user()->name }}';
                        // var ttv =
                        // `#VitalSign : <b class="text-primary">#BW:</b>${getValue[getVal].ttv_BW}(Kg) #BH:${getValue[getVal].ttv_BH}(CM) #BPs:${getValue[getVal].ttv_BPs}(mmHg)`;
                        if (getValue[getVal].user == getSessionName) {
                            var buttonEdit =
                                `<button type="button" class="btn btn-outline-info btn-xs" id="btneditchart" data-is_chart_id="${getValue[getVal].chart_id}" onClick="editChart(this)"><i class="fa fa-pen"></i></button>`;
                            var buttonDelete =
                                `<button type="button" class="btn btn-outline-danger btn-xs" id="btneditchart" data-is_chart_id="${getValue[getVal].chart_id}" onClick="deleteChart(this)"><i class="fa fa-trash"></i></button>`;
                        } else {
                            var buttonEdit = '';
                            var buttonDelete = '';
                        }
                        // const trstdk = getValue[getVal].trstdk;
                        // let html = "";
                        // trstdk.forEach(xkx => {
                        //     html =+<td>${xkx.nm_tarif}</td>

                        //     // html = `<td>${xkx.nm_tarif}</td>`;
                        //     console.log(xkx);
                        // });
                        var x = 1;
                        var dateFormat = getValue[getVal].created_at;
                        // var dateConvert = moment().format(
                        //     dateFormat); // "2014-09-08T08:02:17-05:00" (ISO 8601)
                        var dateView = moment(dateFormat).format(
                            "dddd, D MMMM YYYY, h:mm:ss a");
                        $(".isTimeline").append(`
                    <div class="left card-body">
                        <div class="row">
                            <div class="col">
                                <div class="col" id="accordion">
                                    <div class="card card-purple card-outline">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapse${x++}">
                                            <div class="card-header">
                                                <h4 class="card-title w-100">
                                                    <input type="text" style="border:none" class="form-control bg-nial"
                                                    id="" value="${'&nbsp;&nbsp;&nbsp&nbsp;' + dateView}" readonly>
                                                </h4>
                                            </div>
                                        </a>
                                <div id="collapse${x++}" class="collapse show" data-parent="#accordion">
                                    <div class="ml-4 mt-2">
                                        ${buttonEdit}
                                        ${buttonDelete}
                                        <button type="" id="isShowCahrtID" class="btn btn-outline-warning btn-xs">${getValue[getVal].chart_id}</button>
                                    </div>
                                    <div class="card-body">
                                         <div class="">
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Kd.Registrasi :</td>
                                                    <td>${getValue[getVal].chart_kd_reg}</td>
                                                </tr>
                                                <tr>
                                                    <td>No.MR :</td>
                                                    <td>${getValue[getVal].chart_mr}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nama :</td>
                                                    <td>${getValue[getVal].chart_nm_pasien}</td>
                                                </tr>
                                                <tr>
                                                    <td>Layanan :</td>
                                                    <td>${getValue[getVal].chart_layanan}</td>
                                                </tr>
                                                 <tr>
                                                    <td>Created By :</td>
                                                    <td>${getValue[getVal].user}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr>
                                        <div class="form-group ">
                                             <button type="disable" id="" class="btn btn-warning btn-xs text-white mb-2">Subjective</button>
                                            <textarea id=""  class="show_chart_S form-control" style="border:none;" rows="4" readonly value="">${getValue[getVal].chart_S}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_O form-group">
                                             <button type="disable" id="" class="btn btn-primary btn-xs mb-2">Objective</button>
                                            <table class="table" style="border:none;">
                                            <tbody style="background-color:#edfafa; border:none">
                                                <tr>
                                                    <td>BW :${getValue[getVal].ttv_BW}(Kg)</td>
                                                    <td>BH :${getValue[getVal].ttv_BH}(CM)</td>
                                                    <td>BT :${getValue[getVal].ttv_BT}(C)</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>BPs :${getValue[getVal].ttv_BPs}(mmHg)</td>
                                                    <td>BPd :${getValue[getVal].ttv_BPd}(mmHg)</td>
                                                    <td>HR  :${getValue[getVal].ttv_HR}(x/mnt)</td>
                                                </tr>
                                                <tr>
                                                    <td>RR  :${getValue[getVal].ttv_RR}(x/mnt)</td>
                                                    <td>SN  :${getValue[getVal].ttv_SN}</td>
                                                    <td>SpO2:${getValue[getVal].ttv_SPO2}(%)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            <textarea id="" class="show_chart_O form-control" style="border:none;" rows="4" readonly>${rmvNullO}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_A form-group">
                                             <button type="disable" id="" class="btn btn-success btn-xs mb-2">Assesment</button>
                                            <textarea id="" class="show_chart_A form-control mb-3" style="border:none;" rows="2" readonly>${rmvNullAD}</textarea>
                                            <textarea id="" class="show_chart_A form-control" rows="4" style="border:none;" readonly>${rmvNullA}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_P form-group">
                                             <button type="disable" id="" class="btn btn-danger btn-xs mb-2">Plan</button>
                                            <textarea id="" class="show_chart_P form-control" rows="4" style="border:none;" readonly>${rmvNullP}</textarea>
                                        </div>
                                        <hr>
                                        <div class="tindakan callout callout-danger">
                                            <table class="table-hover">
                                                <thead class="">
                                                    <tr>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TimelineTdk">
                                                        ${html}
                                                </tbody>
                                            </table>
                                        </div>

                                        <hr>
                                        <div class="resep callout callout-success">
                                            <table class="table-hover">
                                                <thead class="">
                                                    <tr>
                                                        <th>Resep</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TimelineResep">
                                                        ${resepShow}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`)
                        // }

                    }
                    // } else {
                    // $('#show_chart_S').val('');
                    // $('#show_chart_O').val('');
                    // $('#show_chart_A').val('');
                    // $('#show_chart_P').val('');
                    // $('#labelTimeline').val('');
                    // };
                }
            })
        };


        // Edit Chart
        function editChart(f) {
            toastr.info('Edit Form Opened!', {
                timeOut: 600,
                // preventDuplicates: true,
                positionClass: 'toast-top-right',
            });

            $('#kumpulanButton').empty();
            $('#createSOAPP').hide();

            var chartid = $(f).data('is_chart_id');

            $('#kumpulanButton').append(
                `<button type="button" id="updateChart" onClick="updateChartC(this)" data-chart_id_update="${chartid}" class="btn btn-primary float-rights">Update</button>`
            )

            console.log(chartid);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('chartIdSearch') }}/" + chartid,
                type: 'GET',
                data: {
                    'chart_id': chartid
                },
                success: function(isChartID) {
                    var getValueChart = isChartID;
                    $.each(isChartID, function(key, chartvalue) {
                        // const trstdk = chartvalue.trstdk;
                        // let tdk = "";
                        // for (i in trstdk) {
                        //     if (trstdk[i].nm_trf != null) {
                        //         tdk +=
                        //             `<option value="${trstdk[i].nm_tarif}">${trstdk[i].nm_trf.nm_tindakan}</option>`;
                        //     } else {
                        //         tdk += ``;
                        //     }
                        // }
                        // console.log(chartvalue);
                        $('#chart_S').val(chartvalue.chart_S)
                        $('#chart_O').val(chartvalue.chart_O)
                        $('#chart_A').val(chartvalue.chart_A)
                        $('#chart_A_diagnosa').val(chartvalue.chart_A_diagnosa)
                        $('#chart_P').val(chartvalue.chart_P)
                        // $('#nm_tarifXXXX').val(tdk)

                    })
                }
            })
        }


        function updateChartC(c) {
            var chart_id = $(c).data('chart_id_update');
            // alert(chart_id)
            var chart_S = $('#chart_S').val();
            var chart_O = $('#chart_O').val();
            var chart_A = $('#chart_A').val();
            var chart_A_diagnosa = $('#chart_A_diagnosa').val();
            var chart_P = $('#chart_P').val();

            // var nm_tarif = [];
            // var sub_total = $('#sub_total').val();

            // $('#nm_tarif').val(function() {
            //     nm_tarif.push($(this).text());
            // });

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('chartUpdate') }}",
                type: "POST",
                data: {
                    chart_id: chart_id,
                    chart_S: chart_S,
                    chart_O: chart_O,
                    chart_A: chart_A,
                    chart_A_diagnosa: chart_A_diagnosa,
                    chart_P: chart_P,
                },
                cache: false,
                success: function(dataResult) {
                    // $('.close').click();
                    toastr.success('Saved!', 'Data Berhasil Diperbarui!', {
                        timeOut: 2000,
                        preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    // return window.location.href =
                    //     "{{ url('tindakan-medis') }}";
                    getTimeline();

                }
            });
        }


        // Delete Chart
        function deleteChart(d) {
            var chartid = $(d).data('is_chart_id');
            console.log(chartid);
            var result = confirm("Want to delete?");
            if (result) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('chartDelete') }}/" + chartid,
                    type: 'POST',
                    data: {
                        'chart_id': chartid
                    },
                    success: function(isChartID) {
                        toastr.success('Deleted!', 'Chart Berhasil Dihapus!', {
                            timeOut: 2000,
                            preventDuplicates: true,
                            positionClass: 'toast-top-right',
                        });
                        getTimeline();
                    }
                })
            }

        }

        // Get Data setelah reload
        window.onload = getTimeline(), getHeaderInfo();
    </script>
@endpush
