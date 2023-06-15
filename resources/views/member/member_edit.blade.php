@extends('layouts/dashboard_layout')

@section('judul')
    Edit Member Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA MEMBER</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="card-title mb-2 text-center">Edit Data Member</h3>
        <p class="subtitle mb-2 text-center">note: If you input defualt/empty data, the data will not change</p>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/edit-member/update-member/' . $member->ID_MEMBER) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Name</label>
                    <input type="text" class="form-control" name="NAMA_MEMBER" value="{{ $member->NAMA_MEMBER }}"
                        placeholder="Input member name" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> Address</label>
                    <input type="text" class="form-control " name="ALAMAT_MEMBER" value="{{ $member->ALAMAT_MEMBER }}"
                        placeholder="Input member address" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> DOB</label>
                    <div class='input-group date' id='datetimepickermember'>
                        <input type='text' class="form-control"name="TANGGAL_LAHIR_MEMBER"
                            placeholder="Input date of birth member" autocomplete="off"
                            value="{{ $member->TANGGAL_LAHIR_MEMBER }}" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Call Number</label>
                    <input type="tel" class="form-control " name="TELEPON_MEMBER" value="{{ $member->TELEPON_MEMBER }}"
                        placeholder="Input member number" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Age</label>
                    <input type="number" class="form-control " name="USIA_MEMBER" value="{{ $member->USIA_MEMBER }}"
                        placeholder="Input member age" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Gender</label>
                    <select class="form-control" aria-label="Default select example" name="JENIS_KELAMIN_MEMBER">
                        <option hidden>Select gender</option>
                        @if ($member->JENIS_KELAMIN_MEMBER == 'Laki-laki')
                            <option value="Laki-laki" selected>Laki-laki</option>
                        @else
                            <option value="Laki-laki">Laki-laki</option>
                        @endif

                        @if ($member->JENIS_KELAMIN_MEMBER == 'Perempuan')
                            <option value="Perempuan" selected>Perempuan</option>
                        @else
                            <option value="Perempuan">Perempuan</option>
                        @endif
                    </select>
                </div>
            </div>

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Gender</label>
                    <input type="text"
                        class="form-control "
                        name="JENIS_KELAMIN_MEMBER" value="{{ $member->JENIS_KELAMIN_MEMBER }}"
                        placeholder="Input member gender" autocomplete="off"/>
                </div>
            </div> --}}

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Activated</label>
                    <input type="datetime"
                        class="form-control "
                        name="MASA_AKTIVASI" value="{{ old('MASA_AKTIVASI') }}"
                        placeholder="">
                </div>
            </div> --}}

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Depo Money</label>
                    <input type="number"
                        class="form-control "
                        name="SISA_DEPOSIT_MEMBER" value="{{ old('SISA_DEPOSIT_MEMBER') }}"
                        placeholder="">
                </div>
            </div> --}}

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Depo Class</label>
                    <input type="number"
                        class="form-control "
                        name="SISA_DEPOSIT_KELAS" value="{{ old('SISA_DEPOSIT_KELAS') }}"
                        placeholder="">
                </div>
            </div> --}}

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Email</label>
                    <input type="email" class="form-control " name="EMAIL_MEMBER" value="{{ $member->EMAIL_MEMBER }}"
                        placeholder="Input member email" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Password</label>
                    <input type="password" class="form-control " name="password" value=""
                        placeholder="Input member password" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-success btn-block mb-4">Update Member</button>
                </div>
            </div>

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <a href="{{ url('dashboard/member') }}" class="btn btn-warning btn-block mb-4">Cancel Update
                        Member</a>
                </div>
            </div> --}}
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <div class="info text-center blockquote-footer mt-2">
                powered by@GOFIT-200710850
            </div>
        </form>
    </div>
@endsection
