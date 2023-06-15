@extends('layouts/dashboard_layout')

@section('judul')
    Deposit Class Page
@endsection

@section('main')
    <div class=" card my-5 p-3 bg-body rounded shadow-lg w-100 mx-auto">
        <h3 class="card-title text-center">DEPOSIT CLASS</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/class-deposit-confirmation') }}" method="get" enctype="multipart/form-data">
            @csrf
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Member</label>
                    <select class="form-control mb-3" aria-label="Default select example" name="ID_MEMBER"
                        id="single-select-field" data-placeholder="Select Member">
                        <option value="" hidden>Select Member</option>
                        @if ($members->first() != null)
                            @foreach ($members as $item_member)
                                <option value="{{ $item_member->ID_MEMBER }}" temp="{{ $item_member->SISA_DEPOSIT }}">
                                    {{ $item_member->ID_MEMBER }} - {{ $item_member->NAMA_MEMBER }}</option>
                            @endforeach
                        @else
                            <option value=""disabled>Member empty</option>
                        @endif

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Kelas</label>
                    <select class="form-control mb-3" aria-label="Default select example" name="ID_KELAS"
                        id="single-select-field2" data-placeholder="Select Class">
                        <option value="" hidden>Select Kelas</option>
                        @if ($kelas->first() != null)
                            @foreach ($kelas as $item_kelas)
                                <option value="{{ $item_kelas->ID_KELAS }}" temp="{{ $item_kelas->NAMA_KELAS }}">
                                    {{ $item_kelas->ID_KELAS }} - {{ $item_kelas->NAMA_KELAS }}</option>
                            @endforeach
                        @else
                            <option value=""disabled>Kelas empty</option>
                        @endif

                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Packet</label>
                    <select class="form-control mb-3" aria-label="Default select example" name="JUMLAH_DEPOSIT_KELAS"
                        id="deposit">
                        <option value="" hidden>Select Kelas</option>
                        <option value="5">5 Kelas</option>
                        <option value="10">10 Kelas</option>
                    </select>
                </div>

                {{-- <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Transaction Date</label>
                    <input type='text' class="form-control mb-3"name="TANGGAL_DEPOSIT_UANG"
                        placeholder="Input date of birth member" autocomplete="off"
                        value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />
                </div>
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Cashier</label>
                    <input type='text' class="form-control mb-3"name="ID_PEGAWAI"
                        placeholder="Input date of birth member" autocomplete="off"
                        value="P{{ $user->ID_PEGAWAI }} / {{ $user->NAMA_PEGAWAI }}" disabled />
                </div> --}}
                <button type="submit" class="btn btn-success btn-block mb-4">Deposit Class</button>
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
                        <th class="col-md-1">NAMA MEMBER</th>
                        <th class="col-md-1">PROMO</th>
                        <th class="col-md-1">NAMA KASIR</th>
                        <th class="col-md-1">KELAS</th>
                        <th class="col-md-1">NOMINAL DEPOSIT</th>
                        <th class="col-md-1">BONUS</th>
                        <th class="col-md-1">TOTAL DEPOSIT</th>
                        <th class="col-md-1">BIAYA</th>
                        <th class="col-md-1">TANGGAL</th>
                        <th class="col-md-1">MASA BERLAKU</th>
                        <th class="col-md-12">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datadepoclass as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_TRANSAKSI_PAKET }}</td>
                            <td class="col-md-1">{{ $item->member->NAMA_MEMBER }}</td>
                            @if ($item->ID_PROMO != null)
                                <td class="col-md-1">{{ $item->promot->NAMA_PROMO }}</td>
                            @else
                                <td class="col-md-1">-</td>
                            @endif

                            <td class="col-md-1">{{ $item->pegawai->NAMA_PEGAWAI }}</td>
                            <td class="col-md-1">{{ $item->kelas->NAMA_KELAS }}</td>
                            <td class="col-md-1">{{ $item->JUMLAH_DEPOSIT_KELAS }}</td>
                            @if ($item->BONUS_DEPOSIT_KELAS != null)
                                <td class="col-md-1">{{ $item->BONUS_DEPOSIT_KELAS }}</td>
                            @else
                                <td class="col-md-1">0</td>
                            @endif
                            <td class="col-md-1">{{ $item->TOTAL_DEPOSIT_KELAS }}</td>
                            <td class="col-md-1">{{ $item->JUMLAH_PEMBAYARAN }}</td>
                            <td class="col-md-1">{{ $item->TANGGAL_DEPOSIT_KELAS }}</td>
                            <td class="col-md-1">{{ $item->MASA_BERLAKU_KELAS }}</td>
                            <td class="col-md-12">
                                <div class="col-md-12 mb-2">
                                    <a href='{{ url('dashboard/class-deposit-receipt/' . $item->ID_TRANSAKSI_PAKET) }}'
                                        target="_blank" class="btn btn-outline-warning btn-md"><i
                                            class="fas fa-receipt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Deposit Class Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $datadepoclass->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        window.data = {!! json_encode($members) !!};
    </script>

    <script>
        function sisaDeposit(event) {
            let i = 0;
            var dataMember = window.data;
            while (i < dataMember.length) {
                if (dataMember[i].ID_MEMBER == event.target.value) {
                    if (dataMember[i].SISA_DEPOSIT_MEMBER != null) {
                        document.getElementById("sisa").value = dataMember[i].SISA_DEPOSIT_MEMBER;
                    } else {
                        document.getElementById("sisa").value = 0;
                    }

                    // console.log(dataMember[i].SISA_DEPOSIT_MEMBER)
                }
                i++;
            }
        };
    </script> --}}

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

        $('#single-select-field2').select2({
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
