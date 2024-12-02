<div class="modal fade" id="modal-supplier" tabindex="-1" role="dialog" aria-labelledby="modal-supplier">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title">{{ __('pembelian.modal.supplier_title') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-supplier">
                    <thead>
                        <th width="5%">{{ __('pembelian.table.no') }}</th>
                        <th>{{ __('pembelian.table.name') }}</th>
                        <th>{{ __('pembelian.table.phone') }}</th>
                        <th>{{ __('pembelian.table.address') }}</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $key => $item)
                        <tr>
                            <td width="5%">{{ $key+1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <a style="background-color: #2E4492; color: #fff" href="{{ route('pembelian.create', $item->id_supplier) }}" class="btn btn-xs btn-flat">
                                    <i class="fa fa-check-circle"></i>
                                    {{ __('pembelian.modal.select_button') }}
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