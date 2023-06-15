@extends('layouts/dashboard_layout')

@section('judul')
    Activation Member Page
@endsection

@section('main')
    <div class=" card my-5 p-3 rounded shadow-lg w-100 mx-auto">
        <h3 class="card-title text-center">ACTIVATION MEMBER</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/activation-transaction-confirmation') }}" method="get" enctype="multipart/form-data">
            @csrf
            <div class="form-row mb-2 d-flex justify-content-center">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Member</label>
                    <select class="form-select form-select-lg mb-3 " id="single-select-field"
                        aria-label="Default select example" name="ID_MEMBER" data-placeholder="Select Member">
                        <option value="" hidden></option>
                        @if ($members->first() != null)
                            @foreach ($members as $item_member)
                                <option value="{{ $item_member->ID_MEMBER }}">
                                    {{ $item_member->ID_MEMBER }} - {{ $item_member->NAMA_MEMBER }}</option>
                            @endforeach
                        @else
                            <option value=""disabled>All member activated</option>
                        @endif

                    </select>
                    {{-- <label class="font-weight-bold mb-2 mt-3">Cashier</label>
                    <input type='text' class="form-control mb-3"name="ID_PEGAWAI"
                        placeholder="Input date of birth member" autocomplete="off"
                        value="P{{ $user->ID_PEGAWAI }} / {{ $user->NAMA_PEGAWAI }}" disabled /> --}}

                    <button type="submit" class="btn btn-success btn-block mb-4 mt-3"
                        data-loading-text="Loading...">Activate Member</button>

                </div>
            </div>
        </form>
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title align-items-center mb-2">TRANSACTION SUCCESS</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-2 p-5 bg-body rounded shadow-sm">

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">NAMA MEMBER</th>
                        <th class="col-md-1">NAMA KASIR</th>
                        <th class="col-md-3">TANGGAL TRANSAKSI</th>
                        <th class="col-md-3">KADALUARSA</th>
                        <th class="col-md-2">BIAYA</th>
                        <th class="col-md-3">STATUS</th>
                        <th class="col-md-3">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataActivation as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_TRANSAKSI_AKTIVASI }}</td>
                            <td class="col-md-2">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->pegawai->NAMA_PEGAWAI }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_TRANSAKSI_AKTIVASI }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI }}</td>
                            <td class="col-md-2">{{ $item->BIAYA_AKTIVASI }}</td>
                            <td class="col-md-3">{{ $item->STATUS }}</td>
                            <td class="col-md-12">
                                <div class="col-md-12 mb-2">
                                    <a href='{{ url('dashboard/activation-transaction-receipt/' . $item->ID_TRANSAKSI_AKTIVASI) }}'
                                        target="_blank" class="btn btn-outline-warning btn-md"><i
                                            class="fas fa-receipt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Transaction Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $dataActivation->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection

@section('footer-script')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            selectionCssClass: 'select2--large',
            dropdownCssClass: 'select2--large',
        });
    </script>
    {{-- <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script> --}}
@endsection
