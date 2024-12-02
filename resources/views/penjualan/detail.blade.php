<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="modal-detail">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{{ __('penjualan.sales_list') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-detail">
                    <thead>
                        <th width="5%">No</th>
                        <th>{{ __('penjualan.code') }}</th>
                        <th>{{ __('penjualan.name') }}</th>
                        <th>{{ __('penjualan.price') }}</th>
                        <th>{{ __('penjualan.amount') }}</th>
                        <th>{{ __('penjualan.subtotal') }}</th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>