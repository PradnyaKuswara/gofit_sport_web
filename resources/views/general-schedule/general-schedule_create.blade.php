@extends('layouts/dashboard_layout')

@section('judul')
    Create Schedule Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA GENERAL SCHEDULE</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <h3 class="card-title text-center">Create New Schedule</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/store-general-schedule') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Kelas</label>
                    <select class="form-control" aria-label="Default select example" name="ID_KELAS">
                        <option value="" hidden>Select Class</option>
                        @foreach ($kelas as $item_kelas)
                            <option value="{{ $item_kelas->ID_KELAS }}">{{ $item_kelas->NAMA_KELAS }}</option>
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
                            <option value="{{ $item_instructor->ID_INSTRUKTUR }}">{{ $item_instructor->NAMA_INSTRUKTUR }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Hari</label>
                    <select class="form-control" aria-label="Default select example" name="HARI_JADWAL">
                        <option value="" hidden>Select Day</option>
                        <option value="Senin">Monday</option>
                        <option value="Selasa">Tuesday</option>
                        <option value="Rabu">Wednesday</option>
                        <option value="Kamis">Thursday</option>
                        <option value="Jumat">Friday</option>
                        <option value="Sabtu">Saturday</option>
                        <option value="Minggu">Sunday</option>
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Waktu Jadwal</label>
                    <div class='input-group date' id='datetimepickerschedule'>
                        <input type='text' class="form-control"name="WAKTU_JADWAL"
                            placeholder="Input date of birth instructor" autocomplete="off" value="" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success btn-block mb-4">Create Schedule</button>
                </div>
            </div>

            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <div class="info text-center blockquote-footer mt-2">
                powered by@GOFIT-200710850
            </div>
        </form>
    </div>
@endsection
