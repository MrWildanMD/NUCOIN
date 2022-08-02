@extends('layouts.master')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.dataTables.min.css">
@endpush
@section('heading')
    <h3>Manage Donators</h3>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            View, Add, Update or Deleting donators.
        </div>
        <div class="card-body">
            @can('create coin')
                <button id="btnAdd" type="button" class="btn btn-success mb-3"><i class="bi bi-plus-circle me-2"></i>Add
                    Donators</button>
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
    {{ $dataTable->scripts() }}

    <script>
        // const modal = new bootstrap.Modal($('#modalAction'))
        $('#btnAdd').on('click', function() {
            $.ajax({
                method: 'GET',
                url: "{{ url('donators/create') }}",
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
                        window.LaravelDataTables["donators-table"].ajax.reload();
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

        $('#donators-table').on('click', '.action', function() {
            let data = $(this).data()
            let id = data.id
            let jenis = data.jenis

            if (jenis == 'delete') {
                console.log('delete pressed');
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
                            url: "{{ url('donators') }}" + '/' + id,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                window.LaravelDataTables["donators-table"].ajax.reload();
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
                    url: "{{ url('donators') }}" + '/' + id + '/edit',
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
