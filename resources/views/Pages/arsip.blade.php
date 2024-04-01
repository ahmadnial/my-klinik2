@extends('pages.master')
@section('mytitle', 'Arsip')
@section('konten')
    <div id="kt-content" class="" style="background-color: white;">
        <div class="">
            <div class="scrollbar-dusty square1 thin scroll-y pt-3 pr-2 pl-2" style="overflow-x: hidden;">
                <div class="">
                    <div class="row mb-3">

                    </div>
                    <div class="p-2" id="arsip">
                        <div class="row">
                            <div class="col-md-3 pl-0 pr-2" style="background-color: rgb(238, 244, 250)">
                                <div class="col p-2">
                                    <div class="form-group mb-0">
                                        <div class="">
                                            <select class="col form-control" id="searchRegister" style="width: 100%"
                                                autofocus="" autocomplete="off" onchange="getData()">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="listHistoryPx" style="max-height: 30vh; overflow-y:scroll">
                                        {{-- <div class="form-group mb-0 scrollbar-dusty square1 thin scroll-y mt-2"
                                            id="listsearchRegArc"
                                            style="max-height: 180px; border: 1px solid rgb(255, 254, 248);">
                                            <div class="kt-portlet kt-iconbox kt-iconbox--wave p-1 m-1 listRegArc"
                                                id="RG00326354" style="background-color: rgb(77, 77, 77);">
                                                <div class="kt-portlet__body p-1">
                                                    <div class="kt-iconbox__desc kt-font-bolder">
                                                        <div class="row">
                                                            <span class="kt-iconbox__content col-6">RG00326354</span>
                                                            <span
                                                                class="kt-iconbox__content col-6 kt-font-regular text-right">09-03-2024</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="kt-iconbox__content col-6 kt-font-regular"><em>Register
                                                                    Aktif</em></span>
                                                            <span
                                                                class="kt-iconbox__content col-6 kt-font-regular text-right">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="kt-portlet kt-iconbox kt-iconbox--wave p-1 m-1 listRegArc"
                                                id="RG00326352" style="background-color: rgb(197, 226, 251);">
                                                <div class="kt-portlet__body p-1">
                                                    <div class="kt-iconbox__desc kt-font-bolder">
                                                        <div class="row">
                                                            <span class="kt-iconbox__content col-6">RG00326352</span>
                                                            <span
                                                                class="kt-iconbox__content col-6 kt-font-regular text-right">09-03-2024</span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="kt-iconbox__content col-6 kt-font-regular"><em>Tgl
                                                                    Keluar</em></span>
                                                            <span
                                                                class="kt-iconbox__content col-6 kt-font-regular text-right">09-03-2024</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    {{-- <div class="form-group mt-2 mb-0">
                                        <select class="form-control kt-font-bolder" id="filterLabelType" style="">
                                            <option value="">Filter Semua Transaksi</option>
                                            <option value="01">SOAP</option>
                                            <option value="02">Vita Sign</option>
                                            <option value="03">Prescription</option>
                                            <option value="04">Medication</option>
                                            <option value="05">Lab Order</option>
                                            <option value="06">Lab Result</option>
                                            <option value="07">Rad Order</option>
                                            <option value="08">Rad Result</option>
                                            <option value="09">Medical Procedure</option>
                                            <option value="10">Med-Procedure Plan</option>
                                            <option value="11">PA Result</option>
                                            <option value="12">Assesment Awal</option>
                                            <option value="13">ADIME</option>
                                            <option value="14">Other Documents</option>
                                            <option value="15">Note Drawing</option>
                                            <option value="17">Administrative</option>
                                            <option value="18">Resume Medis</option>
                                            <option value="19">SBAR</option>
                                        </select>
                                    </div> --}}
                                    <div class="kt-portlet__head kt-portlet__head--noborder p-0" id="pasienArsip"
                                        style="margin-top: -8px;">
                                        <div class="kt-portlet__head-label">
                                            <h3 class="kt-portlet__head-title">

                                            </h3>
                                        </div>
                                        <div class="kt-portlet__head-label">
                                            <button type="button"
                                                class="btn btn-outline-brand btn-icon btn-sm btn-icon-md border-radius3 ml-2"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon-more"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                                                <a class="dropdown-item pointer" onclick="SendLearnAllArsip()"><i
                                                        class="la la-hourglass-2"></i>Process All Period Data</a>
                                                <a class="dropdown-item pointer" id="btnUploaderArc" style=""
                                                    onclick="OpenUploader()"><i class="la la-upload"></i>Upload Document</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body">
                                        <form id="coverPasienArc">
                                            <div class="kt-widget kt-widget--user-profile-2 px-2">
                                                <div class="row px-2">
                                                    <i class="fa fa-user fa-3x"></i>
                                                    <div class="kt-widget__media">
                                                        {{-- <div
                                                            class="kt-widget__pic kt-widget__pic--danger kt-font-danger kt-font-boldest kt-font-light kt-hidden">
                                                            ARSIP
                                                        </div> --}}
                                                    </div>
                                                    <div class="ml-3 pr-3" id="infoPasienArc" style="z-index: 10;"
                                                        style="font-size: 200px">
                                                        <h2>
                                                            <span class="text-primary" id="pasienNameArc"></span>
                                                        </h2>
                                                        <span class="pt-0 text-md" id="pasienNoMr"></span><br>
                                                        {{-- <br> --}}
                                                        <span class="pt-0 text-info" id="alamatArc"></span>
                                                    </div>
                                                </div>
                                                {{-- <div class="kt-widget__body px-2">
                                                    <div class="kt-widget__section p-1"></div>
                                                    <div class="kt-widget__content">
                                                        <div class="col-6">
                                                            <div class="kt-widget__stats kt-margin-r-5 pb-0">
                                                                <div class="kt-widget__icon">
                                                                    <i class=""></i>
                                                                </div>
                                                                <div class="kt-widget__details">
                                                                    <span class="kt-widget__title">Tgl Masuk</span>
                                                                    <span class="kt-widget__title"
                                                                        id="tglMasukPsnArc">09-03-2024</span>
                                                                </div>
                                                            </div>
                                                            <div class="kt-widget__stats pb-0">
                                                                <div class="kt-widget__icon">
                                                                    <i
                                                                        class="flaticon2-calendar-5 kt-font-success fa-2x"></i>
                                                                </div>
                                                                <div class="kt-widget__details">
                                                                    <span class="kt-widget__title text-danger">Tgl
                                                                        Keluar</span>
                                                                    <span class="kt-widget__title text-danger"
                                                                        id="tglKeluarPsnArc">09-03-2024</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <div id="qrcodeReg" class="border p-2" title="RG00326352">
                                                                <canvas width="60" height="60"
                                                                    style="display: none;"></canvas><img
                                                                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAnJJREFUaEPtWkFuwzAMWz63XbaPrO/ZS3ba6zIEqAvXkELSloMGUa9xZVFiKMnO8v75vb4F/f5+f0xLH183aYdiR/0fs8lyWcBedpiolUwwGa7X1Bm0/oueM75ta2o7jwwnYDZ8VQRPm2FGLCxqqoBRTD1K9/q37WdSutdgAr6nsFd8TpVhhiU1pRWVZmx71WAapRmnEnCjYqeltEcvT6Wt1rLXBtV4MHREZSkiOxE2EnAZHma2ljV1mawhSqOGpX1+eC+dgO8RQJNTb8NCZVilibUeAWgFBK1nxFP1e9oBgPKueoGYAnhd17AjHi/aquMjAooyviRgFKKO5y+VYesQj6EUAoEEaU9J0f7e3uh/TwcAaHLZc7BXsZn6bNlOwEZd9948SbRQZNHzqDrMTE7uAYCi0ggQep6Aq6sZq1FRA+jpkDk8oGF8rxoVg4wyj4AoPqj71Otha8lIfQJu7nNGRKa35Hm9/EOlGaqhuhk1zqFmbmQwScBtdJXrk9NmWFVBREHGHrKBXie29TUpzTiIhgemJjIVAPXSDANrG9cFrFCKWaswgGl6mCrCrJGGBwZoWfOygGd9xaMqthUgRks8MfM0BLaWSlZVB5Gzqj2K0pfNcG+JqGfc6IyMvBYenmnfaTHOIgoyNtSGJAG3xzBKjYx4LRiRHHl1pn3UwjiOVFoJ9raWaTMT8AxKI3Fq97QyFWFj2+eQDEc4G2EjASuNv6WUjEoztRWdgqqC+DQPW1/xMJNOAt4pC2o3dHiGVcogB9VGAR3rjBwfHd5aMu9wAm5uMkIyrNLYWj9ypYIUfuS2QbpMUwKRgI1o9QpYVIb/ATOtL2f3BC57AAAAAElFTkSuQmCC"
                                                                    style="display: block;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="kt-widget__item">
                                                        <div class="kt-widget__contact">
                                                            <span class="kt-widget__label">Jaminan</span>
                                                            <a href="javascript:;" class="kt-widget__data"
                                                                id="jmnPsnArc">JAMINAN NASIONAL PBI</a>
                                                        </div>
                                                        <div class="kt-widget__contact">
                                                            <span class="kt-widget__label">Layanan</span>
                                                        </div>
                                                        <div id="listLynArc">
                                                            <div class="kt-widget__contact px-2">
                                                                <span class="kt-widget__data">UNIT GAWAT DARURAT</span>
                                                                <span class="kt-widget__data">dr.F.Gusti Ari
                                                                    Setyawan</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="kt-widget__footer hide">

                                                </div>
                                            </div>
                                        </form>
                                        <!--end::Widget -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9 kt-section scroll-y scrollbar-dusty square1 thin pl-2" id="listArsip"
                                style="overflow-x: hidden; max-height: 90vh;"><a class="btn-scroll-top"
                                    style="position: fixed; right: 27px;"><i
                                        class="fa fa-chevron-circle-up fa-lg text-warning"></i></a>
                                <div class="showlistChart">
                                    {{-- append --}}
                                </div>

                                <div id="" class="isTimelineObatPulang">
                                    {{-- append --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Print Lainnya -->
        <div class="modal fade modalPrintArsip" tabindex="-1" role="dialog" id="modalPrintArsip">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Print Preview</h5>
                        <div class="col">
                            <div class="pull-right">
                                <i class="flaticon2-fax btn-icon-only-blue" title="Print"
                                    style="font-size: large;cursor: pointer;" id="btnModalPrintArsip"></i>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body" id="contentPrintArsip">
                        <div id="headerPrintArsip" style="width: 100%" class="mb-3"></div>
                        <div id="bodyPrintArsip">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->

        <!-- Modal Print Assesment -->
        <div class="modal fade modalPrint" tabindex="-1" role="dialog" id="modalPrint">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Print Preview</h5>
                        <div class="col">
                            <div class="pull-right">
                                <i class="flaticon2-fax btn-icon-only-blue" title="Print"
                                    style="font-size: large;cursor: pointer;" id="print2"></i>
                            </div>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="cetakan" style="background-color: white;">
                            <div class="hal-cetak">
                                <div class="cetak_p">
                                    <div id="header_print" style="width: 100%"></div>
                                    <div id="content_print" aria-disabled="true" style="width: 100%"></div>
                                    <img src="" alt="" id="showIMG">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal uploadfile fade" id="modalUploadFile">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div style="right: 0px; z-index: 100; position: absolute">
                        <input type="image" class="i-btn3" src="./assets/media/icon/delete_w.png"
                            data-dismiss="modal">
                    </div>
                    <div class="modal-header bg-header-toggle">
                        <h4 class="modal-title" style="color: white">
                            Upload File for
                            <span id="regIdUploadStat" class="ml-1">RG00326352</span>
                        </h4>
                        <!--button type="button" class="close" data-dismiss="modal"></button-->
                    </div>
                    <div class="modal-body">
                        <div class="dropzone dz-clickable" id="attachmentArsip" style="margin-bottom: 5px">
                            <div class="dz-default dz-message"><span><i class="add_new flaticon2-image-file fa-3x"></i><i
                                        class="add_more flaticon2-image-file fa-3x"></i>
                                    <h5 class="mt-3">Klik atau drag file disini</h5>
                                </span></div>
                        </div>
                        <div class="col-md-12 text-right">
                            <button style="border-radius: 3px" type="button" id="upload-attachment"
                                class="btn btn-info" disabled=""><i class="fa fa-cloud-upload-alt"></i>
                                Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hide" id="divPrintHistory">
            <div id="headerPrintMC" style="margin-bottom: 5px !important;"></div>
            <div class="col-lg-12 hide p-3" id="printHistory">

            </div>
        </div>

    @endsection

    @push('scripts')
        <script>
            var path = "{{ route('regSearchArs') }}";

            $('#searchRegister').select2({
                placeholder: 'Nama Pasien',
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
                $('.isTimelineObatPulang').empty();
                var fs_mr = $('#searchRegister').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getListChart') }}/" + fs_mr,
                    type: 'GET',
                    data: {
                        'fs_mr': fs_mr
                    },
                    success: function(isdata2) {
                        // var json = isdata2;
                        $('.listHistoryPx').empty();
                        $('.showlistChart').empty();
                        $.each(isdata2, function(key, datavalue) {
                            document.getElementById("pasienNameArc").innerText = (datavalue.fs_nama);
                            document.getElementById("pasienNoMr").innerText = (datavalue.fs_mr);
                            document.getElementById("alamatArc").innerText = (datavalue.fs_alamat);

                            if (datavalue.chart_kd_reg == null) {
                                $('.listHistoryPx').append(`<div class="form-group mb-0 scrollbar-dusty square1 thin scroll-y mt-2"
                                            id="listsearchRegArc"
                                            style="max-height: 180px; border: 2px solid rgb(226, 229, 236);">
                                            <div class="kt-portlet kt-iconbox kt-iconbox--wave p-1 m-1 listRegArc"
                                                id="RG00326354" style="background-color: rgb(252, 225, 174);">
                                                <div class="kt-portlet__body p-1">
                                                    <div class="kt-iconbox__desc kt-font-bolder">
                                                        <div class="row">
                                                            <span class="col-6">History Not Found.</span>
                                                            <span
                                                                class="col-6 kt-font-regular text-right"></span>
                                                        </div>
                                                        <div class="row">
                                                            <span class="col-6 kt-font-regular"><em></em></span>
                                                            <span
                                                                class="col-6 kt-font-regular text-right">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>`);
                            } else {
                                $('.listHistoryPx').append(`<div class="cardReg${datavalue.chart_id} form-group mb-0 scrollbar-dusty square1 thin scroll-y mt-2" id="listsearchRegArc"
                                   style="max-height: 180px; border: 2px solid rgb(226, 229, 236);" data-chartid="${datavalue.chart_id}" data-kdreg="${datavalue.chart_kd_reg}" onClick="getHistory(this)">
                                   <div class="kt-portlet kt-iconbox kt-iconbox--wave p-1 m-1 listRegArc"
                                       id="RG00326354" style="background-color: rgb(252, 225, 174);">
                                       <div class="kt-portlet__body p-1">
                                           <div class="kt-iconbox__desc kt-font-bolder">
                                               <div class="row">
                                                   <span class="col-6">${datavalue.chart_kd_reg}</span>
                                                   <span
                                                       class="col-6 kt-font-regular text-right">${datavalue.chart_tgl_trs}</span>
                                               </div>
                                               <div class="row">
                                                   <span class="col-6 kt-font-regular"><em>${datavalue.chart_layanan}</em></span>
                                                   <span
                                                       class="col-6 kt-font-regular text-right">-</span>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                                </div>`);
                            }

                        })
                    }
                })
            };

            function getHistory(j) {
                var chart_id = $(j).data('chartid');
                // alert(chart_id)
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ url('getListChartDetail') }}/" + chart_id,
                    type: 'GET',
                    data: {
                        'chart_id': chart_id
                    },
                    success: function(isListChartDetail) {
                        $.each(isListChartDetail, function(key, datavalue) {
                            $('.showlistChart').empty();
                            $('.isTimelineObatPulang').empty();

                            const trstdk = datavalue.trstdk;
                            let tindakan = "";
                            for (i in trstdk) {
                                if (trstdk[i].nm_trf != null) {
                                    tindakan +=
                                        `<label class="pl-2">&#129174; ${trstdk[i].nm_trf.nm_tindakan ?? ''}</label>`;
                                } else {
                                    $('.tindakanShowOff').empty();
                                    tindakan += ``;
                                }
                            }

                            const resep = datavalue.resep;
                            let resepShow = "";
                            for (i in resep) {
                                if (resep[i] != null) {
                                    resepShow +=
                                        `<label class="pl-2">&#129174; ${resep[i].ch_nm_obat + - + resep[i].ch_qty_obat + ' ' + resep[i].ch_satuan_obat + '-' + resep[i].ch_cara_pakai ?? ''}</label>`;
                                } else {
                                    resepShow += ``;
                                }
                            }

                            // let obtplg = "";
                            // let showResepOff = datavalue.arsipobatpulang.ketHTML;
                            // let decode = $('<div>').html(showResepOff).text()
                            // let ShowTimelineResep = decode.replace(/[["","",""]/g, "");
                            // obtplg +=
                            //     `<label class="pl-2">&#129174; ${showResepOff} </label>`;

                            const obatPulang = datavalue.arsipobatpulang;
                            let obtplg = "";
                            for (i in obatPulang) {
                                if (obatPulang[i] != null && obatPulang[i].labelType ==
                                    'medication (Obat Pulang)') {
                                    let showResepOff = obatPulang[i].ketHTML;
                                    let decode = $('<div>').html(showResepOff).text()
                                    let ShowTimelineResep = decode.replace(/[["","",""]/g, "");
                                    obtplg +=
                                        `<div class="kt-portlet__body" id="content${datavalue.chart_id}">
                                        <div class="kt-widget kt-widget--user-profile-3 border">
                                            <div class="container-fluid mt-2">
                                            <h5>Medication (Obat Pulang)</h5>
                                            <table class="col table table-hover table-bordered">
                                                <thead class="" style="background-color: rgb(227, 239, 253)">
                                                    <tr>
                                                        <th>Obat</th>
                                                        <th>Qty</th>
                                                        <th>Satuan</th>
                                                        <th>Cara Pakai</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                   <label class="pl-2">&#129174; ${ShowTimelineResep ?? ''} </label>
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>`;
                                } else {
                                    obtplg += ``;
                                }
                            }



                            $('.showlistChart').append(`<div class="kt-portlet shadow-sm border border-radius3 p-2 mb-4 ">
                                        <div class="kt-portlet__body" id="content${datavalue.chart_id}">
                                            <div class="kt-widget kt-widget--user-profile-3 border">
                                                <div class="kt-widget__top">
                                                    <div class="kt-widget__content pl-0 pb-1" data-reffid="CH-2403-001587"
                                                        data-labeltypeid="01" data-regid="${datavalue.chart_kd_reg}">
                                                        <div class="kt-widget__head">
                                                            <a href="javascript:;"
                                                                class="kt-widget__username bg-arsip-soap kt-font-regular kt-font-lg text-light px-2 pb-1"
                                                                style="height: auto !important;">
                                                                SOAP
                                                            </a>
                                                            <div class="kt-widget__action">
                                                            </div>
                                                        </div>

                                                        <div class="kontenLabel mt-2 ml-2 mr-2">
                                                            <div class="" style="font-weight: 600;">
                                                                <div class="htmlResult" data-reffid="CH-2403-001587"
                                                                    data-labeltypeid="01" data-regid="RG00326352">
                                                                    <table class="table table-bordered" width="100%"
                                                                        style="border-color: rgb(204, 228, 255)">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-left"
                                                                                    style="background-color: rgb(227, 239, 253)"
                                                                                    width="100%">
                                                                                    Subjective</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr name="1S">
                                                                                <td colspan="2" class="p-2">
                                                                                    <p class="text-mc-black">${datavalue.chart_S ?? ''}</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-left" width="10%"
                                                                                    style="background-color: rgb(227, 239, 253)">
                                                                                    Objective</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr name="1O">
                                                                                <td colspan="2" class="p-2">
                                                                                    <p class="text-mc-black">
                                                                                        ${datavalue.chart_O ?? ''} <br>
                                                                                        &#11166; Berat Badan : <b class="text-danger">${datavalue.ttv_BW ?? ''}</b> Kg<br>
                                                                                        &#11166; Tinggi Badan : <b class="text-danger">${datavalue.ttv_BT ?? ''}</b> Cm<br>
                                                                                        &#11166; TD Sistole : <b class="text-danger"> ${datavalue.ttv_BPs ?? ''}</b> mmHg<br>
                                                                                        &#11166; TD Diastole : <b class="text-danger">${datavalue.ttv_BPd ?? ''}</b> mmHg<br>
                                                                                        &#11166; Suhu : <b class="text-danger">${datavalue.ttv_BT ?? ''}</b> &deg;C<br>
                                                                                        &#11166; Nadi : <b class="text-danger">${datavalue.ttv_HR?? ''}</b> x/menit<br>
                                                                                        &#11166; Respirasi : <b class="text-danger">${datavalue.ttv_RR ?? ''}</b> x/menit<br>
                                                                                        &#11166; Skala Nyeri : <b class="text-danger">${datavalue.ttv_SN ?? ''}</b> <br>
                                                                                        &#11166; Saturasi : <b class="text-danger">${datavalue.ttv_SPO2 ?? ''}</b> %<br>
                                                                                    </p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-left" width="10%"
                                                                                    style="background-color: rgb(227, 239, 253)">
                                                                                    Assesment</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr name="1A">
                                                                                <td colspan="2" class="p-2">
                                                                                    <p class="text-mc-black">${datavalue.chart_A_diagnosa ?? ''}</p>
                                                                                    <br>
                                                                                    <p class="text-mc-black">${datavalue.chart_A ?? ''}</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-left" width="10%"
                                                                                    style="background-color: rgb(227, 239, 253)">
                                                                                    Plan</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr name="1P">
                                                                                <td colspan="2" class="p-2">
                                                                                    <p class="text-mc-black">${datavalue.chart_P ?? ''}</p>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                        <div class="card col border-secondary p-2 pl-3 mb-2 ml-2"
                                                                                            style="background-color: rgb(248, 240, 229)">
                                                                                            <div><u><b>Prescription (Resep)</b></u>
                                                                                            </div>
                                                                                            ${resepShow}
                                                                                        </div>

                                                                                        <div class="tindakanShowOff card col border-secondary p-2 pl-3 mb-2 ml-2"
                                                                                            style="background-color: rgb(248, 240, 229)">
                                                                                            <div><u><b>Tindakan</b></u>
                                                                                            </div>
                                                                                            ${tindakan}
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-0 mb-2 px-3 py-1 bg-light" style="">
                                                    <div class="col-6 text-left kt-label-font-color-1">
                                                        <i class="fa fa-calendar-day mr-1"></i>${datavalue.chart_tgl_trs}
                                                        <i class="fa fa-user ml-2 mr-1"></i>${datavalue.user}
                                                        <i class="fa fa-home ml-2 mr-1"></i>${datavalue.chart_layanan}
                                                    </div>
                                                    <div class="col-6" mt-2>
                                                        ${datavalue.chart_kd_reg}
                                                        <i class="fa fa-id ml-2 mr-1"></i>${datavalue.chart_id}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`)

                            $(".isTimelineObatPulang").append(
                                `${obtplg}`
                            )
                        })
                    }
                })
            }

            function getLabel() {

            }
        </script>
    @endpush
