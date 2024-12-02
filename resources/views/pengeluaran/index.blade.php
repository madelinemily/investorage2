@extends('layouts.master')

@section('title')
{{ __('pengeluaran.title') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('pengeluaran.breadcrumb') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm('{{ route('pengeluaran.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> {{ __('pengeluaran.add_button') }}</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">{{ __('pengeluaran.table.no') }}</th>
                        <th>{{ __('pengeluaran.table.date') }}</th>
                        <th>{{ __('pengeluaran.table.description') }}</th>
                        <th>{{ __('pengeluaran.table.amount') }}</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('pengeluaran.form')
@endsection

@push('scripts')
<script>
    let table;

    const translations = {
        delete_confirm: "{{ __('pengeluaran.delete_confirm') }}",
        modal_title_add: "{{ __('pengeluaran.add_title') }}",
        modal_title_edit: "{{ __('pengeluaran.edit_title') }}",
    };

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('pengeluaran.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'created_at'},
                {data: 'deskripsi'},
                {data: 'nominal'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });

// Mengganti validator dengan validasi Bootstrap 5
(function () {
    'use strict';

    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Cegah default form submission
                event.stopPropagation(); // Hentikan event bubbling

                if (!form.checkValidity()) {
                    return;
                }

                // Buat request AJAX untuk menyimpan atau mengupdate kategori
                $.ajax({
                    url: $('#modal-form form').attr('action'),
                    type: 'post',
                    data: $('#modal-form form').serialize(),
                    cache: false,
                })
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false); // Reload tabel tanpa reload halaman
                })
                .fail((errors) => {
                    alert('Tidak dapat menyimpan data');
                });

                form.classList.add('was-validated'); // Tambah validasi bootstrap
            }, false);
        });
    });
});

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text(translations.modal_title_add);

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=deskripsi]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text(translations.modal_title_edit);

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=deskripsi]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=deskripsi]').val(response.deskripsi);
                $('#modal-form [name=nominal]').val(response.nominal);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm(translations.delete_confirm)) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }
</script>
@endpush