@extends('layouts.master')

@section('title')
{{ __('supplier.title') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('supplier.title') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <button onclick="addForm('{{ route('supplier.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> {{ __('supplier.add') }}</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-bordered">
                    <thead>
                        <th width="5%">{{ __('supplier.fields.no') }}</th>
                        <th>{{ __('supplier.fields.name') }}</th>
                        <th>{{ __('supplier.fields.phone') }}</th>
                        <th>{{ __('supplier.fields.address') }}</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('supplier.form')
@endsection

@push('scripts')
<script>
    let table;

    const translations = {
        delete_confirm: "{{ __('supplier.delete_confirm') }}",
        modal_title_add: "{{ __('supplier.add') }}",
        modal_title_edit: "{{ __('supplier.edit') }}",
        delete_fail: "{{ __('supplier.delete_fail') }}",
    };

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('supplier.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama'},
                {data: 'telepon'},
                {data: 'alamat'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
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
})();

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text(translations.modal_title_add);

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text(translations.modal_title_edit);

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=telepon]').val(response.telepon);
                $('#modal-form [name=alamat]').val(response.alamat);
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
                    alert(translations.delete_fail);
                    return;
                });
        }
    }
</script>
@endpush