@extends('pages.master')

@section('konten')
    <section class="content">
        <div class="card col-6" style="margin: 0 auto; float: none; margin-bottom: 20px;">
            <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user">&nbsp;</i>Setting Account</h3>
            </div>

            <div class="card-body">
                <div id="" class="comtainer-fluid">
                    {{-- <div class="box-body"> --}}
                    <form action="{{ url('postChangeProfile') }}" method="POST">
                        @csrf
                         <div class="mb-3">
                            <label for="current_password" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{Auth::user()->email}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Display Name</label>
                            <input type="text" class="form-control" id="display_name" name="display_name" value="{{Auth::user()->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation">
                        </div>
                        <button type="submit" class="btn btn-primary text-center">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        {{-- </div> --}}
    </section>

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
