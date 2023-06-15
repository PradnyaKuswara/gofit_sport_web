@extends('layouts/dashboard_layout')

@section('judul')
    Permission Instructur Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">INSTRUCTOR</h3>
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
                        <th class="col-md-1">NAMA</th>
                        <th class="col-md-1">PENGGANTI</th>
                        <th class="col-md-2">KETERANGAN</th>
                        <th class="col-md-1">STATUS</th>
                        <th class="col-md-2">TANGGAL IZIN</th>
                        <th class="col-md-2">TANGGAL MELAKUKAN IZIN</th>
                        <th class="col-md-2">TANGGAL KONFIRMASI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_IZIN_INSTRUKTUR }}</td>
                            <td class="col-md-1">{{ $item->instructor->NAMA_INSTRUKTUR }}</td>
                            @if ($item->NAMA_INSTRUKTUR_PENGGANTI != null)
                                <td class="col-md-1">{{ $item->NAMA_INSTRUKTUR_PENGGANTI }}</td>
                            @else
                                <td class="col-md-1">-</td>
                            @endif

                            <td class="col-md-2">{{ $item->KETERANGAN_IZIN }}</td>
                            @if ($item->STATUS_IZIN != null)
                                <td class="col-md-1">{{ $item->STATUS_IZIN }}</td>
                            @else
                                <td class="col-md-1">-</td>
                            @endif

                            <td class="col-md-2">{{ $item->TANGGAL_IZIN_INSTRUKTUR }}</td>
                            <td class="col-md-2">{{ $item->TANGGAL_MELAKUKAN_IZIN }}</td>
                            @if ($item->TANGGAL_KONFIRMASI_IZIN != null)
                                <td class="col-md-2">{{ $item->TANGGAL_KONFIRMASI_IZIN }}</td>
                            @else
                                <td class="col-md-2">belum dikonfirmasi</td>
                            @endif
                            <td class="col-md-12">
                                <div class="col-md-12 mb-2">
                                    <form onsubmit="return confirm('Are you sure about this ?');"
                                        action="{{ url('dashboard/permission-confirmation/' . $item->ID_IZIN_INSTRUKTUR) }}">
                                        <button type="submit" class="btn btn-sm btn-success"><i
                                                class="fas fa-check"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Permission Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $permissions->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">PERMISSION CONFIRMED</h3>
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
                        <th class="col-md-1">NAMA</th>
                        <th class="col-md-1">PENGGANTI</th>
                        <th class="col-md-2">KETERANGAN</th>
                        <th class="col-md-1">STATUS</th>
                        <th class="col-md-2">TANGGAL IZIN</th>
                        <th class="col-md-2">TANGGAL MELAKUKAN IZIN</th>
                        <th class="col-md-2">TANGGAL KONFIRMASI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($permissions_all as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_IZIN_INSTRUKTUR }}</td>
                            <td class="col-md-1">{{ $item->instructor->NAMA_INSTRUKTUR }}</td>
                            @if ($item->NAMA_INSTRUKTUR_PENGGANTI != null)
                                <td class="col-md-1">{{ $item->NAMA_INSTRUKTUR_PENGGANTI }}</td>
                            @else
                                <td class="col-md-1">-</td>
                            @endif

                            <td class="col-md-2">{{ $item->KETERANGAN_IZIN }}</td>
                            @if ($item->STATUS_IZIN != null)
                                <td class="col-md-1">{{ $item->STATUS_IZIN }}</td>
                            @else
                                <td class="col-md-1">-</td>
                            @endif

                            <td class="col-md-2">{{ $item->TANGGAL_IZIN_INSTRUKTUR }}</td>
                            <td class="col-md-2">{{ $item->TANGGAL_MELAKUKAN_IZIN }}</td>
                            @if ($item->TANGGAL_KONFIRMASI_IZIN != null)
                                <td class="col-md-2">{{ $item->TANGGAL_KONFIRMASI_IZIN }}</td>
                            @else
                                <td class="col-md-2">belum dikonfirmasi</td>
                            @endif
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Permission Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $permissions_all->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
    <!-- AKHIR DATA -->
@endsection
