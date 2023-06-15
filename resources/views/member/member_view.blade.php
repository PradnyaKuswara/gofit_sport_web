@extends('layouts/dashboard_layout')

@section('judul')
    Member Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA MEMBER</h3>
        </div>
    </div> --}}
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->


        <div class="">
            <a href='{{ url('dashboard/create-member') }}' class="btn bg-success text-white mb-3 ">
                Add New
                Member</a>
            <a href='{{ url('dashboard/member') }}'
                class="btn btn-warning mb-3"{{ request()->is('dashboard/member') ? 'hidden' : '' }}> <i
                    class="fa fa-backward"></i>
                Show All Data</a>
            <form class="d-flex" action="{{ url('dashboard/search-member') }}" method="get">
                <input class="form-control me-1 mt-1" type="search" name="keyword" placeholder="Keyword"
                    aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>


        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered table-responsive table-responsive-lg ">
                <thead class="">
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-1">NAMA</th>
                        <th class="col-md-1">EMAIL</th>
                        <th class="col-md-1">UMUR</th>
                        <th class="col-md-3">ALAMAT</th>
                        <th class="col-md-3">TANGGAL LAHIR</th>
                        <th class="col-md-5">NOMOR TELEPON</th>
                        <th class="col-md-5">JENIS KELAMIN</th>
                        <th class="col-md-5">AKTIVASI</th>
                        <th class="col-md-5">DEPO UANG</th>
                        <th class="col-md-12">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->NAMA_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->EMAIL_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->USIA_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->ALAMAT_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_LAHIR_MEMBER }}</td>
                            <td class="col-md-5">{{ $item->TELEPON_MEMBER }}</td>
                            <td class="col-md-5">{{ $item->JENIS_KELAMIN_MEMBER }}</td>
                            @if ($item->MASA_AKTIVASI != null)
                                <td class="col-md-5">{{ $item->MASA_AKTIVASI }}</td>
                            @else
                                <td class="col-md-5">Belum Aktivasi</td>
                            @endif
                            @if ($item->SISA_DEPOSIT_MEMBER != null || $item->SISA_DEPOSIT_MEMBER != 0)
                                <td class="col-md-5">{{ $item->SISA_DEPOSIT_MEMBER }}</td>
                            @else
                                <td class="col-md-5">0</td>
                            @endif

                            <td class="col-md-12">
                                <div class="col-md-12 mb-2">
                                    <a href='{{ url('dashboard/cetak-member/' . $item->ID_MEMBER) }}' target="_blank"
                                        class="btn btn-outline-warning btn-md"><i class="fas fa-address-card"></i></a>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <a href='{{ url('dashboard/edit-member/' . $item->ID_MEMBER) }}'
                                        class="btn btn-outline-success btn-md"><i class="fas fa-pencil"></i></a>
                                </div>
                                <div class="col-md-12 mb-2">
                                    @csrf
                                    <form onsubmit="return confirm('Are you sure reset password ?');"
                                        action="{{ url('dashboard/reset-password-member/' . $item->ID_MEMBER) }}">
                                        <button type="submit" class="btn btn-md btn-outline-danger"><i
                                                class="fas fa-key"></i></button>
                                    </form>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <form onsubmit="return confirm('Are you sure delete member ?');"
                                        action="{{ url('dashboard/delete-member/' . $item->ID_MEMBER) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-outline-danger"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Member Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
