@extends('layouts/dashboard_layout')

@section('judul')
    Presensi Booking Gym Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">CONFIRMATION BOOKING GYM</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">NAMA</th>
                        <th class="col-md-1">SLOT WAKTU</th>
                        <th class="col-md-2">TANGGAL GYM</th>
                        <th class="col-md-3">TANGGAL BOOKING</th>
                        <th class="col-md-3">TANGGAL KONFIRMASI</th>
                        <th class="col-md-1">STATUS</th>
                        <th class="col-md-1">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($booking_gym as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->KODE_BOOKING_GYM }}</td>
                            <td class="col-md-2">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->SLOT_WAKTU_GYM }}</td>
                            <td class="col-md-2">{{ $item->TANGGAL_BOOKING_GYM }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>

                            @if ($item->WAKTU_KONFIRMASI_PRESENSI != null)
                                <td class="col-md-3">{{ $item->WAKTU_KONFIRMASI_PRESENSI }}</td>
                            @else
                                <td class="col-md-3">-</td>
                            @endif
                            @if ($item->STATUS_PRESENSI_GYM != null)
                                <td class="col-md-1">{{ $item->STATUS_PRESENSI_GYM }}</td>
                            @else
                                <td class="col-md-1">Belum dikonfirmasi</td>
                            @endif

                            <td class="col-md-12">
                                <div class="col-md-1 mb-2">
                                    <a href='{{ url('dashboard/confirmation-booking-gym/' . $item->KODE_BOOKING_GYM) }}'
                                        class="btn btn-outline-success btn-md"><i class="fas fa-check"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Presensi Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $booking_gym->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>


    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">DATA BOOKING GYM</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-2">NAMA</th>
                        <th class="col-md-1">SLOT WAKTU</th>
                        <th class="col-md-2">TANGGAL GYM</th>
                        <th class="col-md-3">TANGGAL BOOKING</th>
                        <th class="col-md-3">TANGGAL KONFIRMASI</th>
                        <th class="col-md-1">STATUS</th>
                        <th class="col-md-1">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($booking_gym_after as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->KODE_BOOKING_GYM }}</td>
                            <td class="col-md-2">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-1">{{ $item->SLOT_WAKTU_GYM }}</td>
                            <td class="col-md-2">{{ $item->TANGGAL_BOOKING_GYM }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>

                            @if ($item->WAKTU_KONFIRMASI_PRESENSI != null)
                                <td class="col-md-3">{{ $item->WAKTU_KONFIRMASI_PRESENSI }}</td>
                            @else
                                <td class="col-md-3">-</td>
                            @endif
                            @if ($item->STATUS_PRESENSI_GYM != null)
                                <td class="col-md-1">{{ $item->STATUS_PRESENSI_GYM }}</td>
                            @else
                                <td class="col-md-1">Belum dikonfirmasi</td>
                            @endif

                            <td class="col-md-12">
                                <div class="col-md-1 mb-2">
                                    <a href='{{ url('dashboard/presensi-gym-receipt/' . $item->KODE_BOOKING_GYM) }}'
                                        target="_blank" class="btn btn-outline-warning btn-md"><i
                                            class="fas fa-receipt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Presensi Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $booking_gym_after->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
