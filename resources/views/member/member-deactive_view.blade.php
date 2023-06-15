@extends('layouts/dashboard_layout')

@section('judul')
    Deactive Member Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">MEMBER ACTIVATION EXPIRED</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">

        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-1 d-flex flex-row-reverse justify-content-between">
            <a href='{{ url('dashboard/deactive-member-process') }}'
                class="btn bg-danger text-white mt-2"{{ $members->first() == null ? 'hidden' : '' }}> <i
                    class="fas fa-user-minus"></i> Deactive Member</a>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
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

                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Member Expired Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $members->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">MEMBER DEACTIVE</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">

        <div class="card-body overflow-auto">
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />


            <table class="table table-hover table-bordered">
                <thead>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members_after as $item)
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
                            {{-- @if ($item->SISA_DEPOSIT_KELAS != null || $item->SISA_DEPOSIT_KELAS)
                            <td class="col-md-1">{{ $item->SISA_DEPOSIT_KELAS }}</td>
                        @else
                            <td class="col-md-1">0</td>
                        @endif
                        @if ($item->EXPIRED_KELAS != null || $item->EXPIRED_KELAS != 0)
                            <td class="col-md-1">{{ $item->EXPIRED_KELAS }}</td>
                        @else
                            <td class="col-md-1">Belum Deposit Kelas</td>
                        @endif --}}
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Member Deactive Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $members_after->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
