@extends('layouts.master')

@section('title')
{{ __('profile.edit_profile') }}
@endsection

@section('breadcrumb')
    @parent
    <li class="active">{{ __('profile.edit_profile') }}</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
        <form action="{{ route('user.update_profil') }}" method="post" class="form-profil needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="box-body">
                    <!-- Global Error Alert -->
                    <div class="alert alert-danger alert-dismissible global-error" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-ban"></i>
                        <span class="error-message"></span>
                    </div>

                    <div class="alert alert-info alert-dismissible" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="icon fa fa-check"></i>{{ __('profile.changes_saved') }}
                    </div>

                    <div class="form-group row">
                        <label for="name" class="col-lg-2 control-label">{{ __('profile.name') }}</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control" id="name" required autofocus value="{{ old('name', $profil->name) }}">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="foto" class="col-lg-2 control-label">{{ __('profile.profile_photo') }}</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto" class="form-control" id="foto"
                                onchange="preview('.tampil-foto', this.files[0])">
                            <span class="help-block text-danger"></span>
                            <br>
                            <div class="tampil-foto">
                                <img src="{{ url($profil->foto ?? '/') }}" width="200">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="old_password" class="col-lg-2 control-label">{{ __('profile.old_password') }}</label>
                        <div class="col-lg-6">
                            <input type="password" name="old_password" id="old_password" class="form-control" 
                            minlength="5">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="password" class="col-lg-2 control-label">{{ __('profile.new_password') }}</label>
                        <div class="col-lg-6">
                            <input type="password" name="password" id="password" class="form-control" 
                            minlength="5">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                    <br>
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-2 control-label">{{ __('profile.confirm_password') }}</label>
                        <div class="col-lg-6">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" 
                                data-match="#password">
                            <span class="help-block text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i>{{ __('profile.save_changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    (function () {
    'use strict';

    // Ambil semua form yang memerlukan validasi Bootstrap
    var forms = document.querySelectorAll('.needs-validation');

    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Cegah submit default
                event.stopPropagation(); // Stop bubbling event

                if (!form.checkValidity()) {
                    form.classList.add('was-validated'); // Tambahkan kelas validasi
                    return; // Jika tidak valid, hentikan proses
                }

                // Kirim form dengan AJAX jika validasi berhasil
                $.ajax({
                    url: $(form).attr('action'),
                    type: $(form).attr('method'),
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: (response) => {
                        // Tampilkan notifikasi sukses
                        $('.alert-info').fadeIn();
                        setTimeout(() => {
                            $('.alert-info').fadeOut();
                        }, 3000);

                        // Perbarui data di halaman (contoh: foto)
                        if (response.foto) {
                            $('.tampil-foto img').attr('src', `${response.foto}`);
                        }

                        // Reset form class
                        form.classList.remove('was-validated');
                    },
                    error: (xhr) => {
                        let errors = xhr.responseJSON.errors;

                        // Reset error sebelumnya
                        $(form).find('.help-block').text('');
                        $('.alert-info').hide();

                        if (errors) {
                            // Tampilkan pesan error untuk input spesifik
                            for (let field in errors) {
                                $(`[name=${field}]`).siblings('.help-block').text(errors[field][0]);
                            }

                            // Tampilkan pesan error global jika ada
                            $('#form-error').text('Terjadi kesalahan saat menyimpan data. Silakan periksa formulir Anda dan coba lagi.').show();
                        }
                    }
                });
            }, false);
        });
})();

</script>
@endpush
