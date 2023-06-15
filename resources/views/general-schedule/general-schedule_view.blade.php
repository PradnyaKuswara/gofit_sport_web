@extends('layouts/dashboard_layout')

@section('judul')
    General Schedule Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA GENERAL SCHEDULE</h3>
        </div>
    </div> --}}
    <!-- START DATA -->
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <div class="card-title p-2 font-weight-bold text-end"><b>MORNING</b> </div>

        <!-- TOMBOL TAMBAH DATA -->
        <div class="">
            <a href='{{ url('dashboard/create-general-schedule') }}' class="btn bg-success text-white"> Add General
                Schedule</a>
        </div>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />


        <div class="card-body overflow-auto">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Hari</th>
                        <th colspan="12" class="text-center">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Monday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Senin' && $item->WAKTU_JADWAL <= '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Tuesday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Selasa' && $item->WAKTU_JADWAL <= '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <th>Wednesday</th>
                    @foreach ($schedules as $item)
                        @if ($item->HARI_JADWAL == 'Rabu' && $item->WAKTU_JADWAL <= '12:00:00')
                            <td>
                                <div> {{ $item->WAKTU_JADWAL }}</div>
                                <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex justify-content-end">
                                    <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                        class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                            class="fas fa-pencil"></i></a>
                                    <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                        action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <tr>

                    </tr>
                    <th>Thursday</th>
                    @foreach ($schedules as $item)
                        @if ($item->HARI_JADWAL == 'Kamis' && $item->WAKTU_JADWAL <= '12:00:00')
                            <td>
                                <div> {{ $item->WAKTU_JADWAL }}</div>
                                <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex justify-content-end">
                                    <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                        class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                            class="fas fa-pencil"></i></a>
                                    <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                        action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <tr>
                        <th>Friday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Jumat' && $item->WAKTU_JADWAL <= '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Saturday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Sabtu' && $item->WAKTU_JADWAL <= '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Sunday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Minggu' && $item->WAKTU_JADWAL <= '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>
    </div>
    <!-- AKHIR DATA -->

    <!-- START DATA -->
    <div class=" card my-5 p-5 bg-body rounded shadow-sm">
        <div class="card-title p-2 font-weight-bold text-end"><b>EVENING</b> </div>
        <!-- TOMBOL TAMBAH DATA -->
        <div class="">
            <a href='{{ url('dashboard/create-general-schedule') }}' class="btn bg-success text-white"> Add General
                Schedule</a>
        </div>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

        <div class="card-body overflow-auto">

            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th class="text-center">Hari</th>
                        <th colspan="3" class="text-center">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Monday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Senin' && $item->WAKTU_JADWAL > '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Tuesday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Selasa' && $item->WAKTU_JADWAL > '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <th>Wednesday</th>
                    @foreach ($schedules as $item)
                        @if ($item->HARI_JADWAL == 'Rabu' && $item->WAKTU_JADWAL > '12:00:00')
                            <td>
                                <div> {{ $item->WAKTU_JADWAL }}</div>
                                <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex justify-content-end">
                                    <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                        class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                            class="fas fa-pencil"></i></a>
                                    <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                        action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <tr>

                    </tr>
                    <th>Thursday</th>
                    @foreach ($schedules as $item)
                        @if ($item->HARI_JADWAL == 'Kamis' && $item->WAKTU_JADWAL > '12:00:00')
                            <td>
                                <div> {{ $item->WAKTU_JADWAL }}</div>
                                <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                <div class="d-flex justify-content-end">
                                    <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                        class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                            class="fas fa-pencil"></i></a>
                                    <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                        action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    @endforeach
                    <tr>
                        <th>Friday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Jumat' && $item->WAKTU_JADWAL > '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Saturday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Sabtu' && $item->WAKTU_JADWAL > '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                    <tr>
                        <th>Sunday</th>
                        @foreach ($schedules as $item)
                            @if ($item->HARI_JADWAL == 'Minggu' && $item->WAKTU_JADWAL > '12:00:00')
                                <td>
                                    <div> {{ $item->WAKTU_JADWAL }}</div>
                                    <div>{{ $item->kelas->NAMA_KELAS }}</div>
                                    <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                    <div class="d-flex justify-content-end">
                                        <a href='{{ url('dashboard/edit-general-schedule/' . $item->ID_JADWAL_UMUM) }}'
                                            class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                class="fas fa-pencil"></i></a>
                                        <form onsubmit="return confirm('Are you sure delete schedule ?');"
                                            action="{{ url('dashboard/delete-general-schedule/' . $item->ID_JADWAL_UMUM) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            @endif
                        @endforeach
                </tbody>
            </table>
            <div>
            </div>
        </div>
    </div>
@endsection
