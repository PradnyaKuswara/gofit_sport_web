@extends('layouts/dashboard_layout')

@section('judul')
    Edit Instructor Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header">
            <h3 class="card-title">DATA INSTRUCTOR</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="card-title text-center">Edit Data Instructor</h3>
        <p class="subtitle mb-2">If you input default/empty data, the data will not change</p>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/edit-instructor/update-instructor/' . $instructor->ID_INSTRUKTUR) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Nama</label>
                    <input type="text" class="form-control" name="NAMA_INSTRUKTUR"
                        value="{{ $instructor->NAMA_INSTRUKTUR }}" placeholder="Input instructor name" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> Alamat</label>
                    <input type="text" class="form-control " name="ALAMAT_INSTRUKTUR"
                        value="{{ $instructor->ALAMAT_INSTRUKTUR }}" placeholder="Input instructor address"
                        autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> Tanggal Lahir</label>
                    <div class='input-group date' id='datetimepickermember'>
                        <input type='text' class="form-control"name="TANGGAL_LAHIR_INSTRUKTUR"
                            placeholder="Input date of birth instructor" autocomplete="off"
                            value="{{ $instructor->TANGGAL_LAHIR_INSTRUKTUR }}" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Nomor Telepon</label>
                    <input type="tel" class="form-control " name="TELEPON_INSTRUKTUR"
                        value="{{ $instructor->TELEPON_INSTRUKTUR }}" placeholder="Input instructor number"
                        autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Umur</label>
                    <input type="number" class="form-control " name="UMUR_INSTRUKTUR"
                        value="{{ $instructor->UMUR_INSTRUKTUR }}" placeholder="Input instructor age" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Jenis Kelamin</label>
                    <select class="form-control" aria-label="Default select example" name="JENIS_KELAMIN_INSTRUKTUR">
                        <option hidden>Select gender</option>
                        @if ($instructor->JENIS_KELAMIN_INSTRUKTUR == 'Laki-laki')
                            <option value="Laki-laki" selected>Laki-laki</option>
                        @else
                            <option value="Laki-laki">Laki-laki</option>
                        @endif

                        @if ($instructor->JENIS_KELAMIN_INSTRUKTUR == 'Perempuan')
                            <option value="Perempuan" selected>Perempuan</option>
                        @else
                            <option value="Perempuan">Perempuan</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Email</label>
                    <input type="email" class="form-control " name="EMAIL_INSTRUKTUR"
                        value="{{ $instructor->EMAIL_INSTRUKTUR }}" placeholder="Input instructor email"
                        autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Password</label>
                    <input type="password" class="form-control " name="password" value=""
                        placeholder="Input instructor password" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success btn-block mb-4">Update Instructor</button>
                </div>
            </div>

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <a href="{{ url('dashboard/instructor') }}" class="btn btn-warning btn-block mb-4">Cancel Update
                        Instructor</a>
                </div>
            </div> --}}
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <div class="info text-center blockquote-footer mt-2">
                powered by@GOFIT-200710850
            </div>
        </form>
    </div>
@endsection
