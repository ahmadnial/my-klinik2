@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success btn-sm float-right" data-toggle="modal"
                    data-target="#AddTemplate">Add
                    template</button>
                <h3 class="card-title">Template Order</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="example1" class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th>Nama Template</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($getAllTemplate as $tz)
                            <tbody>
                                <td>{{ $tz->nm_to }}</td>
                                <td>{{ $tz->to_user }}</td>
                                <td><button class="btn btn-xs btn-success" data-toggle="modal"data-target=""
                                        data-kdto="{{ $tz->kd_to }}" onclick="editTemplate(this)"><i
                                            class="fa
                                            fa-edit"></i></button>
                                    <button class="btn btn-xs btn-danger" data-toggle="modal"data-target=""
                                        onclick="deleteTemplate(this)" data-kdto="{{ $tz->kd_to }}"
                                        data-nmto="{{ $tz->nm_to }}"><i
                                            class="fa
                                            fa-trash"></i></button>
                                </td>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="AddTemplate">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Template Order Resep</h4>
                    <button type="button" class="close" id="CloseModalResep" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="add-template-resep" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="nm_to">
                                <input type="text" class="form-control mb-3" id="nm_to" name="nm_to"
                                    placeholder="Nama Template Order..." required>
                            </div>
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
                                <div class="resep-content">
                                    <div class="row" id="resepList" style="padding: 5px;">
                                    </div>
                                </div>
                                <input type="hidden" name="kd_to" value="{{ $kdTo }}">
                                {{-- <div class="resep-content">
                                    <div class="row" id="resepList" style="padding: 5px;">
                                        <div class="col-md-6 kt-callout-etiket">
                                            <div class="border-radius3"
                                                style="background-color: rgb(244, 240, 255); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 166px;">
                                                <div class="kt-portlet__head"
                                                    style="min-height: 10px !important;padding: 0px;z-index: 10; border: 0px;">
                                                    <div style="top: 0;position: absolute;left: -2; width: 30%;"
                                                        class="kt-portlet__head kt-portlet__head--noborder kt-ribbon kt-ribbon--left">
                                                        <div class="kt-ribbon__target bg-warning"
                                                            style="top: 3px; left: -2px;padding: 1px 8px 1px 10px;background-color: #b3c0eb;color: rgb(163, 0, 101);font-size: 0.96em;">
                                                            <label style="margin: 0px;" class="e_brgID">GEN000000209</label>
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
                                                                    data-toggle="modal" data-target="#modalAddObat"
                                                                    data-isracik="0" data-brgid="GEN000000209">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            </span>
                                                            <span data-toggle="tooltip" title="Delete">
                                                                <a href="javascript:;"
                                                                    class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                                    onclick="deleteItem('GEN000000209')">
                                                                    <i class="fa fa-trash"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body" style="padding: 0 10px 0 10px;">
                                                    <div class="kt-callout__body">
                                                        <div class="kt-callout__content">
                                                            <h3 class="kt-callout__title-mod e_brgName ">CEFIXIM 200 MG
                                                            </h3>
                                                            <div class="etiket-body">
                                                                <p class="kt-callout__desc e_qty mb-0"
                                                                    style="margin-bottom: 0.5rem;">1 TABLET</p>
                                                                <h6 class="e_signa"></h6>
                                                                <h6 class="e_carapakai mb-0"></h6>
                                                            </div>
                                                            <h6 class="pull-right e_harga mb-0 "> Rp. 2.331</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="ResepCreate"></div>
                    <div class="modal-footer">
                        <div class="float-right mb-3">
                            <button type="submit" id="exitModalResep" class="btn btn-sm btn-success">add</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>


    {{-- Modal Edit --}}
    <div class="modal fade" id="EditTemplateResep">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Template Order Resep</h4>
                    <button type="button" class="close" id="CloseModalResep" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="edit-template" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="nm_to">
                                <input type="text" class="form-control mb-3" id="nm_to_e" name="nm_to"
                                    placeholder="Nama Template Order..." required>
                            </div>
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
                                                    <select type="text" class="obatResep form-control"
                                                        id="obatResep_e" style="width: 100%"
                                                        onchange="pasteToE()"></select>
                                                </td>
                                                <input type="hidden" id="namaObatResep_e">
                                                <td>
                                                    <input type="text" class="form-control" id="qty_obat_e">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="satuan_jual_obat_e"
                                                        readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="signa_resep_e">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" id="cara_pakai_resep_e">
                                                </td>
                                                <input type="hidden" class="ch_hrg_jual_e" id="ch_hrg_jual_e">
                                                <td>
                                                    <a class="btn btn-success btn-sm ml-2" id="addItemObatReseppE"><i
                                                            class="fa fa-plus"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="resepID callout callout-warning mt-5">
                                <div class="resep-content">
                                    <div class="row" id="resepList_e" style="padding: 5px;">
                                    </div>
                                </div>
                                <input type="hidden" name="kd_to" id="kd_to_e" value="">
                            </div>
                        </div>
                    </div>
                    <div class="ResepCreate_e"></div>
                    <div class="modal-footer">
                        <div class="float-right mb-3">
                            <button type="submit" id="exitModalResep" class="btn btn-sm btn-success">Update</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>

    {{-- Modal confirm delete --}}
    <div class="modal fade" id="delTemplate">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-nial">
                    <h4 class="modal-title">Konfirmasi Delete</h4>
                    <button type="button" class="close" id="CloseModalResep" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="delete-template" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="nm_to">
                                Delete Template : <input type="text" class="form-control-xs text-danger"
                                    id="shownmtemplate" name="" readonly style="border: none">
                            </div>
                            <input type="hidden" name="kd_to" id="kd_to_d" value="">
                        </div>
                    </div>
                    <div class=""></div>
                    <div class="modal-footer">
                        <div class="float-right mb-3">
                            <button type="submit" id="exitModalResep" class="btn btn-sm btn-danger">Delete</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    </form>
@endsection

@push('scripts')
    <script>
        function deleteTemplate(d) {
            var kdto = $(d).data('kdto');
            var nmto = $(d).data('nmto');
            $('#delTemplate').modal('show');
            $('#shownmtemplate').val(nmto)
            $('#kd_to_d').val(kdto)

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getDetailTemplate') }}/" + kdto,
                type: "GET",
                data: {
                    kdto: kdto
                },
                success: function(getDetailTemp) {

                }
            });
        }

        function editTemplate(f) {
            var kdto = $(f).data('kdto');
            $('#EditTemplateResep').modal('show');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('getDetailTemplate') }}/" + kdto,
                type: "GET",
                data: {
                    kdto: kdto
                },
                success: function(getDetailTemp) {
                    $('#kd_to_e').val(kdto)
                    $("#resepList_e").empty();
                    $(".ResepCreate_e").empty();
                    $.each(getDetailTemp, function(key, datavalue) {
                        $('#nm_to_e').val(datavalue.nm_to)
                        $("#resepList_e").append(`
                        <div class="col-md-6 kt-callout-etiket mb-4 cardObatList${datavalue.kd_obat_to}" id="">
                         <div class="border-radius3"
                             style="background-color: rgb(244, 240, 255); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 196px;">
                             <div class="kt-portlet__head"
                                 style="min-height: 10px !important;padding: 0px;z-index: 10; border: 0px;">
                                 <div style="top: 0;position: absolute;left: -2; width: 30%;"
                                     class="kt-portlet__head kt-portlet__head--noborder kt-ribbon kt-ribbon--left">
                                     <div class="kt-ribbon__target bg-warning"
                                         style="top: 3px; left: -2px;padding: 1px 8px 1px 10px;background-color: #b3c0eb;color: rgb(163, 0, 101);font-size: 0.96em;">
                                         <label style="margin: 0px;" class="e_brgID">${datavalue.kd_obat_to}</label>
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
                                                 data-infoid="">
                                                 <i class="fa fa-info-circle"></i>
                                             </a>
                                         </span>
                                         <span data-toggle="tooltip" title="Edit">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                 data-toggle="modal" data-target="#modalAddObat"
                                                 data-isracik="0" data-brgid="">
                                                 <i class="fa fa-edit"></i>
                                             </a>
                                         </span>
                                         <span data-toggle="tooltip" title="Delete">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                 data-idobat="${datavalue.kd_obat_to}"
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
                                         <h3 class="kt-callout__title-mod e_brgName ">${datavalue.nm_obat_to}
                                         </h3>
                                         <div class="etiket-body">
                                             <p class="kt-callout__desc e_qty mb-0"
                                                 style="margin-bottom: 0.5rem;">${datavalue.qty_to} ${datavalue.satuan_to}</p>
                                             <h6 class="e_signa">${datavalue.signa_to}</h6>
                                             <h6 class="e_carapakai mb-0">${datavalue.cara_pakai_to}</h6>
                                         </div>
                                         <h6 class="pull-right e_harga mb-0 "> Rp. ${datavalue.hrg_obat_to}</h6>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                        `);

                        $(".ResepCreate_e").append(
                            `
                        <tbody class="mt-2 cardObatList${datavalue.kd_obat_to}" id="">
                            <tr class="mt-2">
                                <td class="mt-2">
                                    <input type="hidden" class="obatResep form-control" id="kd_obat_to"
                                        name="kd_obat_to[]" style="width: 100%" value="${datavalue.kd_obat_to}" readonly>
                                </td>
                                <input type="hidden" id="nm_obat_to" name="nm_obat_to[]" value="${datavalue.nm_obat_to}">
                                <td>
                                    <input type="hidden" class="form-control" id="hrg_obat_to" name="hrg_obat_to[]" value="${datavalue.hrg_obat_to}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="qty_to" name="qty_to[]" value="${datavalue.qty_to}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="satuan_to" name="satuan_to[]" value="${datavalue.satuan_to}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="signa_to" name="signa_to[]" value="${datavalue.signa_to}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="cara_pakai_to" name="cara_pakai_to[]" value="${datavalue.cara_pakai_to}" readonly>
                                </td>                             
                               
                            </tr>
                        </tbody>
                    `
                        );
                    })
                }

            });
        }


        // Get Satuan Jual
        function pasteToE() {
            var kd_obat = $('#obatResep_e').val();
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
                        $('#satuan_jual_obat_e').val(datavalue.fm_satuan_jual);
                        $('#namaObatResep_e').val(datavalue.fm_nm_obat);
                        $('.ch_hrg_jual_e').val(datavalue.fm_hrg_jual_non_resep);
                    })
                }
            })
        }

        $(document).on('click', '#addItemObatReseppE', function() {
            // $(this).parent().remove();
            var obatResepE = $('#obatResep_e').val();
            var namaobatResepE = $('#namaObatResep_e').val();
            var qty_obatE = $('#qty_obat_e').val();
            var satuan_jual_obatE = $('#satuan_jual_obat_e').val();
            var signa_resepE = $('#signa_resep_e').val();
            var cara_pakai_resepE = $('#cara_pakai_resep_e').val();
            var hrg_jualE = $('.ch_hrg_jual_e').val();

            $('#obatResep_e').empty();
            $('#namaObatResep_e').val('');
            $('#qty_obat_e').val('');
            $('#satuan_jual_obat_e').val('');
            $('#signa_resep_e').val('');
            $('#cara_pakai_resep_e').val('');

            $("#resepList_e").append(
                `
                     <div class="col-md-6 kt-callout-etiket mb-4 cardObatList${obatResepE}" id="">
                         <div class="border-radius3"
                             style="background-color: rgb(244, 240, 255); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 196px;">
                             <div class="kt-portlet__head"
                                 style="min-height: 10px !important;padding: 0px;z-index: 10; border: 0px;">
                                 <div style="top: 0;position: absolute;left: -2; width: 30%;"
                                     class="kt-portlet__head kt-portlet__head--noborder kt-ribbon kt-ribbon--left">
                                     <div class="kt-ribbon__target bg-warning"
                                         style="top: 3px; left: -2px;padding: 1px 8px 1px 10px;background-color: #b3c0eb;color: rgb(163, 0, 101);font-size: 0.96em;">
                                         <label style="margin: 0px;" class="e_brgID">${obatResepE}</label>
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
                                                 data-toggle="modal" data-target="#modalAddObat"
                                                 data-isracik="0" data-brgid="GEN000000209">
                                                 <i class="fa fa-edit"></i>
                                             </a>
                                         </span>
                                         <span data-toggle="tooltip" title="Delete">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
                                                 data-idobat="${obatResepE}"
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
                                         <h3 class="kt-callout__title-mod e_brgName ">${namaobatResepE}
                                         </h3>
                                         <div class="etiket-body">
                                             <p class="kt-callout__desc e_qty mb-0"
                                                 style="margin-bottom: 0.5rem;">${qty_obatE} ${satuan_jual_obatE}</p>
                                             <h6 class="e_signa">${signa_resepE}</h6>
                                             <h6 class="e_carapakai mb-0">${cara_pakai_resepE}</h6>
                                         </div>
                                         <h6 class="pull-right e_harga mb-0 "> Rp. ${hrg_jualE}</h6>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                        `
            );


            $(".ResepCreate_e").append(
                `
                        <tbody class="mt-2 cardObatList${obatResepE}" id="">
                            <tr class="mt-2">
                                <td class="mt-2">
                                    <input type="hidden" class="obatResep form-control" id="kd_obat_to"
                                        name="kd_obat_to[]" style="width: 100%" value="${obatResepE}" readonly>
                                </td>
                                <input type="hidden" id="nm_obat_to" name="nm_obat_to[]" value="${namaobatResepE}">
                                <td>
                                    <input type="hidden" class="form-control" id="hrg_obat_to" name="hrg_obat_to[]" value="${hrg_jualE}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="qty_to" name="qty_to[]" value="${qty_obatE}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="satuan_to" name="satuan_to[]" value="${satuan_jual_obatE}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="signa_to" name="signa_to[]" value="${signa_resepE}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="cara_pakai_to" name="cara_pakai_to[]" value="${cara_pakai_resepE}" readonly>
                                </td>                             
                               
                            </tr>
                        </tbody>
                    `
            );

            // $("#TESCHCreate").empty();
        });

        function deleteRow(j) {
            var kdObat = $(j).data('idobat');
            // alert(kdObat)
            // $('.ResepCreate_e' + kdObat).remove()
            $('.cardObatList' + kdObat).remove()
        }

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

            $("#resepList").append(
                `
                     <div class="col-md-6 kt-callout-etiket mb-4">
                         <div class="border-radius3"
                             style="background-color: rgb(244, 240, 255); padding: 5px; box-shadow: 0px 0px 0px 0px !important;border: 0.5px solid lightgrey;; min-height: 196px;">
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
                                                 data-toggle="modal" data-target="#modalAddObat"
                                                 data-isracik="0" data-brgid="GEN000000209">
                                                 <i class="fa fa-edit"></i>
                                             </a>
                                         </span>
                                         <span data-toggle="tooltip" title="Delete">
                                             <a href="javascript:;"
                                                 class="btn btn-clean btn-sm btn-icon btn-icon-md pointer"
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
                                         <h3 class="kt-callout__title-mod e_brgName ">${namaobatResep}
                                         </h3>
                                         <div class="etiket-body">
                                             <p class="kt-callout__desc e_qty mb-0"
                                                 style="margin-bottom: 0.5rem;">${qty_obat} ${satuan_jual_obat}</p>
                                             <h6 class="e_signa">${signa_resep}</h6>
                                             <h6 class="e_carapakai mb-0">${cara_pakai_resep}</h6>
                                         </div>
                                         <h6 class="pull-right e_harga mb-0 "> Rp. ${hrg_jual}</h6>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                        `
            );


            $(".ResepCreate").append(
                `
                        <table>

                        <tbody class="mt-2">
                            <tr class="mt-2">
                                <td class="mt-2">
                                    <input type="hidden" class="obatResep form-control" id="kd_obat_to"
                                        name="kd_obat_to[]" style="width: 100%" value="${obatResep}" readonly>
                                </td>
                                <input type="hidden" id="nm_obat_to" name="nm_obat_to[]" value="${namaobatResep}">
                                <td>
                                    <input type="hidden" class="form-control" id="hrg_obat_to" name="hrg_obat_to[]" value="${hrg_jual}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="qty_to" name="qty_to[]" value="${qty_obat}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="satuan_to" name="satuan_to[]" value="${satuan_jual_obat}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="signa_to" name="signa_to[]" value="${signa_resep}" readonly>
                                </td>
                                <td>
                                    <input type="hidden" class="form-control" id="cara_pakai_to" name="cara_pakai_to[]" value="${cara_pakai_resep}" readonly>
                                </td>                             
                               
                            </tr>
                        </tbody>
                    </table>`
            );

            // $("#TESCHCreate").empty();
        });
    </script>
@endpush
