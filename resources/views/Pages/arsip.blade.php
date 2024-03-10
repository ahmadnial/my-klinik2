@extends('pages.master')
@section('mytitle', 'Arsip')
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
                    <div class="justify-content-between px-1">
                        <div class="border-right"></div>
                        <div class="">
                        </div>
                        <div class="p-0 col pl-1 pr-1 pb-1" style="padding-top: 10px !important;">
                            <select class="form-control-pasien" id="noMr" style="width: 100%;" name="noMr">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-header bg-nial pl-1 ml-2">
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
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col square1 thin mb-2" style="max-height: 90vh; overflow-y:scroll;">
                <div style="width:100%; background-color: white;" id="mainAssesment" class="p-0">
                    <div class="form-box p-2" style="margin-bottom:8px;background-color: white;" id="template-select">
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
                                {{-- <div class="heading" style="background-color: #e9e7eb">
                                    <div class="row">
                                        <h3 class="col-12 text-center mt-3">
                                            ASSESMENT AWAL MEDIS RAWAT JALAN
                                        </h3>
                                    </div>
                                </div> --}}
                                <form action="addAssesment" method="POST">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">

                                        </div>
                                    </div>
                        </section>
                    </div>
                </div>
            </div>
        @endsection

        @push('scripts')
            <script></script>
        @endpush
