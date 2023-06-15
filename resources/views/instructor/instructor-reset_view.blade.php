@extends('layouts/dashboard_layout')

@section('judul')
    Reset Late Instructur Page
@endsection

@section('main')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">INSTRUCTOR</h3>
        </div>
    </div>
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->

        <!-- TOMBOL TAMBAH DATA -->
        <div class="">
            <a href='{{ url('dashboard/reset-late-instructor') }}'
                class="btn btn-warning"{{ request()->is('dashboard/reset-late-instructor') ? 'hidden' : '' }}> <i
                    class="fa fa-backward"></i>Show all data</a>
            <a href='{{ url('dashboard/reset-late-instructor-process') }}' class="btn bg-danger text-white float-end">
                Reset Late</a>
        </div>


        <div class="card-body overflow-auto">
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-1">NAME</th>
                        <th class="col-md-2">ADDRESS</th>
                        <th class="col-md-2">NUMBER</th>
                        <th class="col-md-1">AGE</th>
                        <th class="col-md-1">GENDER</th>
                        <th class="col-md-5">BORN</th>
                        <th class="col-md-5">EMAIL</th>
                        <th class="col-md-5">LATE(second)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($instructors as $item)
                        <tr>
                            <td class="col-md-1">{{ $item->ID_INSTRUKTUR }}</td>
                            <td class="col-md-1">{{ $item->NAMA_INSTRUKTUR }}</td>
                            <td class="col-md-2">{{ $item->ALAMAT_INSTRUKTUR }}</td>
                            <td class="col-md-2">{{ $item->TELEPON_INSTRUKTUR }}</td>
                            <td class="col-md-1">{{ $item->UMUR_INSTRUKTUR }}</td>
                            <td class="col-md-1">{{ $item->JENIS_KELAMIN_INSTRUKTUR }}</td>
                            <td class="col-md-5">{{ $item->TANGGAL_LAHIR_INSTRUKTUR }}</td>
                            <td class="col-md-5">{{ $item->EMAIL_INSTRUKTUR }}</td>
                            @if ($item->JUMLAH_TERLAMBAT != null || $item->JUMLAH_TERLAMBAT != 0)
                                <td class="col-md-5">{{ $item->JUMLAH_TERLAMBAT }}</td>
                            @else
                                <td class="col-md-5">0</td>
                            @endif
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Instructor Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $instructors->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
