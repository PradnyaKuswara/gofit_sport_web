@extends('layouts/dashboard_layout')

@section('judul')
    Presensi Booking Class Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">PRESENSI BOOKING CLASS</h3>
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
                        <th class="col-md-3">TANGGAL KELAS</th>
                        <th class="col-md-3">TANGGAL BOOKING</th>
                        <th class="col-md-1">TARIF</th>
                        <th class="col-md-3">TANGGAL KONFIRMASI</th>
                        <th class="col-md-1">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presensies as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->KODE_BOOKING_KELAS }}</td>
                            <td class="col-md-2">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_JADWAL_HARIAN }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>
                            <td class="col-md-1">{{ $item->TARIF_KELAS }}</td>

                            @if ($item->WAKTU_KONFIRMASI_PRESENSI_KELAS != null)
                                <td class="col-md-3">{{ $item->WAKTU_KONFIRMASI_PRESENSI_KELAS }}</td>
                            @else
                                <td class="col-md-3">-</td>
                            @endif
                            @if ($item->STATUS_PRESENSI_KELAS != null)
                                <td class="col-md-1">{{ $item->STATUS_PRESENSI_KELAS }}</td>
                            @else
                                <td class="col-md-1">Belum dikonfirmasi</td>
                            @endif
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Presensi Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $presensies->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">PRESENSI BOOKING CLASS CONFIRMED</h3>
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
                        <th class="col-md-3">TANGGAL KELAS</th>
                        <th class="col-md-3">TANGGAL BOOKING</th>
                        <th class="col-md-1">TARIF</th>
                        <th class="col-md-3">TANGGAL KONFIRMASI</th>
                        <th class="col-md-1">STATUS</th>
                        <th class="col-md-1">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($presensies2 as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->KODE_BOOKING_KELAS }}</td>
                            <td class="col-md-2">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_JADWAL_HARIAN }}</td>
                            <td class="col-md-3">{{ $item->TANGGAL_MELAKUKAN_BOOKING }}</td>
                            <td class="col-md-1">{{ $item->TARIF_KELAS }}</td>

                            @if ($item->WAKTU_KONFIRMASI_PRESENSI_KELAS != null)
                                <td class="col-md-3">{{ $item->WAKTU_KONFIRMASI_PRESENSI_KELAS }}</td>
                            @else
                                <td class="col-md-3">-</td>
                            @endif
                            @if ($item->STATUS_PRESENSI_KELAS != null)
                                <td class="col-md-1">{{ $item->STATUS_PRESENSI_KELAS }}</td>
                            @else
                                <td class="col-md-1">Belum dikonfirmasi</td>
                            @endif

                            <td class="col-md-12">
                                <div class="col-md-1 mb-2">
                                    <a href='{{ url('dashboard/presensi-class-receipt/' . $item->KODE_BOOKING_KELAS) }}'
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
                {{ $presensies2->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
