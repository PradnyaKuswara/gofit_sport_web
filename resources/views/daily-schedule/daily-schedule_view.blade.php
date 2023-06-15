@extends('layouts/dashboard_layout')

@section('judul')
    Daily Schedule Page
@endsection

@section('main')
    @if ($day)
        <div class="card">
            <div class="card-header align-items-center">
                <h3 class="card-title text-center">DATA DAILY SCHEDULE</h3>
                <div class="pb-3">
                    <a href='{{ url('dashboard/generate-daily-schedule') }}' class="btn bg-success text-white"> Generate Data
                        Schedule</a>
                    <a href='{{ url('dashboard/daily-schedule') }}'
                        class="btn btn-warning"{{ request()->is('dashboard/daily-schedule') ? 'hidden' : '' }}> <i
                            class="fa fa-backward"></i> Show all data</a>
                </div>


                <div class="pb-3">
                    <form class="d-flex" action="{{ url('dashboard/search-daily-schedule') }}" method="get">
                        <input class="form-control me-1 mt-1" type="search" name="keyword" placeholder="Keyword"
                            aria-label="Search" autocomplete="off">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>

            </div>
        </div>

        <!-- START DATA -->
        <div class=" card my-3 p-5 bg-body rounded shadow-sm">
            <div class="card-title p-2 my-auto text-end"> <b>MORNING</b></div>
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

            <div class="card-body overflow-auto">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Hari</th>
                            <th colspan="100" class="text-center">Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>

                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(1)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(1)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(2)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(2)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(3)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(3)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(4)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(4)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(5)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(5)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(6)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(6)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL <= '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end ">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>

                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
        <!-- AKHIR DATA -->

        <!-- START DATA -->
        <div class=" card my-5 p-5 bg-body rounded shadow-sm">
            <div class="card-title p-2 my-auto text-end"><b>EVENING</b> </div>
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
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>

                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(1)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(1)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(1)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(2)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(2)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(2)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(3)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(3)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(3)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(4)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(4)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(4)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(5)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(5)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(5)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                        <tr>
                            <td>
                                @if ($day != null)
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(6)->format('l') }}</div>
                                    <div>{{ $day->TANGGAL_JADWAL_HARIAN->addDays(6)->format('Y M d') }}</div>
                                @endif
                            </td>
                            @foreach ($schedule_daily as $item)
                                @if (
                                    $item->schedule->HARI_JADWAL == $day->TANGGAL_JADWAL_HARIAN->addDays(6)->translatedformat('l') &&
                                        $item->schedule->WAKTU_JADWAL > '12:00:00')
                                    <td>
                                        <div> {{ $item->TANGGAL_JADWAL_HARIAN->format('H:i:s') }}</div>
                                        <div>{{ $item->schedule->kelas->NAMA_KELAS }}</div>
                                        <div>{{ $item->instructor->NAMA_INSTRUKTUR }}</div>
                                        <div>({{ $item->KETERANGAN_JADWAL_HARIAN }})</div>
                                        <div class="d-flex justify-content-end">
                                            <a href='{{ url('dashboard/edit-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-outline-success btn-md rounded-3 me-2"><i
                                                    class="fas fa-pencil"></i></a>
                                            <a href='{{ url('dashboard/abolished-daily-schedule/' . $item->TANGGAL_JADWAL_HARIAN) }}'
                                                class="btn btn-md btn-outline-danger rounded-3"><i
                                                    class="fas fa-square-xmark"></i></a>
                                        </div>
                                    </td>
                                @endif
                            @endforeach
                        </tr>

                    </tbody>
                </table>
                <div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            Schedule data not yet generate
        </div>
        <div class="card">
            <div class="card-header align-items-center">
                <h3 class="card-title">DATA DAILY SCHEDULE</h3>
                <a href='{{ url('dashboard/generate-daily-schedule') }}' class="btn bg-success text-white mb-3">
                    Generate Data
                    Schedule</a>

            </div>
        </div>
    @endif

@endsection
