@extends('layouts/dashboard_layout')

@section('judul')
    Edit Daily Schedule Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">DATA DAILY SCHEDULE</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-5 bg-body rounded shadow-sm">
        <h3 class="card-title">Edit Data Schedule</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form
            action="{{ url('dashboard/edit-daily-schedule/update-daily-schedule/' . $schedule_daily->TANGGAL_JADWAL_HARIAN) }}"
            method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Keterangan Jadwal</label>
                    <input type="text" class="form-control " name="KETERANGAN_JADWAL_HARIAN"
                        value="{{ $schedule_daily->KETERANGAN_JADWAL_HARIAN }}" placeholder="Input member address"
                        autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Instruktur</label>
                    <select class="form-control" aria-label="Default select example" name="ID_INSTRUKTUR">
                        <option value="" hidden>Select Instructor</option>
                        @foreach ($instructors as $item_instructor)
                            <option value="{{ $item_instructor->ID_INSTRUKTUR }}"
                                {{ $schedule_daily->ID_INSTRUKTUR == $item_instructor->ID_INSTRUKTUR ? 'selected' : '' }}>
                                {{ $item_instructor->NAMA_INSTRUKTUR }}</option>
                        @endforeach
                    </select>
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
