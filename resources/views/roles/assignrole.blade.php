@extends('layouts.master')
@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" /> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
@endpush
@section('heading')
    <h3>Assign Role</h3>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            Assign role to desired users.
        </div>
        <div class="card-body">
            <form id="formAssign" class="form form-vertical">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="namarole" class="form-label">Role</label>
                                <select class="choices form-select" name="namerole" id="namarole">
                                    <option selected>--Select Role--</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <label for="namausers" class="form-label">User</label>
                                <select class="choices form-select" name="namausers" id="namausers">
                                    <option selected>--Select User--</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->email }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="modal fade text-left" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

        </div>
    </div> --}}
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#formAssign').on('submit', function(e) {
            e.preventDefault();

            let rolename = $('#namarole').val();
            let namausers = $('#namausers').val();

            console.log(rolename);
            console.log(namausers);

            $.ajax({
                method: 'POST',
                url: '{{ url('/assignrole') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                data: {
                    rolename,
                    namausers,
                },
                success: function(res) {
                    console.log(res);
                    Swal.fire(
                        'Success!',
                        res.message,
                        res.status
                    )
                }
            })

            // $.ajax({
            //     url: {{ url('/assignrole') }},
            //     method: 'POST',
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     data: {
            //         rolename,
            //         namausers,
            //     },
            //     success: function(res) {
            //         console.log(res);
            //     }
            // });
        })
    </script>
@endpush
