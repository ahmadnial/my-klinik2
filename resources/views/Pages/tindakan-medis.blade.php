@extends('Pages.master')
@section('mytitle', 'Medical Chart')
@section('konten')
    <style>
        .splitLeft {
            /* display: flex; */
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


    <div class="col-sm-6 float-right content" id="Right">
        {{-- <div class="col" style="width:100%;" id="chart-note">
            <div class="card-header hd mt-2 mb-2 px-1 bg-light border" id="chartHeaderInput">
                <div class="hide" id="hdrChartTypeID"></div>
                <input type="text" style="display: none;" id="inputLayananID" />
                <div class="row">
                    <div class="col ac-head text-info" id="hdrChartTypeName" style="max-width: fit-content">Chart Type</div>
                    <div class="col ac-head hide" id="input-date">Date Time</div>
                    <div class="col ac-head" id="input-dokter" title="User ID">User</div>
                    <div class="col ac-head" id="input-layanan" style="max-width: fit-content; min-width: fit-content">
                        Layanan
                    </div>
                    <div class="col ac-head" style="text-align: right" id="input-status">[New]</div>
                    <div class="col-4" id="divJamPeriksaOpsional">
                        <div class="btn-group pull-right" style="margin-top: -2px;">
                            <button class="btn btn-default btn-sm dropdown-toggle border-radius3" type="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="btnJamPeriksa"
                                style="padding-top: 3px;padding-bottom: 3px;">
                                <span class="kt-font-md kt-font-bold" id="lblTglPeriksa">01-01-1900</span>
                                <span class="ml-2 kt-font-md" id="lblJamPeriksa">00:00</span>
                            </button>
                            <div class="dropdown-menu p-2" x-placement="bottom-start" id="myDropdown"
                                style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 24px, 0px);">
                                <div class="row">
                                    <h6 class="kt-font-brand ml-1">Waktu Periksa</h6>
                                    <input type="text" id="jamPeriksaOpsional"
                                        class="form-control form-control-sm text-right kt-font-lg mb-1" im-insert="true">
                                    <input type="text" id="tglPeriksaOpsional"
                                        class="form-control form-control-sm text-right kt-font-lg hide" im-insert="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="border-right"></div>

        <div class="static-card-timeline mb-2">
            <div class="justify-content-between px-1"
                style="display: flex !important; z-index:100; border: 1px solid #e0cff0; background-color: #FFFFFF;">

                <div class="" id="" style="align-content: center">
                    <div class="accordion m-1 form-inline  text-light" id="DetailPasien">
                        <!-- min-width:300px; max-width:500px -->
                        <div class="card ml-3 mt-1" style="align-content: center">
                            <!-- min-width:300px;  -->
                            <div class="form-control card-header row" name="PasienHdr" style="background-color:#a07ccf">
                                <div class="text-light collapsed pointer" id="collapseCoverPasien" data-toggle="collapse"
                                    data-target="#DetPsn" aria-expanded="false" aria-controls="DetPsn"
                                    style="background-color:#a07ccf; border: none;">
                                    {{-- style="justify-content: space-between; padding: 6px 13px 7px 0px"> --}}
                                    <label style="width: 2vw;overflow: hidden;text-overflow: " name="nmPasienHdr"
                                        id="nmPasienHdr" class="text-warning pointer">
                                        <i class="fa fa-user"></i>
                                    </label>
                                    {{-- <input type="text" class="form-control text-light" name=""
                                                id="nmPasienHdr"
                                                style="background-color:#6c558a; border: none; width: 17vw;"> --}}
                                    {{-- <span id="1MonthUp" name="1MonthUp"
                                                class="badge badge-warning kt-font-bold"
                                                style="border-radius: 3px;padding: 2px 5px;margin-right: 10px; display: none;"
                                                title="Terakhir periksa"></span>
                                            <strong>
                                                <label name="noMrHdr" class="pointer mr-2">00-00-00-00</label>
                                            </strong>
                                            <label
                                                style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;background: #ed2121; font-size: 0.9rem; display: none;"
                                                name="tagAlergiProfile"
                                                class="text-white pointer mx-1 kt-font-normal px-2">
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
                                            {{--
                                                    </div> --}}
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
                                                                            <select
                                                                                class="form-control form-control-sm col mb-2"
                                                                                id="listAlergiTypeProfileHD">
                                                                            </select>
                                                                        </div>
                                                                        <div class="row">
                                                                            <input type="text" id="alergiNameProfileHD"
                                                                                class="form-control form-control-sm col mb-2"
                                                                                autocomplete="off"
                                                                                placeholder="Nama Alergi">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-12 p-0">
                                                                                <button
                                                                                    class="btn btn-sm btn-primary border-radius3 kt-font-bolder pull-right p-1"
                                                                                    id="addAlergiProfileHD"
                                                                                    type="button">
                                                                                    <i
                                                                                        class="fa fa-save icon-smass"></i>Save
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
                                                                        name="listDiagnosisProfile"
                                                                        style="max-height: 250px;">
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
                                            {{-- <div
                                                        class="row pl-2 scroll-y scrollbar-dusty thin border px-3 pt-2 scrollbox"
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
                                                <div class="progress-bar kt-bg-info" id="progressLoadImageQR"
                                                    role="progressbar" style="width: 0%;" aria-valuenow="0"
                                                    aria-valuemin="0" aria-valuemax="100">
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
                <div class="p-0 col-6 pr-2" style="padding-top: 10px !important;">
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

                <div class="p-0 col-3 pr-2" id="panelFilterInstalasi" style="padding-top: 10px !important;">
                    <input type="date" class="form-control" name="tr_tgl_trs" id="tr_tgl_trs"
                        value="{{ $dateNow }}" readonly>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <table class="table table-bordered" style="border:none;">
                <tbody style="background-color:#f5f2e9; border:none">
                    <tr>
                        <td><span class="text-center">Nama</span><input type="text"
                                class="form-control form-control-sm" id="pasienName" value="" readonly
                                style="border: none; font-size: 18px">
                        </td>
                        <td><span class="text-center">Alamat</span><input type="text"
                                class="form-control form-control-sm" id="pasienAddress" value="" readonly
                                style="border: none; font-size: 18px">
                        </td>
                        <td><span class="text-center">Usia</span><input type="text"
                                class="form-control form-control-sm col" id="pasienAge" value="" readonly
                                style="border: none; font-size: 18px"></td>
                    </tr>
                    <tr>
                        <td><span class="text-center">Alergi</span><input type="text"
                                class="form-control form-control-sm" id="pasienAlergi" value="" readonly
                                style="border: none">
                        </td>
                        <td><span class="text-center">Last Tarif</span><input type="text"
                                class="form-control form-control-sm" id="pasienLastTarifDasar" value="" readonly
                                style="border: none"></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card" id="chart_soap" style="overflow-y:scroll; overflow-x: hidden; height:650px;">
            <div class="">
                {{-- <div class="col-12">
                </div> --}}
                {{-- <div class="col"> --}}
                {{-- <div class="row"> --}}
                {{-- <div class="container mt-2">
                    <table class="table table-bordered" style="border:none;">
                        <tbody style="background-color:#f5f2e9; border:none">
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" id="pasienName"
                                        value="" readonly style="border: none; font-size: 18px">
                                </td>
                                <td><input type="text" class="form-control form-control-sm" id="pasienAddress"
                                        value="" readonly style="border: none; font-size: 18px">
                                </td>
                                <td><input type="text" class="form-control form-control-sm" id="pasienAge"
                                        value="" readonly style="border: none; font-size: 18px"></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control form-control-sm" id="pasienAlergi"
                                        value="" readonly style="border: none">
                                </td>
                                <td><input type="text" class="form-control form-control-sm" id="pasienLastTarifDasar"
                                        value="" readonly style="border: none"></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> --}}

                <div class="form-group col-sm-6">
                    <input type="hidden" class="form-control" name="tr_no_mr" id="tr_no_mr" value="" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <input type="hidden" class="form-control" name="tr_nm_pasien" id="tr_nm_pasien" value=""
                        readonly>
                </div>
                <div class="form-group col-sm-6">
                    <input type="hidden" class="form-control" name="tr_layanan" id="tr_layanan" value=""
                        readonly>
                </div>
                <div class="form-group col-sm-6">
                    <input type="hidden" class="form-control" name="tr_dokter" id="tr_dokter" value="" readonly>
                </div>
                <div class="form-group col-sm-6">
                    <input type="hidden" class="form-control" name="tr_umur" id="tr_umur" value="" readonly>
                </div>
                <div class="form-group col-sm-6">

                    <input type="hidden" class="form-control" name="tr_alamat" id="tr_alamat" value="">
                </div>

                <input type="hidden" id="tr_tgl_lahir" name="tr_tgl_lahir">
                <input type="hidden" id="user" name="user" value="tes">
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <input type="text" id="chart_id_show" name="chart_id" value=""> --}}

                {{-- <div class="float-right">
            <button class="btn btn-success" data-toggle="modal" data-target="#TambahSOAP"><i class="fa fa-plus"></i>
                SOAP</button>
        </div> --}}
                {{-- <div class="card-body"> --}}
                <div class="row">
                    <div class="col">
                        {{-- <div class="card card-info"> --}}
                        {{-- <div class="card-header">
                                    <h3 class="card-title">Form SOAP
                                    </h3>
                                </div> --}}
                        {{-- Hidden value --}}
                        <form action="{{ url('chartCreate') }}" method="post" id="CHCreate" class="needs-validation"
                            novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <input type="hidden" id="chart_id" name="chart_id" value="">
                                <input type="hidden" id="chart_kd_reg" name="chart_kd_reg" value="">
                                <input type="hidden" id="chart_tgl_trs" name="chart_tgl_trs"
                                    value="{{ $dateNow }}">
                                <input type="hidden" id="chart_mr" name="chart_mr" value="">
                                <input type="hidden" id="chart_nm_pasien" name="chart_nm_pasien" value="">
                                <input type="hidden" id="chart_layanan" name="chart_layanan" value="">
                                <input type="hidden" id="chart_dokter" name="chart_dokter" value="">
                                <input type="hidden" id="userActive" name="user" value="{{ Auth::user()->name }}">
                                {{-- Hidden value --}}
                                <div class="form-group">
                                    {{-- <label for="inputDescription" style="color: #ed2121">Subjective</label> --}}
                                    <span for="inputDescription"
                                        style="background-color: #408ef3; border-radius: px; padding-top:5px; 
                                        padding-bottom:5px; padding-left:10px; padding-right:50px; color: #ffffff"><b>
                                            SUBJECTIVE</b></span>
                                    {{-- <input class="form-control" style="border: none" id="keluhanutama"> --}}
                                    <textarea id="chart_S" name="chart_S" class="ta_Chart_S form-control" rows="4"></textarea>
                                </div>

                                <div class="form-group">
                                    <div class="s_head">
                                        <div class="btn-group float-right btn-group-xs template-hide" role="group"
                                            aria-label="Button group with nested dropdown">
                                            {{-- <button type="button"
                                                class="btn btn-xs btn-primary mb-1 show-count badge-top-right"
                                                data-toggle="collapse" data-target="#collapseVitalSign"
                                                aria-expanded="true" aria-controls="collapseVitalSign"
                                                data-namainput="attachment-o" data-count="0" id="btnVitalSign">
                                                Vital Sign
                                            </button> --}}
                                            <!--span class="badge badge-pill badge-success b_pos" style="color:white;">11</span-->
                                        </div>
                                    </div>
                                    <span for="inputDescription"
                                        style="background-color: #f39140; border-radius: px; padding-top:5px; 
                                        padding-bottom:5px; padding-left:10px; padding-right:50px; color: #ffffff"><b>
                                            OBJECTIVE</b></span>
                                    {{-- VITAL SIGN --}}
                                    <div id="collapseVitalSign" class="bg-light border collapse show col"
                                        aria-labelledby="headerVitalSign" data-parent="#btnVitalSign" style="">
                                        <div class="row py-2" id="inputMonitoringMC">
                                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                <i class="mb-1">Body Weight</i>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-append input-group-sm">
                                                        <input type="number" id="ttv_BW" name="ttv_BW"
                                                            data-satuan="kg" data-monitorname="Body Weight"
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
                                                        <span class="input-group-text"
                                                            style="width:7em; text-align:center">kg</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                <i class="mb-1">Body Height</i>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-append input-group-sm">
                                                        <input type="number" id="ttv_BH" name="ttv_BH"
                                                            data-satuan="cm" data-monitorname="Body Height"
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
                                                        <span class="input-group-text"
                                                            style="width:7em; text-align:center">cm</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-sm-4 col-xs-6 px-3">
                                                <i class="mb-1">Blood Pressure Sistole</i>
                                                <div class="input-group input-group-sm mb-3">
                                                    <div class="input-group-append input-group-sm">
                                                        <input type="number" id="ttv_BPs" name="ttv_BPs"
                                                            data-satuan="mmHg" data-monitorname="Blood Pressure Sistole"
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
                                                        <span class="input-group-text"
                                                            style="width:7em; text-align:center">mmHg</span>
                                                    </div>
                                                    {{-- <div class="invalid-feedback">
                                                        Please..dont let me blank
                                                    </div> --}}
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
                                                            data-satuan="mmHg" data-monitorname="Blood Pressure Diastole"
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
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
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
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
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
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
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
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
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            max="10" value="">
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
                                                            class="form-control form-control-sm vital-sign" min="0"
                                                            value="">
                                                        <span class="input-group-text"
                                                            style="width:7em; text-align:center">%</span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="modal-footer p-2">
                                            <div class="col">
                                                <div class="btn-group pull-left">
                                                    <button type="button" class="btn btn-sm btn-warning border-radius3"
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

                                    <textarea id="chart_O" name="chart_O" class="form-control mt-2" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <span for=""
                                        style="background-color: #d40b47; border-radius: px; padding-top:5px; 
                                        padding-bottom:5px; padding-left:10px; padding-right:50px; color: #ffffff"><b>
                                            ASSESMENT</b></span>
                                    <div class="mb-1"></div>
                                    <select class="chart_A_diagnosa form-control mb-3" style="width: 100%;"
                                        name="chart_A_diagnosa" id="chart_A_diagnosa" onkeyup="getICDX()">
                                        {{-- <option value="">--Select--</option> --}}
                                    </select>
                                    <textarea id="chart_A" name="chart_A" class="form-control mt-3 mb-2" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <span for=""
                                        style="background-color: #0cbd2a; border-radius: px; padding-top:5px; 
                                        padding-bottom:5px; padding-left:10px; padding-right:90px; color: #ffffff"><b>
                                            PLAN</b></span>
                                    <div class="float-right mb-1">
                                        <button type="button" id="addTindakann"
                                            class="btn btn-xs btn-warning floar-right text-white" data-toggle="modal"
                                            data-target="#addTindakans"><i class="fa fa-plus"></i>&nbsp;Tindakan</button>
                                        <button type="button" class="btn btn-xs btn-info floar-right"
                                            data-toggle="modal" data-target="#addResep"><i
                                                class="fa fa-plus"></i>&nbsp;Resep</button>
                                        <button type="button" class="btn btn-xs btn-danger floar-right"
                                            data-toggle="modal" data-target="#uploadImg"><i
                                                class="fa fa-plus"></i>&nbsp;Upload </button>
                                    </div>
                                    <textarea id="chart_P" name="chart_P" class="form-control" rows="4"></textarea>
                                    {{-- <input required type="file" class="form-control" name="images[]"
                                        placeholder="address" multiple> --}}
                                </div>
                                <div class="card-resep form-group">

                                </div>
                                <div class="showOrHideTdk"></div>
                                {{-- ===============ADD IMAGE MODAL================= --}}
                                <div class="modal fade" id="uploadImg" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="indicator"></div>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"></h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container text-center mb-5">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h4><a href="https://plugins.krajee.com/file-input"
                                                                    target="_blank"><b>File Upload</b></a></h4>
                                                        </div>
                                                    </div>
                                                </div>

                                                <section class="bg-diffrent">
                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            <div class="col-xl">
                                                                <div class="file-upload-contain">
                                                                    <input id="multiplefileupload" type="file"
                                                                        name="images[]" class="d-none"
                                                                        accept=".jpg,.gif,.png" multiple>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="">
                                                            <input type="text" class="form-control" value=""
                                                                name="imgNote" placeholder="Note..">
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                            {{-- <div class="row col-md-12 ml-auto mr-auto preview"></div> --}}
                                            <div class="modal-footer">
                                                {{-- <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Close</button> --}}
                                                <span class="btn btn-info btn-sm" data-dismiss="modal">Save</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- ===============END ADD IMAGE MODAL================= --}}

                                {{-- <input type="hidden" id="user" name="user_create" value="tes"> --}}
                            </div>
                            {{-- </div> --}}
                            <div class="modal-footer" id="">
                                <div class="" id="kumpulanButton"></div>
                                {{-- <button type="button" class="btn btn-primary float-rights">Update</button> --}}
                                <button id="createSOAPP" class="btn btn-success btn-sm float-rights"><i
                                        class="fa fa-save"></i>
                                    &nbsp;
                                    Save</button>
                                {{--
                        </div> --}}
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                        <div class="">
                            {{-- <table class="table table-bordered">
                                <tbody id="nm_tarif_plus">
                                    <tr>
                                        <td> --}}
                            <label for="">Tarif/Tindakan Tambahan</label>
                            <select class="nm_tarif form-control-multiple" style="width:100%;" id="nm_tarif"
                                name="nm_tarif[]" multiple>
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
                    {{-- <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}"> --}}
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
                    <h4 class="modal-title-sm">Resep</h4>
                    <button type="button" class="close" id="CloseModalResep" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        @if (Auth::user()->id == 4 || Auth::user()->id == 13 || Auth::user()->id == 14)
                            <div class="">
                                <div class="callout callout-danger bg-light">
                                    <label for="">Tarif Dasar</label>
                                    <input type="number" class="form-control" name="nm_tarif_dasar" id="nm_tarif_dasar"
                                        value="0">
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
                                                        class="fa fa-plus-circle text-white"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="resepID callout mt-2" style="overflow-y: scroll; max-height:350px;">
                            <div class="resep-content">
                                <div class="row" id="resepList" style="padding: 5px;">
                                </div>
                            </div>
                        </div>

                        <tfoot>
                            <hr>
                            <div class="float-left mt-2">
                                {{-- <button type="button" class="btn btn-sm btn-warning float-right dropdown-toggle"
                                    role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false" onclick="getTemplateOrder()">Load
                                    Template
                                </button> --}}
                                <button type="button" class="btn btn-sm btn-warning float-right dropdown-toggle"
                                    onclick="getTemplateOrder()">Load
                                    Template
                                </button>

                                <div class="dropdown-menu" id="showTemplateOrder" aria-labelledby="dropdownMenuLink">
                                    {{-- <a class="dropdown-item" href="#">Action</a> --}}
                                </div>
                            </div>
                    </div>
                    {{-- <input type="hidden" id="kd_trs" name="kd_trs" value="{{ $kd_trs }}"> --}}
                    {{-- <input type="hidden" id="sub_total" name="sub_total" value="0"> --}}
                    <div class="float-right mt-2">
                        <a type="button" id="exitModalResep" onclick="exitModalResep()"
                            class="btn btn-sm btn-success">Add Resep</a>
                    </div>
                    </tfoot>
                </div>
            </div>
        </div>
    </div>


    {{-- ========================END MODAL ADD RESEP============================= --}}

    {{-- ===============TEMPLATE OPNE MODAL================= --}}
    <div class="modal fade" id="loadTemplate">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Template Resep</h4>
                    <button type="button" class="close" id="CloseModalTemplate" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="">
                            <table class="table table-striped table-hover" id="penjualan">
                                <tbody id="loadListAllTemplate">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="float-right mt-2">
                        <a type="button" id="exitModal" onclick="exitModalTemplate()" class="btn btn-success">add</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- ========================END MODAL TEMPLATE============================= --}}

    {{-- MODAL EDIT OBAT RESEP --}}
    {{-- <div class="modal fade show" id="modalAddObat" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" style="z-index: 3101; display: block;" aria-modal="true"
        data-save="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"
                style="box-shadow: 0px 0px 100px 50px rgba(0, 0, 0, 0.2), 0px 50px 100px 50px rgba(0, 0, 0, 0.19); border-radius: 6px"> --}}
    <div class="modal fade" id="editObatResep">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content"
                style="box-shadow: 0px 0px 100px 50px rgba(0, 0, 0, 0.2), 0px 50px 100px 50px rgba(0, 0, 0, 0.19); border-radius: 6px">
                <div class="modal-header p-2 px-3">
                    <h5 class="modal-title" id="modalObatTitle">Edit Obat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <div class="table-responsive">
                        <table class="table table-bordered tblResep" style="width: 100%">
                            <tr>
                                <td>
                                    Kode
                                </td>
                                <td colspan="2">
                                    <input type="text" id="kode_obat_edit" class="form-control form-control-sm brgID"
                                        value="" readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nama
                                </td>
                                <td colspan="2">
                                    <input type="text" id="nm_obat_edit" style="font-weight: bold;"
                                        class="clearable form-control form-control-sm" onclick="this.select()"
                                        value=""readonly>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Qty
                                </td>

                                <td>
                                    <input type="number" id="qty_obat_edit" class="form-control form-control-sm qty"
                                        value="1" onclick="this.select()">
                                    <input type="number" style="display:none;" id="hargaSatuan"
                                        class="form-control form-control-sm hargaSatuan">
                                    <input type="number" style="display:none;" id="konversi"
                                        class="form-control form-control-sm konversi" value="0">
                                </td>
                                <td>
                                    <input type="text" id="satuan_obat_edit"
                                        class="clearable form-control form-control-sm" value="" readonly>
                                </td>
                            </tr>
                            <tr class="">
                                <td>
                                    Signature
                                </td>
                                <td colspan="2">
                                    <input type="text" id="signa_obat_edit"
                                        class="form-control form-control-sm signature" value=""
                                        onclick="this.select()">
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">
                                    Cara Pakai
                                </td>
                                <td style="width: 60%;">
                                    <input type="text" id="cara_pakai_obat_edit"
                                        class="form-control form-control-sm caraPakai ui-autocomplete-input"
                                        value="">
                                </td>
                                {{-- <td style="width: 20%;">
                                    <div class="form-inline">
                                        <span class="mr-3">Iter</span>
                                        <input type="number" id="iter"
                                            class="form-control form-control-sm col-4 iter" value="0"
                                            onclick="this.select()">
                                    </div>
                                </td> --}}
                            </tr>
                            {{-- <tr class="">
                                <td>
                                    Harga
                                </td>
                                <td colspan="2">
                                    <input type="text" id="harga" class="form-control form-control-sm harga"
                                        value="2331" disabled="disabled">
                                </td>
                            </tr> --}}
                        </table>
                    </div>
                </div>
                <div class="modal-footer p-2">
                    <button type="button" class="btn btn-primary btn-sm" id="" onclick="updateListObatResep()"
                        style="border-radius: 3px">Update</button>
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"
                        style="border-radius: 3px">Close</button>
                </div>
            </div>
        </div>
    </div>
    </form>

    {{-- END MODAL EDIT RESEP --}}

    <div class="modal fade" role="dialog" id="showImgChart">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h4 class="modal-title">Template Resep</h4> --}}
                    <button type="button" class="close" id="CloseModalTemplate" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-fluid" id="imageShowOff" style="max-width:100%; height:auto; width:auto">

                    </div>
                    {{-- <div class="float-right mt-2">
                        <a type="button" id="exitModal" onclick="exitModalTemplate()" class="btn btn-success">add</a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-6 order-md-1 order-sm-2" id="timelineChart">
        <div style="overflow-y:scroll; overflow-x: hidden; height:900px;">
            <div class="static-card-timeline">
                <div class="justify-content-between px-1"
                    style="display: flex !important; z-index:100; border: 1px solid #e0cff0; background-color: #FFFFFF;">

                    <div class="p-2 mt-2" id="" style="align-content: center; padding-top: 5px;">
                        <div class="form-group float-right">
                            <div class="custom-control custom-switch" style="padding-top: 5px;">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"
                                    style="padding-top: 3px;">Timeline</label>
                            </div>
                        </div>
                    </div>
                    <div class="border-right"></div>
                    <div class="p-2" id="panelBtnFilterChart">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Small button group"
                            style="padding-top: 6px;">
                            <button type="button" class="btn btn-sm btn btn-outline-danger rounded-left px-3"
                                id="btnfilterChartToday">Today</button>
                            <button type="button" class="btn btn-sm btn btn-outline-danger rounded-right active px-3"
                                id="btnfilterChartAll">All Data</button>
                        </div>
                    </div>
                    <div class="p-0 col-3 pr-2" id="panelFilterSatTugas" style="padding-top: 12px !important;">
                        <select class="form-control form-control-sm kt-font-boldest kt-font-info"
                            id="filterSatTugasChart">
                            <option value="">No Filter</option>
                            <option disabled="">----------------</option>
                            <option disabled="">----------------</option>
                            </option>
                        </select>
                    </div>
                    <div class="p-0 col-2 pr-2" id="panelFilterInstalasi" style="padding-top: 10px !important;">
                        {{-- <select class="form-control form-control-sm kt-font-bold" id="filterInstalasiDKMC">
                            <option value="" selected="">Filter Instalasi</option>
                            <option value="3">Rawat Inap</option>
                            <option value="2">Rawat Jalan</option>
                            <option value="1">Rawat Darurat</option>
                        </select> --}}
                    </div>
                </div>
            </div>
            <div id="" class="isTimeline collapse show bg-light" data-parent="#accordion">
            </div>
            <div id="" class="isTimelineListAll collapse show bg-light" data-parent="#accordion">
            </div>

        </div>
    </div>
    {{-- <div class="splitLeft col-sm-6 col-lg-6 col-xs-sm-6 row">
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
                <div id="" class="isTimelineListAll collapse show bg-light" data-parent="#accordion">
                </div>
            </div>
        </div>
    </div> --}}
    <!-- /.content -->
    {{-- <table class="table table-striped table-bordered">
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
                                        </table> --}}
@endsection

@push('scripts')
    <script>
        function getTemplateOrder() {
            $('#loadTemplate').modal('show');
            $("#loadListAllTemplate").empty();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getTemplateOrder') }}",
                type: 'GET',

                success: function(isTemplateOrder) {
                    $("#showTemplateOrder").empty();
                    var getValue = isTemplateOrder;
                    for (var getVal = 0; getVal < getValue.length; getVal++) {
                        var templateName = getValue[getVal].nm_to;
                        var kd_to = getValue[getVal].kd_to;

                        // $("#showTemplateOrder").append(
                        //     `<a class="dropdown-item" onClick="selectDataTemplate(this)" data-kd_to="${kd_to}" href="#">${templateName}</a>`
                        // )
                        $("#loadListAllTemplate").append(
                            `<tr>
                                <td><a class="dropdown-item" onClick="selectDataTemplate(this)" data-kd_to="${kd_to}" href="#">${templateName}</a></td>
                            </tr>`
                        )
                    }
                }
            })
        }

        function selectDataTemplate(x) {
            $('#loadTemplate').modal('hide');

            var getKdTo = $(x).data('kd_to');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('selectTemplateOrder') }}",
                type: 'GET',
                data: {
                    kd_to: getKdTo
                },
                success: function(isDataTemplate) {
                    $("#resepList").empty();
                    $(".card-resep").empty();
                    var getValue = isDataTemplate;
                    for (var getVal = 0; getVal < getValue.length; getVal++) {
                        var kd_obat_to = getValue[getVal].kd_obat_to;
                        var nm_obat_to = getValue[getVal].nm_obat_to;
                        var hrg_obat_to = getValue[getVal].hrg_obat_to;
                        var qty_to = getValue[getVal].qty_to;
                        var satuan_to = getValue[getVal].satuan_to;
                        var signa_to = getValue[getVal].signa_to ?? '';
                        var cara_pakai_to = getValue[getVal].cara_pakai_to ?? '';

                        $("#resepList").append(
                            `
                            <div class="col-md-6 kt-callout-etiket mb-4" id="cardObatList${kd_obat_to}">
                                <div class="border-radius3"
                                    style="background-image: linear-gradient(to bottom right, #ECEBF4, #B0A8E5); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 196px;">
                                    <div class="kt-portlet__head"
                                        style="min-height: 10px !important;padding: 0px;z-index: 10; border: 0px;">
                                        <div style="top: 0;position: absolute;left: -2; width: 30%;"
                                            class="kt-portlet__head kt-portlet__head--noborder kt-ribbon kt-ribbon--left">
                                            <div class="kt-ribbon__target bg-warning"
                                                style="top: 3px; left: -2px;padding: 1px 8px 1px 10px;background-color: #b3c0eb;color: rgb(163, 0, 101);font-size: 0.96em;">
                                                <label style="margin: 0px;" class="e_brgID">${kd_obat_to}</label>
                                                <span id="infoGEN000000209" data-toggle="popover"
                                                    data-placement="bottom" data-content=""
                                                    data-original-title="" title=""></span>
                                            </div>
                                        </div>
                                        <div class="head-label">
                                        </div>
                                        <div class="head-toolbar">
                                            <span class="mr-3 bg-lightgreen text-dark px-2"
                                                id="iterGEN000000209"></span>
                                            <div class="kt-portlet__head-actions">
                                                <span data-toggle="tooltip" title="Info">
                                                    <a href="javascript:;"
                                                        class="btn btn-clean btn-sm btn-icon btn-icon-md pointer infoObat"
                                                        data-infoid="infoGEN000000209">
                                                        <i class="fa fa-info-circle"></i>
                                                    </a>
                                                </span>
                                                <span data-toggle="tooltip" title="Edit">
                                                    <a href="javascript:;"
                                                        class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                        data-toggle="modal" data-target="#"
                                                        data-isracik="0" data-idobat="${kd_obat_to}" data-nmobat="${nm_obat_to}" data-qtyobat="${qty_to}" data-satuanobat="${satuan_to}"
                                                        data-signaobat="${signa_to}" data-carapakaiobat="${cara_pakai_to}"
                                                        onclick="editObat(this)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </span>
                                                <span data-toggle="tooltip" title="Delete">
                                                    <a href="javascript:;"
                                                        class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                       data-idobat="${kd_obat_to}"
                                                       onclick="deleteRow(this)">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body" style="padding: 0 10px 0 10px;">
                                        <div class="kt-callout__body">
                                            <div class="kt-callout__content">
                                                <h3 class="kt-callout__title-mod e_brgName text-danger">${nm_obat_to}
                                                </h3>
                                                <div class="etiket-body">
                                                    <p class="kt-callout__desc e_qty mb-0"
                                                        style="margin-bottom: 0.5rem;">${qty_to} ${satuan_to}</p>
                                                    <h6 class="e_signa">${signa_to}</h6>
                                                    <h6 class="e_carapakai mb-0">${cara_pakai_to}</h6>
                                                </div>
                                                <h6 class="pull-right e_harga mb-0 "> Rp. ${hrg_obat_to}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `
                        );

                        $(".card-resep").append(
                            `<tbody class="mt-2" id="cardObatList${kd_obat_to}">
                                <tr class="mt-2">
                                    <td class="mt-2">
                                        <input type="hidden" class="obatResep form-control" id="ch_kd_obat"
                                            name="ch_kd_obat[]" style="width: 100%" value="${kd_obat_to}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_nm_obat" name="ch_nm_obat[]" value="${nm_obat_to}">
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_hrg_jual" name="ch_hrg_jual[]" value="${hrg_obat_to}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_to}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_to}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_to}" readonly>
                                    </td>
                                    <td>
                                        <input type="hidden" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_to}" readonly>
                                    </td>                             
                                </tr>
                            </tbody>`
                        );
                    }
                }
            })
        }



        $('input:checkbox').change(
            function() {
                if ($(this).is(':checked')) {
                    $(".isTimeline").hide();
                    $(".isTimelineListAll").show();
                    $(".isTimelineListAll").empty();
                    var data = sessionStorage.getItem("dataMR");
                    var dataObject;

                    if (data != null) {
                        dataObject = JSON.parse(data);
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ url('getLabel') }}/" + dataObject,
                        type: 'GET',
                        data: {
                            pasienID: dataObject
                        },
                        success: function(isLabel) {
                            var getValue = isLabel;
                            for (var getVal = 0; getVal < getValue.length; getVal++) {
                                var dateFormat = getValue[getVal].Tgl;
                                var dateViewHdr = moment(dateFormat).format(
                                    "dddd, D MMMM YYYY");
                                var dateViewItem = moment(dateFormat).format(
                                    "h:mm:ss a");
                                let showResepOff = getValue[getVal].ketHTML;
                                let decode = $('<div>').html(showResepOff).text()
                                let headerCard = getValue[getVal].labelType;
                                let ShowTimelineResep = decode.replace(/[["","",""]/g, "");
                                // const parser = new DOMParser();
                                // let ShowTimelineResep = parser.parseFromString(decode, "text/html");

                                $(".isTimelineListAll").append(
                                    `<div class="left card-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="timeline">
                                                    <div class="time-label">
                                                    <span class="bg-red">${dateViewHdr}</span>
                                                    </div>
                                                    <div>
                                                        <i class="fas fa-user bg-nial"></i>
                                                        <div class="timeline-item">
                                                            <span class="time"><i class="fas fa-clock">&nbsp;</i>${dateViewItem}</span>
                                                            <h3 class="timeline-header"><a href="#">${headerCard}</a></h3>
                                                            <div class="timeline-body">
                                                                <table class="col table table-hover table-bordered">
                                                                    <thead class="" style="background-color: #D9C9FC">
                                                                        <tr>
                                                                            <th>Obat</th>
                                                                            <th>Qty</th>
                                                                            <th>Satuan</th>
                                                                            <th>Cara Pakai</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                       ${ShowTimelineResep} 
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`
                                )
                            }
                        }
                    })


                } else {
                    $(".isTimeline").show();
                    $(".isTimelineListAll").hide();
                }
            });

        // Ajax Search Registrasi
        $('#tr_kd_reg').select2({
            placeholder: 'Pilih Pasien',
        });

        $('.nm_tarif').select2({
            placeholder: 'Search Tindakan',
        });

        function exitModalTindakan() {
            $('#CloseModalTindakan').click()
            toastr.info('Tindakan Ditambahkan', {
                timeOut: 200,
                positionClass: 'toast-top-right',
            });
        }

        function exitModalResep() {
            $('#CloseModalResep').click()
            toastr.info('Resep Ditambahkan', {
                timeOut: 200,
                positionClass: 'toast-top-right',
            });
            let prescription = `<div class="card col-xl col-lg col-md col-sm p-2 card-order-resep">
                                    <div class="text-left font-md label-font-color-3 card-option card-option-header p-1 px-2"
                                        data-toggle="modal" data-target="#modalResep" data-orderid="1"
                                            title="Click to View" style="border-left: 3px solid #ffb822;">
                                                <i class="fa fa-prescription mr-1"></i> <b>Resep</b>
                                                <span class="kt-font-sm font-weight-normal kt-font-success"></span>
                                                <br>
                                                <span class="kt-font-sm kt-label-font-color-1"></span>
                                                <div class="collapse show" id="collapseDetailOrderResep1"
                                                    aria-labelledby="headerOrderResep" data-parent="#btnDetailOrderResep1"
                                                    style="">
                                                    <table class="">
                                                        <tbody class="mt-2">
                                                            <tr class="mt-2">
                                                                <td class="mt-2">
                                                                    <input type="hidden" class="form-control"
                                                                        id="ch_kd_obat" name="ch_kd_obat[]"
                                                                        style="border: none;" value="" readonly>
                                                                </td>
                                                                <td>
                                                                <input type="text" id="ch_nm_obat" class="form-control" name="ch_nm_obat[]"
                                                                    value="" style="border: none;" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control"
                                                                        id="ch_hrg_jual" name="ch_hrg_jual[]"
                                                                        value="" readonly>
                                                                </td>
                                                                <td width="70px">
                                                                    <input type="text" class="form-control"
                                                                        id="ch_qty_obat" name="ch_qty_obat[]"
                                                                        value="" style="border: none;" readonly>
                                                                </td>
                                                                <td width="80px">
                                                                    <input type="text" class="form-control"
                                                                        id="ch_satuan_obat" name="ch_satuan_obat[]"
                                                                        value=""
                                                                        style="border: none;" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control"
                                                                        id="ch_signa" name="ch_signa[]"
                                                                        value="" readonly>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control"
                                                                        id="ch_cara_pakai" name="ch_cara_pakai[]"
                                                                        value="" readonly  style="border: none;">
                                                                </td>
                                                                <td>
                                                                        <button type="button" class="remove btn btn-xs btn-danger"><i
                                                                        class="fa fa-trash" onclick="deleteRow(this)"></i></button>
                                                                    </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        <div class="kt-font-sm font-italic font-weight-normal card-option-footer text-right px-2"
                                            style="border-left: 3px solid #ffb822;" id="btnDetailOrderResep1"
                                            data-toggle="collapse" data-target="#collapseDetailOrderResep1"
                                            title="click to show item" aria-expanded="true"
                                            aria-controls="collapseDetailOrderResep1">
                                            <span class="kt-label-font-color-1">detail</span>
                                    </div>
                                </div>`;

            // $(".card-resep").append(
            //     `${prescription}`
            // );
        }


        // Hitung Umur
        function getUmurDetail(dateString) {
            var today = new Date();
            var DOB = new Date(dateString);
            var totalMonths = (today.getFullYear() - DOB.getFullYear()) * 12 + today.getMonth() -
                DOB.getMonth();
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

            // toastr.info('Pasein Pinned!', {
            //     timeOut: 600,
            //     // preventDuplicates: true,
            //     positionClass: 'toast-top-right',
            // });
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
                        $('#tr_jenis_kelamin').val(dataregvalue
                            .fr_jenis_kelamin);
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
                        $('#lastTarifDsrHdr').val(dataregvalue.tcmr
                            .fs_last_tarif_dasar);


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

                        $('#pasienName').val(dataregvalue.fr_nama);
                        $('#pasienAddress').val(dataregvalue.fr_alamat);
                        $('#pasienAlergi').val(dataregvalue.fr_alergi);
                        $('#pasienLastTarifDasar').val(dataregvalue.tcmr.fs_last_tarif_dasar);
                        $('#pasienAge').val(isAgeNow);

                        toastr.info('Pasien\t' + `${dataregvalue.fr_nama}` + '\tPinned!', {
                            timeOut: 700,
                            positionClass: 'toast-top-right',
                        });
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
                        sessionStorage.setItem("dataMR", JSON.stringify(
                            mr));
                        sessionStorage.setItem("kdReg", JSON.stringify(
                            kdReg));
                        sessionStorage.setItem("ChartID", JSON.stringify(
                            ChartID));
                        sessionStorage.setItem("UserActive", JSON.stringify(
                            UserActive));


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
                        $('#tr_jenis_kelamin').val(dataregvalue
                            .fr_jenis_kelamin);
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

        //getICDX
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
                                text: xicd.code + ' - ' + xicd.name_id,
                                id: xicd.code + '-' + xicd.name_id,
                            }
                        })
                    };
                },
                cache: true
            }
        });

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
                                text: item.fm_kd_obat + ' - ' + item.fm_nm_obat +
                                    ' - ' + item.qty +
                                    ' ' +
                                    item.fm_satuan_jual,
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
                        $('#qty_obat').val('1');
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
            // $('#ch_hrg_jual').val('');
            // $('.ch_hrg_jual').val('');
            // let prescription = `<div class="card col-xl col-lg col-md col-sm p-2 card-order-resep">
        //                         <div class="text-left font-md label-font-color-3 card-option card-option-header p-1 px-2"
        //                             data-toggle="modal" data-target="#modalResep" data-orderid="1"
        //                                 title="Click to View" style="border-left: 3px solid #ffb822;">
        //                                     <i class="fa fa-prescription mr-1"></i> <b>Resep</b>
        //                                     <span class="kt-font-sm font-weight-normal kt-font-success"></span>
        //                                     <br>
        //                                     <span class="kt-font-sm kt-label-font-color-1"></span>
        //                                     <div class="collapse show" id="collapseDetailOrderResep1"
        //                                         aria-labelledby="headerOrderResep" data-parent="#btnDetailOrderResep1"
        //                                         style="">
        //                                         <table class="">
        //                                             <tbody class="mt-2">`;
            // // document.getElementById('exitModalResep').onclick = function() {
            // // $('#CloseModalResep').hide();
            // if (obatResep != null) {
            //     prescription +=
            //         `
        //            <tr class="mt-2">
        //                <td class="mt-2">
        //                    <input type="hidden" class="form-control"
        //                        id="ch_kd_obat" name="ch_kd_obat[]"
        //                        style="border: none;" value="${obatResep}" readonly>
        //                </td>
        //                <td>
        //                <input type="text" id="ch_nm_obat" class="form-control" name="ch_nm_obat[]"
        //                    value="${namaobatResep}" style="border: none;" readonly>
        //                </td>
        //                <td>
        //                    <input type="hidden" class="form-control"
        //                        id="ch_hrg_jual" name="ch_hrg_jual[]"
        //                        value="${hrg_jual}" readonly>
        //                </td>
        //                <td width="70px">
        //                    <input type="text" class="form-control"
        //                        id="ch_qty_obat" name="ch_qty_obat[]"
        //                        value="${qty_obat}" style="border: none;" readonly>
        //                </td>
        //                <td width="80px">
        //                    <input type="text" class="form-control"
        //                        id="ch_satuan_obat" name="ch_satuan_obat[]"
        //                        value="${satuan_jual_obat}"
        //                        style="border: none;" readonly>
        //                </td>
        //                <td>
        //                    <input type="hidden" class="form-control"
        //                        id="ch_signa" name="ch_signa[]"
        //                        value="${signa_resep}" readonly>
        //                </td>
        //                <td>
        //                    <input type="text" class="form-control"
        //                        id="ch_cara_pakai" name="ch_cara_pakai[]"
        //                        value="${cara_pakai_resep}" readonly  style="border: none;">
        //                </td>
        //                <td>
        //                     <button type="button" class="remove btn btn-xs btn-danger"><i
        //                     class="fa fa-trash" onclick="deleteRow(this)"></i></button>
        //                 </td>
        //            </tr>
        //        `;
            //     prescription += `</tbody>
        //                         </table>
        //                             </div>
        //                                 </div>
        //                                 <div class="kt-font-sm font-italic font-weight-normal card-option-footer text-right px-2"
        //                                     style="border-left: 3px solid #ffb822;" id="btnDetailOrderResep1"
        //                                     data-toggle="collapse" data-target="#collapseDetailOrderResep1"
        //                                     title="click to show item" aria-expanded="true"
        //                                     aria-controls="collapseDetailOrderResep1">
        //                                     <span class="kt-label-font-color-1">detail</span>
        //                                 </div>
        //                             </div>`;
            // } else {
            //     prescription += ``;
            // }
            // };

            $("#resepList").append(
                `
                     <div class="col-md-6 kt-callout-etiket mb-4" id="cardObatList${obatResep}">
                         <div class="border-radius3"
                             style="background-image: linear-gradient(to bottom right, #ECEBF4, #B0A8E5); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 196px;">
                             <div class="kt-portlet__head"
                                 style="min-height: 10px !important;padding: 0px;z-index: 10; border: 0px;">
                                 <div style="top: 0;position: absolute;left: -2; width: 30%;"
                                     class="kt-portlet__head kt-portlet__head--noborder kt-ribbon kt-ribbon--left">
                                     <div class="kt-ribbon__target bg-warning"
                                         style="top: 3px; left: -2px;padding: 1px 8px 1px 10px;background-color: #b3c0eb;color: rgb(163, 0, 101);font-size: 0.96em;">
                                         <label style="margin: 0px;" class="e_brgID">${obatResep}</label>
                                         <span id="infoGEN000000209" data-toggle="popover"
                                             data-placement="bottom" data-content=""
                                             data-original-title="" title=""></span>
                                     </div>
                                 </div>
                                 <div class="head-label">
                                 </div>
                                 <div class="head-toolbar">
                                     <span class="mr-3 bg-lightgreen text-dark px-2"
                                         id="iterGEN000000209"></span>
                                     <div class="kt-portlet__head-actions">
                                         <span data-toggle="tooltip" title="Info">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer infoObat"
                                                 data-infoid="infoGEN000000209">
                                                 <i class="fa fa-info-circle"></i>
                                             </a>
                                         </span>
                                          <span data-toggle="tooltip" title="Edit">
                                                <a href="javascript:;"
                                                    class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                    data-toggle="modal" data-target="#"
                                                    data-isracik="0" data-idobat="${obatResep}" data-nmobat="${namaobatResep}" data-qtyobat="${qty_obat}" data-satuanobat="${satuan_jual_obat}"
                                                    data-signaobat="${signa_resep}" data-carapakaiobat="${cara_pakai_resep}"
                                                    onclick="editObat(this)">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                </span>
                                         <span data-toggle="tooltip" title="Delete">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                data-idobat="${obatResep}"
                                                onclick="deleteRow(this)">
                                                 <i class="fa fa-trash"></i>
                                             </a>
                                         </span>
                                     </div>
                                 </div>
                             </div>
                             <div class="kt-portlet__body" style="padding: 0 10px 0 10px;">
                                 <div class="kt-callout__body">
                                     <div class="kt-callout__content">
                                         <h3 class="kt-callout__title-mod e_brgName text-danger">${namaobatResep}
                                         </h3>
                                         <div class="etiket-body">
                                             <p class="mb-0" id="qty_obat_card_resep"
                                                 style="margin-bottom: 0.5rem;">${qty_obat} ${satuan_jual_obat}</p>
                                             <h6 class="e_signa">${signa_resep}</h6>
                                             <h6 class="e_carapakai mb-0">${cara_pakai_resep}</h6>
                                         </div>
                                         <h6 class="pull-right e_harga mb-0 "> Rp. ${hrg_jual} / ${satuan_jual_obat}</h6>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                        `
            );

            $(".card-resep").append(
                `<tbody class="mt-2" id="cardObatList${obatResep}">
                        <tr class="mt-2">
                            <td class="mt-2">
                                <input type="hidden" class="obatResep form-control" id="ch_kd_obat"
                                    name="ch_kd_obat[]" style="width: 100%" value="${obatResep}" readonly>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_nm_obat" name="ch_nm_obat[]" value="${namaobatResep}">
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_hrg_jual" name="ch_hrg_jual[]" value="${hrg_jual}" readonly>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_qty_obat" name="ch_qty_obat[]" value="${qty_obat}" readonly>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_satuan_obat" name="ch_satuan_obat[]" value="${satuan_jual_obat}" readonly>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_signa" name="ch_signa[]" value="${signa_resep}" readonly>
                            </td>
                            <td>
                                <input type="hidden" class="form-control" id="ch_cara_pakai" name="ch_cara_pakai[]" value="${cara_pakai_resep}" readonly>
                            </td>                             
                        </tr>
                    </tbody>`
            );

            // $("#TESCHCreate").empty();
        });


        function deleteRow(j) {
            var kdObat = $(j).data('idobat');
            // alert(kdObat)
            $('#cardObatList' + kdObat).remove()
        }

        function editObat(v) {
            var kdObat = $(v).data('idobat');
            var nmObat = $(v).data('nmobat');
            var qtyObat = $(v).data('qtyobat');
            var satuanObat = $(v).data('satuanobat');
            var signaObat = $(v).data('signaobat');
            var carapakaiObat = $(v).data('carapakaiobat');
            // alert(qtyObat)
            $('#kode_obat_edit').val(kdObat)
            $('#nm_obat_edit').val(nmObat)
            $('#qty_obat_edit').val(qtyObat)
            $('#satuan_obat_edit').val(satuanObat)
            $('#signa_obat_edit').val(signaObat)
            $('#cara_pakai_obat_edit').val(carapakaiObat)
            $('#editObatResep').modal('show');
        }

        function updateListObatResep() {
            var qty = $('#qty_obat_edit').val()
            var signa = $('#signa_obat_edit').val()
            var cara_pakai = $('#cara_pakai_obat_edit').val()
            // alert(qty)
            $('#qty_obat_edit').val('')
            $('#qty_obat_edit').val(qty)
            $('#qty_obat_card_resep').val(qty)
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
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
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
                        let tindakan = "";

                        for (i in trstdk) {
                            if (trstdk[i].nm_trf != null) {
                                tindakan +=
                                    `<tr><td>${trstdk[i].nm_trf.nm_tindakan}</td></tr>`;
                            } else {
                                tindakan += ``;
                            }

                            // if (trstdk[i].nm_trf == null) {
                            //     $('#TimelineTdk').hide();
                            // }
                        }

                        const images = getValue[getVal].images;
                        let imagesShow = "";
                        for (i in images) {
                            if (images[i] != null && images[i].chart_id == getValue[getVal].chart_id) {
                                imagesShow +=
                                    `<button class="row btn btn-outline-success btn-sm mr-1 mb-1 col" data-toggle="modal" data-target="#showImgChart" onclick="getImagesUpload(this)"
                                    data-bigimage="{{ asset('/storage/images/${images[i].chart_imageName}') }}">
                                        File Attachment - ${images[i].chart_imageName} - ${images[i].chart_note}
                                    </button>`;

                            } else {
                                imagesShow += ``;
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
                                `<button type="button" class="btn btn-outline-danger btn-xs" id="btnDeleteChart" data-is_chart_id="${getValue[getVal].chart_id}" onClick="deleteChart(this)"><i class="fa fa-trash"></i></button>`;
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
                    <div class="left card-body" style="padding-right:0; padding-left:0; padding-top: 7px; max-height: 100%;">
                        <div class="row">
                            <div class="col-12 col-md-12 col-sm-12 order-md-1 order-sm-2" style="width:100%;">
                                <div id="accordion">
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
                                        <button type="" id="isShowCahrtID" class="btn btn-outline-warning btn-xs mr-4">${getValue[getVal].chart_id}</button>
                                        <span style="background-color: #E8E8E8; border-radius: px; padding-top:2px; 
                                            padding-bottom:4px; padding-left:10px; padding-right:20px; color: #002e0a"><b>
                                            ${getValue[getVal].chart_kd_reg}</b>
                                        </span>
                                        <span style="background-color: #E8E8E8; border-radius: px; padding-top:2px; 
                                            padding-bottom:4px; padding-left:10px; padding-right:20px; color: #002e0a"><b>
                                            ${getValue[getVal].chart_mr}</b>
                                        </span>
                                        <span style="background-color: #E8E8E8; border-radius: px; padding-top:2px; 
                                            padding-bottom:4px; padding-left:10px; padding-right:20px; color: #002e0a"><b>
                                            ${getValue[getVal].chart_layanan}</b>
                                        </span>
                                        <span style="background-color: #E8E8E8; border-radius: px; padding-top:2px; 
                                            padding-bottom:4px; padding-left:10px; padding-right:20px; color: #002e0a"><b>
                                            ${getValue[getVal].user}</b>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                         <div class="">
                                        
                                    </div>
                                    <hr>
                                        <div class="form-group ">
                                             <span for=""
                                                style="background-color: #E8E8E8; border-radius: px; padding-top:5px; 
                                                padding-bottom:5px; padding-left:10px; padding-right:90px; color: #002e0a"><b>
                                                    SUBJECTIVE</b></span>
                                            <textarea id="" class="show_chart_S form-control" style="border:none; background-color: #FAFCFE; color: #4A4B90; font-family: arial" rows="6" readonly value="">${getValue[getVal].chart_S}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_O form-group">
                                            <span for=""
                                                style="background-color: #E8E8E8; border-radius: px; padding-top:5px; 
                                                padding-bottom:5px; padding-left:10px; padding-right:90px; color: #002e0a"><b>
                                                    OBJECTIVE</b></span>
                                            <table class="table" style="border:none;">
                                            <tbody style="background-color:#edfafa; border:none">
                                                <tr>
                                                    <td>BW :<b class="text-danger">${getValue[getVal].ttv_BW ?? ''}</b>(Kg)</td>
                                                    <td>BH :<b class="text-danger">${getValue[getVal].ttv_BH ?? ''}</b>(CM)</td>
                                                    <td>BT :<b class="text-danger">${getValue[getVal].ttv_BT ?? ''}</b>(&deg;C)</td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>BPs :<b class="text-danger">${getValue[getVal].ttv_BPs ?? ''}</b>(mmHg)</td>
                                                    <td>BPd :<b class="text-danger">${getValue[getVal].ttv_BPd ?? ''}</b>(mmHg)</td>
                                                    <td>HR  :<b class="text-danger">${getValue[getVal].ttv_HR ?? ''}</b>(x/mnt)</td>
                                                </tr>
                                                <tr>
                                                    <td>RR  :<b class="text-danger">${getValue[getVal].ttv_RR ?? ''}</b>(x/mnt)</td>
                                                    <td>SN  :<b class="text-danger">${getValue[getVal].ttv_SN ?? ''}</b></td>
                                                    <td>SpO2:<b class="text-danger">${getValue[getVal].ttv_SPO2 ?? ''}</b>(%)</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                            <textarea id="" class="show_chart_O form-control" style="border:none; background-color: #FAFCFE; color: #4A4B90; font-family: arial"" rows="6" readonly>${rmvNullO}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_A form-group">
                                             <span for=""
                                                style="background-color: #E8E8E8; border-radius: px; padding-top:5px; 
                                                padding-bottom:5px; padding-left:10px; padding-right:90px; color: #002e0a"><b>
                                                    ASSESMENT</b></span>
                                            <textarea id="" class="show_chart_A form-control mb-3" style="border:none; background-color: #FAFCFE; color: #4A4B90; font-family: arial"" rows="2" readonly>${rmvNullAD}</textarea>
                                            <textarea id="" class="show_chart_A form-control" rows="4" style="border:none; background-color: #FAFCFE; color: #4A4B90; font-family: arial"" readonly>${rmvNullA}</textarea>
                                        </div>
                                        <hr>
                                        <div class="show_chart_P form-group">
                                             <span for=""
                                                style="background-color: #E8E8E8; border-radius: px; padding-top:5px; 
                                                padding-bottom:5px; padding-left:10px; padding-right:90px; color: #002e0a"><b>
                                                    PLAN</b></span>
                                            <textarea id="" class="show_chart_P form-control" rows="6" style="border:none; background-color: #FAFCFE; color: #4A4B90; font-family: arial"" readonly>${rmvNullP}</textarea>
                                            <div class="image_show mt-2 mr-1">${imagesShow}</div>
                                        </div>
                                        <hr>
                                        <div class="tindakan callout callout-danger" id="TimelineTdk">
                                            <table class="table-hover">
                                                <thead class="">
                                                    <tr>
                                                        <th>Tindakan</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TimelineTdk">
                                                    ${tindakan}
                                                </tbody>
                                            </table>
                                        </div>
                                        <hr>
                                        <div class="resep callout callout-success">
                                            <table class="table-hover">
                                                <thead class="">
                                                    <tr>
                                                        <th><i class="fa fa-prescription"></i>&nbsp;Resep</th>
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
                    }
                }
            })
        };

        function getImagesUpload(b) {
            $("#imageShowOff").empty();
            var src = $(b).data('bigimage');
            show_image(src, 700, 842, "Images");
        }

        function show_image(src, width, height, alt) {
            var img = document.createElement("img");
            img.src = src;
            img.width = width;
            img.height = height;
            img.alt = alt;
            $("#imageShowOff").append(img);
        }
        // (function(document) {
        //     "use strict";
        //     const ready = (callback) => {
        //         if (document.readyState != "loading") callback();
        //         else document.addEventListener("DOMContentLoaded", callback);
        //     };
        //     ready(() => {
        //         const img = document.getElementById("imageShowOff");
        //         const simpleModal = document.getElementById("showImgChart");
        //         simpleModal.addEventListener("show.bs.modal", (e) => {
        //             const bigImage = e.relatedTarget.getAttribute('data-bigimage')
        //             img.src = bigImage;
        //             // $('#imageShowOff').append(bigImage)
        //         });
        //     });
        // })(document);

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

            // console.log(chartid);
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
                        const trstdk = chartvalue.trstdk;
                        let tdk = "";
                        for (i in trstdk) {
                            if (trstdk[i].nm_trf != null) {
                                tdk +=
                                    `<option value="${trstdk[i].nm_tarif}" selected>${trstdk[i].nm_trf.nm_tindakan}</option>`;
                            } else {
                                tdk += ``;
                            }
                        }
                        // console.log(chartvalue);
                        $('#chart_S').val(chartvalue.chart_S)
                        $('#chart_O').val(chartvalue.chart_O)
                        $('#chart_A').val(chartvalue.chart_A)
                        $('#chart_A_diagnosa').val(chartvalue.chart_A_diagnosa)
                        $('#chart_P').val(chartvalue.chart_P)

                        $('#ttv_BW').val(chartvalue.ttv_BW)
                        $('#ttv_BH').val(chartvalue.ttv_BH)
                        $('#ttv_BPs').val(chartvalue.ttv_BPs)
                        $('#ttv_BPd').val(chartvalue.ttv_BPd)
                        $('#ttv_BT').val(chartvalue.ttv_BT)
                        $('#ttv_HR').val(chartvalue.ttv_HR)
                        $('#ttv_RR').val(chartvalue.ttv_RR)
                        $('#ttv_SN').val(chartvalue.ttv_SN)
                        $('#ttv_SPO2').val(chartvalue.ttv_SPO2)
                        $('#nm_tarif').empty()
                        $('#nm_tarif').append(`${tdk}`)

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

            var ttv_BW = $('#ttv_BW').val();
            var ttv_BH = $('#ttv_BH').val();
            var ttv_BPs = $('#ttv_BPs').val();
            var ttv_BPd = $('#ttv_BPd').val();
            var ttv_BT = $('#ttv_BT').val();
            var ttv_HR = $('#ttv_HR').val();
            var ttv_RR = $('#ttv_RR').val();
            var ttv_SN = $('#ttv_SN').val();
            var ttv_SPO2 = $('#ttv_SPO2').val();
            var getTarif = $('#nm_tarif').val();
            var nm_tariff = [];
            for (i = 0; i < getTarif.length; i++) {
                nm_tariff.push([getTarif[i].nm_tarif]);
            }

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
                    ttv_BW: ttv_BW,
                    ttv_BH: ttv_BH,
                    ttv_BPs: ttv_BPs,
                    ttv_BPd: ttv_BPd,
                    ttv_BT: ttv_BT,
                    ttv_HR: ttv_HR,
                    ttv_RR: ttv_RR,
                    ttv_SN: ttv_SN,
                    ttv_SPO2: ttv_SPO2,
                    nm_tarif: nm_tariff
                },
                cache: false,
                success: function(dataResult) {
                    // $('.close').click();
                    toastr.success('Saved!', 'Data Berhasil Diperbarui!', {
                        timeOut: 2000,
                        preventDuplicates: true,
                        positionClass: 'toast-top-right',
                    });
                    $('#chart_S').val('');
                    $('#chart_O').val('');
                    $('#chart_A').val('');
                    $('#chart_A_diagnosa').val('');
                    $('#chart_P').val('');

                    $('#ttv_BW').val('');
                    $('#ttv_BH').val('');
                    $('#ttv_BPs').val('');
                    $('#ttv_BPd').val('');
                    $('#ttv_BT').val('');
                    $('#ttv_HR').val('');
                    $('#ttv_RR').val('');
                    $('#ttv_SN').val('');
                    $('#ttv_SPO2').val('');

                    getTimeline();

                    $('#kumpulanButton').empty();
                    $('#createSOAPP').show();
                    $('#updateChart').show();


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

        // Upload Image

        $(document).ready(function() {
            var fileArr = [];
            $("#images").change(function() {
                // check if fileArr length is greater than 0
                if (fileArr.length > 0) fileArr = [];

                $('#image_preview').html("");
                var total_file = document.getElementById("images").files;
                if (!total_file.length) return;
                for (var i = 0; i < total_file.length; i++) {
                    if (total_file[i].size > 1048576) {
                        return false;
                    } else {
                        fileArr.push(total_file[i]);
                        $('#image_preview').append("<div class='img-div' id='img-div" + i + "'><img src='" +
                            URL.createObjectURL(event.target.files[i]) +
                            "' class='img-responsive image img-thumbnail' title='" + total_file[i]
                            .name + "'><div class='middle'><button id='action-icon' value='img-div" +
                            i + "' class='btn btn-danger' role='" + total_file[i].name +
                            "'><i class='fa fa-trash'></i></button></div></div>");
                    }
                }
            });

            $('body').on('click', '#action-icon', function(evt) {
                var divName = this.value;
                var fileName = $(this).attr('role');
                $(`#${divName}`).remove();

                for (var i = 0; i < fileArr.length; i++) {
                    if (fileArr[i].name === fileName) {
                        fileArr.splice(i, 1);
                    }
                }
                document.getElementById('images').files = FileListItem(fileArr);
                evt.preventDefault();
            });

            function FileListItem(file) {
                file = [].slice.call(Array.isArray(file) ? file : arguments)
                for (var c, b = c = file.length, d = !0; b-- && d;) d = file[b] instanceof File
                if (!d) throw new TypeError("expected argument to FileList is File or array of File objects")
                for (b = (new ClipboardEvent("")).clipboardData || new DataTransfer; c--;) b.items.add(file[c])
                return b.files
            }
        });
    </script>
@endpush
