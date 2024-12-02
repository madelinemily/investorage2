<!-- Modal form untuk tambah/edit kategori -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg">
        <form method="POST" id="form-kategori" class="form-horizontal needs-validation" novalidate>
            @csrf
            @method('POST')

            <div class="modal-content">
                <div class="modal-header d-flex justify-content-between align-items-center">
                    <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <!-- Menampilkan error global jika ada -->
                    <!-- <div id="modal-error" class="alert alert-danger" style="display: none;"></div> -->

                    <div class="form-group row">
                        <label for="nama_kategori" class="col-lg-2 col-lg-offset-1 control-label"> {{ __('messages.add_name') }}</label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required autofocus>
                            <div class="help-block text-danger"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success"><i class="fa fa-save"></i> {{ __('messages.save') }}</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> {{ __('messages.cancel') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
