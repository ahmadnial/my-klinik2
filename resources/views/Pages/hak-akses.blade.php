@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <button type="submit" class="btn btn-success float-right" data-toggle="modal"
                    data-target="#TambahPO">Add</button>
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Hak Akses Sistem</h3>
            </div>

            <div class="card-body">
                <div id="">
                    <table id="hakakses" class="table table-hover">
                        <thead class="">
                            <tr>
                                {{-- <th>Tanggal</th> --}}
                                <th>Nama</th>
                                <th>Username/Email</th>
                                <th>Hak Akses</th>
                                <th>created at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($isDataUser as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->hakakses }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- The modal Create -->
    <div class="modal fade" id="TambahPO" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-">&nbsp;</i>Create User</h4>
                    <button type="button" class="close btn btn-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {{-- <form method="POST" action="{{ url('regout') }}"> --}}
                <div class="modal-body">
                    {{-- @csrf --}}
                    <div class="">
                        <div class="form-group col">
                            <label for="">Nama User</label>
                            <input type="text" class="form-control" name="name" id="name" value=""
                                placeholder="Nama User">
                        </div>
                        <div class="form-group col">
                            <label for="">Username / Email</label>
                            <input type="text" class="form-control" name="email" id="email" value=""
                                placeholder="test@klinik.com">
                        </div>
                        <div class="form-group col">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value=""
                                placeholder="Password">
                        </div>
                        <div class="form-group col">
                            <label for="">Hak Akses</label>
                            <select class="form-control" name="role_id" id="role_id" style="width: 100%">
                                <option value=""></option>
                                <option value="1">Administrator</option>
                                <option value="2">Dokter</option>
                                <option value="3">Perawat</option>
                                <option value="4">Apotek</option>
                                <option value="5">Rekam Medis</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="buat" class="btn btn-success btn-sm float-right"><i
                                class="fa fa-save"></i>&nbsp;Create
                        </button>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>

        @push('scripts')
            <script>
                $('#role_id').select2({
                    placeholder: 'Hak Akses User',
                });

                $(document).ready(function() {

                    $('#buat').on('click', function() {
                        var name = $('#name').val();
                        var email = $('#email').val();
                        var password = $('#password').val();
                        var role_id = $('#role_id').val();
                        // alert(fm_nm_layanan);
                        if (name != "" && email != '' && password != '' && role_id != '') {
                            $.ajax({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "{{ route('userCreate') }}",
                                type: "POST",
                                data: {
                                    name: name,
                                    email: email,
                                    password: password,
                                    role_id: role_id,
                                },
                                cache: false,
                                success: function(user) {
                                    window.location.replace("{{ url('hak-akses') }}")
                                }
                            });
                        } else {
                            alert('Please fill all the field !');
                        }
                    });
                });
            </script>
        @endpush
    @endsection
