@extends('layouts/dashboard_layout')

@section('judul')
    Instructur Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA INSTRUCTOR</h3>
        </div>
    </div> --}}
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <!-- FORM PENCARIAN -->
        <!-- TOMBOL TAMBAH DATA -->
        <div class="pb-3">
            <a href='{{ url('dashboard/instructor') }}'
                class="btn btn-warning"{{ request()->is('dashboard/instructor') ? 'hidden' : '' }}> <i
                    class="fa fa-backward"></i> Show all data</a>
            <a href='{{ url('dashboard/create-instructor') }}' class="btn bg-success text-white">
                Add Instructor</a>
        </div>
        <div class="pb-3">
            <form class="d-flex" action="{{ url('dashboard/search-instructor') }}" method="get">
                <input class="form-control me-1 mt-1" type="search" name="keyword" placeholder="Keyword"
                    aria-label="Search" autocomplete="off">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>




        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-1">ID</th>
                        <th class="col-md-1">NAMA</th>
                        <th class="col-md-2">ALAMAT</th>
                        <th class="col-md-2">NOMOR TELEPON</th>
                        <th class="col-md-1">UMUR</th>
                        <th class="col-md-1">JENIS KELAMIN</th>
                        <th class="col-md-5">TANGGAL LAHIR</th>
                        <th class="col-md-5">EMAIL</th>
                        <th class="col-md-5">TERLAMBAT</th>
                        <th class="col-md-5">ACTION</th>
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
                            <td class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <a href='{{ url('dashboard/edit-instructor/' . $item->ID_INSTRUKTUR) }}'
                                            class="btn btn-outline-success btn-md"><i class="fas fa-pencil"></i></a>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <form onsubmit="return confirm('Are you sure delete instructor ?');"
                                            action="{{ url('dashboard/delete-instructor/' . $item->ID_INSTRUKTUR) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>

                                {{-- <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('member.destroy', 
                        $item->ID_MEMBER) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form> --}}
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-danger">
                            Data Instructor Not Found
                        </div>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $instructors->links('pagination::bootstrap-5') }}
                {{-- @if (Request::is('dashboard/search-instructor'))
                {{ $instructors_search->links('pagination::bootstrap-5') }}
            @else
                {{ $instructors->links('pagination::bootstrap-5') }}
            @endif --}}

            </div>
        </div>
    </div>

    <!-- AKHIR DATA -->
@endsection
