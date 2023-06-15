@extends('layouts/dashboard_layout')

@section('judul')
    Edit Schedule Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA GENERAL SCHEDULE</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <h3 class="card-title text-center">Edit Data Schedule</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/edit-general-schedule/update-general-schedule/' . $schedule->ID_JADWAL_UMUM) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Kelas</label>
                    <select class="form-control" aria-label="Default select example" name="ID_KELAS">
                        <option value="" hidden>Select Class</option>
                        @foreach ($kelas as $item_kelas)
                            {{-- <option value="{{ $item_kelas->ID_KELAS }}">{{ $item_kelas->NAMA_KELAS }}</option> --}}
                            <option value="{{ $item_kelas->ID_KELAS }}"
                                {{ $schedule->ID_KELAS == $item_kelas->ID_KELAS ? 'selected' : '' }}>
                                {{ $item_kelas->NAMA_KELAS }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Instruktur</label>
                    <select class="form-control" aria-label="Default select example" name="ID_INSTRUKTUR">
                        <option value="" hidden>Select Instructor</option>
                        @foreach ($instructors as $item_instructor)
                            <option value="{{ $item_instructor->ID_INSTRUKTUR }}"
                                {{ $schedule->ID_INSTRUKTUR == $item_instructor->ID_INSTRUKTUR ? 'selected' : '' }}>
                                {{ $item_instructor->NAMA_INSTRUKTUR }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Hari</label>
                    <select class="form-control" aria-label="Default select example" name="HARI_JADWAL">
                        <option value="" hidden>Select Day</option>
                        @if ($schedule->HARI_JADWAL == 'Senin')
                            <option value="Senin" selected>Monday</option>
                        @else
                            <option value="Senin">Monday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Selasa')
                            <option value="Selasa" selected>Tuesday</option>
                        @else
                            <option value="Selasa">Tuesday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Rabu')
                            <option value="Rabu" selected>Wednesday</option>
                        @else
                            <option value="Rabu">Wednesday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Kamis')
                            <option value="Kamis" selected>Thursday</option>
                        @else
                            <option value="Kamis">Thursday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Jumat')
                            <option value="Jumat" selected>Friday</option>
                        @else
                            <option value="Jumat">Friday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Sabtu')
                            <option value="Sabtu" selected>Saturday</option>
                        @else
                            <option value="Sabtu">Saturday</option>
                        @endif
                        @if ($schedule->HARI_JADWAL == 'Minggu')
                            <option value="Minggu" selected>Sunday</option>
                        @else
                            <option value="Minggu">Sunday</option>
                        @endif

                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Waktu Jadwal</label>
                    <div class='input-group date' id='datetimepickerschedule'>
                        <input type='text' class="form-control"name="WAKTU_JADWAL"
                            placeholder="Input date of birth instructor" autocomplete="off"
                            value="{{ $schedule->WAKTU_JADWAL }}" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success btn-block mb-4">Update Schedule</button>
                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <div class="info text-center blockquote-footer mt-2">
                powered by@GOFIT-200710850
            </div>
        </form>
    </div>
@endsection
