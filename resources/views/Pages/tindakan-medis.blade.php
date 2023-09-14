@extends('Pages.master')

@section('konten')
    <section class="content">
        <div class="col-6" id="accordion">
            <div class="card card-primary card-outline">
                <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            SOAP
                        </h4>
                    </div>
                </a>
                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <div class="card-body">
                        {{-- ================================ --}}
                        <div class="row">
                            <div class="col-md">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">dr.Aji Pangki - 01-09-2023 - Layanan</h3>

                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="inputDescription">Subjective</label>
                                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Objective</label>
                                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Assesment</label>
                                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputDescription">Plan</label>
                                            <textarea id="inputDescription" class="form-control" rows="4"></textarea>
                                        </div>
                                        {{-- <div class="form-group">
                                            <label for="inputStatus">Status</label>
                                            <select id="inputStatus" class="form-control custom-select">
                                                <option disabled>Select one</option>
                                                <option>On Hold</option>
                                                <option>Canceled</option>
                                                <option selected>Success</option> 
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputClientCompany">Client Company</label>
                                            <input type="text" id="inputClientCompany" class="form-control"
                                                value="Deveint Inc">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputProjectLeader">Project Leader</label>
                                            <input type="text" id="inputProjectLeader" class="form-control"
                                                value="Tony Chicken">
                                        </div> --}}
                                    </div>
                                </div>
                                {{-- ===================================================== --}}

                                <div class="row">
                                    <div class="col-md">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">General</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                        title="Collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="inputName">Project Name</label>
                                                    <input type="text" id="inputName" class="form-control"
                                                        value="AdminLTE">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputDescription">Project Description</label>
                                                    <textarea id="inputDescription" class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputStatus">Status</label>
                                                    <select id="inputStatus" class="form-control custom-select">
                                                        <option disabled>Select one</option>
                                                        <option>On Hold</option>
                                                        <option>Canceled</option>
                                                        <option selected>Success</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputClientCompany">Client Company</label>
                                                    <input type="text" id="inputClientCompany" class="form-control"
                                                        value="Deveint Inc">
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputProjectLeader">Project Leader</label>
                                                    <input type="text" id="inputProjectLeader" class="form-control"
                                                        value="Tony Chicken">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--   --}}

                    </div>
                    <!-- /.card -->
                </div>
            </div>
    </section>

    <!-- /.content -->
    <div class="col-md-6">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Budget</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="inputEstimatedBudget">Estimated budget</label>
                    <input type="number" id="inputEstimatedBudget" class="form-control" value="2300" step="1">
                </div>
                <div class="form-group">
                    <label for="inputSpentBudget">Total amount spent</label>
                    <input type="number" id="inputSpentBudget" class="form-control" value="2000" step="1">
                </div>
                <div class="form-group">
                    <label for="inputEstimatedDuration">Estimated project duration</label>
                    <input type="number" id="inputEstimatedDuration" class="form-control" value="20"
                        step="0.1">
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
