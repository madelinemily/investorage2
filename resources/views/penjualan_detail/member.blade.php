<div class="modal fade" id="modal-member" tabindex="-1" role="dialog" aria-labelledby="modal-member">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn-close ms-0" data-bs-dismiss="modal" aria-label="Close"></button>
                <h4 class="modal-title">{{ __('pembelianDetail.choose_member') }}</h4>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-member">
                    <thead>
                        <th width="5%">No</th>
                        <th>{{ __('member.name') }}</th>
                        <th>{{ __('member.phone') }}</th>
                        <th>{{ __('member.address') }}</th>
                        <th><i class="fa fa-cog"></i></th>
                    </thead>
                    <tbody>
                        @foreach ($member as $key => $item)
                        <tr>
                            <td width="5%">{{ $key+1 }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->telepon }}</td>
                            <td>{{ $item->alamat }}</td>
                            <td>
                                <a href="#" class="btn btn-primary btn-xs btn-flat"
                                    onclick="pilihMember('{{ $item->id_member }}', '{{ $item->kode_member }}')">
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