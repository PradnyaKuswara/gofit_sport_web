@extends('layouts/dashboard_layout')

@section('judul')
    Reset Class Packet Member Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">MEMBER CLASS PACKET EXPIRED</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-1 d-flex flex-row-reverse justify-content-between">
            <a href='{{ url('dashboard/reset-class-member-process') }}'
                class="btn bg-danger text-white mt-2"{{ $members->first() == null ? 'hidden' : '' }}> <i
                    class="fas fas fa-undo"></i> Reset Class Packet</a>
        </div>

        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-3">NAMA</th>
                        <th class="col-md-3">KELAS</th>
                        <th class="col-md-2">SISA DEPOSIT</th>
                        <th class="col-md-3">MASA BERLAKU</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_DEPOSIT }}</td>
                            <td class="col-md-3">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->kelas->NAMA_KELAS }}</td>
                            <td class="col-md-2">{{ $item->DEPO_SISA }}</td>
                            <td class="col-md-3">{{ $item->MASA_BERLAKU }}</td>
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


    <div class="card mt-5">
        <div class="card-header">
            <h3 class="card-title">ALL DATA</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <!-- TOMBOL TAMBAH DATA -->

        <div class="card-body overflow-auto">
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />


            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-3">NAMA</th>
                        <th class="col-md-3">KELAS</th>
                        <th class="col-md-2">SISA DEPOSIT</th>
                        <th class="col-md-3">MASA BERLAKU</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members_after as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_DEPOSIT }}</td>
                            <td class="col-md-3">{{ $item->member->NAMA_MEMBER }}</td>
                            <td class="col-md-3">{{ $item->kelas->NAMA_KELAS }}</td>
                            <td class="col-md-2">{{ $item->DEPO_SISA }}</td>
                            @if ($item->MASA_BERLAKU != null)
                                <td class="col-md-3">{{ $item->MASA_BERLAKU }}</td>
                            @else
                                <td class="col-md-3">Belum Deposit Kelas</td>
                            @endif

                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Member Not Found
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
