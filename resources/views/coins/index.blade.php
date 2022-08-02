@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
@endpush
@section('heading')
    <h3>Manage Coins Record</h3>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            View, Add, Update or Deleting coins record.
        </div>
        <div class="card-body">
            @can('create coin')
                <button id="btnAdd" type="button" class="btn btn-success mb-3"><i class="bi bi-plus-circle me-2"></i>Add
                    Coins Record</button>
            @endcan
            @can('print report')
                <a href="{{ route('print') }}" target="_blank" class="btn btn-danger mb-3"><i
                        class="bi bi-printer-fill me-2"></i>Print
                    Coins Record</a>
            @endcan
            {{ $dataTable->table() }}
        </div>
    </div>
    <div class="modal fade text-left" id="modalAction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel110"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/extensions/form-element-select.js') }}"></script>
    {{ $dataTable->scripts() }}

    <script>
        // const modal = new bootstrap.Modal($('#modalAction'))

        $('#btnAdd').on('click', function() {
            $.ajax({
                method: 'GET',
                url: "{{ url('coins/create') }}",
                success: function(res) {
                    $('#modalAction').find('.modal-dialog').html(res);
                    $('#modalAction').modal('show');
                    // modal.show();
                    store()
                }
            })
        })

        function store() {
            $('#formAction').on('submit', function(e) {
                e.preventDefault();
                const _form = this
                const formData = new FormData(_form)

                const url = this.getAttribute('action')

                $.ajax({
                    method: 'POST',
                    url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        window.LaravelDataTables["coins-table"].ajax.reload();
                        $('#modalAction').modal('hide');
                        // modal.hide();
                    },
                    error: function(res) {
                        let errors = res.responseJSON?.errors
                        $(_form).find('.text-danger.text-small').remove()
                        if (errors) {
                            for (const [key, value] of Object.entries(errors)) {
                                $(`[name='${key}']`).parent().append(
                                    `<span class="text-danger text-small">${value}</span>`
                                )
                            }
                        }
                    }
                })
            })
        }

        $('#coins-table').on('click', '.action', function() {
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis

            if (jenis == 'delete') {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            method: 'DELETE',
                            url: "{{ url('coins') }}" + '/' + id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                window.LaravelDataTables["coins-table"].ajax.reload();
                                Swal.fire(
                                    'Deleted!',
                                    res.message,
                                    res.status
                                )
                            }
                        })
                    }
                })
                return
            }

            if (jenis == 'edit') {
                $.ajax({
                    method: 'GET',
                    url: "{{ url('coins') }}" + '/' + id + '/edit',
                    success: function(res) {
                        $('#modalAction').find('.modal-dialog').html(res);
                        $('#modalAction').modal('show');
                        // modal.show();
                        store()
                    }
                })
            }
        })
    </script>
@endpush
