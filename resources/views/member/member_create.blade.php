@extends('layouts/dashboard_layout')

@section('judul')
    Create Member Page
@endsection

@section('main')
    {{-- <div class="card">
        <div class="card-header"style="background-color:#F9E2AF">
            <h3 class="card-title">DATA MEMBER</h3>
        </div>
    </div> --}}
    <div class=" card my-3 p-3 bg-body rounded shadow-sm">
        <h3 class="card-title text-center">Create New Member</h3>
        <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
        <form action="{{ url('dashboard/store-member') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Nama</label>
                    <input type="text" class="form-control" name="NAMA_MEMBER" value="{{ Session::get('NAMA_MEMBER') }}"
                        placeholder="Input member name" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> Alamat</label>
                    <input type="text" class="form-control " name="ALAMAT_MEMBER"
                        value="{{ Session::get('ALAMAT_MEMBER') }}" placeholder="Input member address" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2"> Tanggal Lahir</label>
                    <div class='input-group date' id='datetimepickermember'>
                        <input type='text' class="form-control"name="TANGGAL_LAHIR_MEMBER"
                            placeholder="Input date of birth member" autocomplete="off" value="" />
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Nomor Telepon</label>
                    <input type="tel" class="form-control " name="TELEPON_MEMBER"
                        value="{{ Session::get('TELEPON_MEMBER') }}" placeholder="Input member number" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Umur</label>
                    <input type="number" class="form-control " name="USIA_MEMBER" value="{{ Session::get('USIA_MEMBER') }}"
                        placeholder="Input member age" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Jenis Kelamin</label>
                    <select class="form-control" aria-label="Default select example" name="JENIS_KELAMIN_MEMBER">
                        <option value="" hidden>Select gender</option>
                        @if (Session::has('JENIS_KELAMIN_MEMBER') == null)
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @endif

                        @if (Session::has('JENIS_KELAMIN_MEMBER') && Session::get('JENIS_KELAMIN_MEMBER') == '')
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        @endif

                        @if (Session::has('JENIS_KELAMIN_MEMBER') && Session::get('JENIS_KELAMIN_MEMBER') == 'Laki-laki')
                            <option value="{{ Session::get('JENIS_KELAMIN_MEMBER') }}" selected>
                                {{ Session::get('JENIS_KELAMIN_MEMBER') }}</option>
                            <option value="Perempuan">Perempuan</option>
                        @endif

                        @if (Session::has('JENIS_KELAMIN_MEMBER') && Session::get('JENIS_KELAMIN_MEMBER') == 'Perempuan')
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="{{ Session::get('JENIS_KELAMIN_MEMBER') }}" selected>
                                {{ Session::get('JENIS_KELAMIN_MEMBER') }}</option>
                        @endif

                    </select>
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Email</label>
                    <input type="email" class="form-control " name="EMAIL_MEMBER"
                        value="{{ Session::get('EMAIL_MEMBER') }}" placeholder="Input member email" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-3">
                <div class="form-group col-md-6">
                    <label class="font-weight-bold mb-2">Password</label>
                    <input type="password" class="form-control " name="password" value="{{ Session::get('password') }}"
                        placeholder="Input member password" autocomplete="off" />
                </div>
            </div>

            <div class="form-row mb-2">
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-outline-success  btn-block mb-4">Create
                        Member</button>
                </div>
            </div>

            {{-- <div class="form-row mb-2">
                <div class="form-group col-md-6">
                    <a href="{{ url('dashboard/member') }}" class="btn btn-warning btn-block mb-4">Cancel Create
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
