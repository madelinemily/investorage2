@extends('layouts.master')

@section('title')
{{ __('messages.title') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('messages.title') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header">
                <button onclick="addForm('{{ route('kategori.store') }}')" class="btn-tambah"><i class="fa fa-plus-circle"></i> {{ __('messages.add_category') }}</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-stiped table-hover">
                    <thead>
                        <th width="5%">No</th>
                        <th>Kategori</th>
                        <th width="15%"><i class="fa fa-cog"></i></th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@includeIf('kategori.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('kategori.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'nama_kategori'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
    });

    // Mengganti validator dengan validasi Bootstrap 5
    (function () {
    'use strict';

    // Menambahkan validasi Bootstrap pada form modal
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Cegah submit biasa
                event.stopPropagation(); // Stop event bubbling

                if (!form.checkValidity()) {
                    form.classList.add('was-validated'); // Menambahkan kelas validasi
                    return; // Jika form tidak valid, stop proses
                }

                // Kirim data dengan AJAX jika form valid
                $.ajax({
                    url: $('#modal-form form').attr('action'),
                    type: 'post',
                    data: $('#modal-form form').serialize(),
                    cache: false,
                    success: (response) => {
                        $('#modal-form').modal('hide'); // Tutup modal jika sukses
                        table.ajax.reload(null, false); // Reload tabel tanpa reload halaman
                    },
                    error: (xhr) => {
                        let errors = xhr.responseJSON.errors;
                        
                        // Reset error message dan tampilkan modal kembali
                        $('#modal-error').hide(); // Sembunyikan error lama
                        $('#modal-form .help-block').text(''); // Reset pesan error untuk inputan

                        if (errors) {
                            // Menampilkan error di bawah input form
                            for (let field in errors) {
                                $(`[name=${field}]`).siblings('.help-block').text(errors[field][0]);
                            }
                            
                            // Menampilkan pesan error umum jika ada
                            $('#modal-error').text('Terjadi kesalahan saat menyimpan data. Silakan periksa formulir dan coba lagi.').show();
                        }

                        // Menampilkan modal kembali jika ada error
                        $('#modal-form').modal('show');
                    }
                });
            }, false);
        });
})();





function addForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Tambah Kategori');

    $('#modal-form form')[0].reset();
    $('#modal-form form').removeClass('was-validated');
    $('#modal-form form').attr('action', url);
    $('#modal-form [name=_method]').val('post');
    $('#modal-form [name=nama_kategori]').focus();
}

function editForm(url) {
    $('#modal-form').modal('show');
    $('#modal-form .modal-title').text('Edit Kategori');

    $('#modal-form form')[0].reset();
    $('#modal-form form').removeClass('was-validated');
    $('#modal-form form').attr('action', url); // Form action tetap update ke URL ini
    $('#modal-form [name=_method]').val('put');
    $('#modal-form [name=nama_kategori]').focus();

    // Mendapatkan data kategori dengan AJAX GET
    $.get(url)
        .done((response) => {
            $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
        })
        .fail((errors) => {
            alert('Tidak dapat menampilkan data');
            return;
        });
}

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
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
