<div class="modal fade" id="modal-produk" tabindex="-1" role="dialog" aria-labelledby="modal-produk">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title">{{ __('pembelianDetail.choose_product') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-produk">
                    <thead>
                        <th width="5%">No</th>
                        <th>{{ __('pembelianDetail.product_code') }}</th>
                        <th>{{ __('pembelianDetail.name') }}</th>
                        <th>{{ __('pembelianDetail.buy_price') }}</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($produk as $key => $item)
                        <tr>
                            <td width="5%">{{ $key+1 }}</td>
                            <td><span class="label label-success">{{ $item->kode_produk }}</span></td>
                            <td>{{ $item->nama_produk }}</td>
                            <td>{{ $item->harga_beli }}</td>
                            <td>
                                <a style="background-color: #2E4492; color: #fff" href="#" class="btn btn-xs btn-flat"
                                    onclick="pilihProduk('{{ $item->id_produk }}', '{{ $item->kode_produk }}')">
                                    <i class="fa fa-check-circle"></i>
                                    {{ __('pembelianDetail.choose') }}
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>