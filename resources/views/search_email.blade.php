@extends('layouts/application')

@section('content-section')
    <section>
        <div class="container bg">
            <div class="card mx-auto my-5 shadow mb-5 bg-white rounded animate__animated animate__fadeInLeft">
                <div class="card-content">
                    @if ($pegawai == null && Session::get('pegawai') == null)
                        <form action="{{ url('search-email') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-4 p-5">
                                    <h2>Forgot Passsword</h2>
                                    <p>Please
                                        insert your email!</p>
                                    <!-- Email input -->
                                    <div class="form-group mt-5 mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input autofocus type="email" name="EMAIL_PEGAWAI" class="form-control"
                                                placeholder="Email" autocomplete="off" />
                                        </div>
                                        <label class="form-label" for="form2Example1">Email address</label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit"
                                        class="btn col-md-12 btn-outline-success btn-block mb-2">Search</button>
                                    <div class="info text-center blockquote-footer mt-2">
                                        powered by@GOFIT-200710850
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('image/image4.jpg') }}" alt="image"
                                        style="object-fit: cover; height:100%; width: 100%;">
                                </div>
                        </form>
                    @else
                        <form action="{{ url('change-password/' . Session::get('pegawai')->ID_PEGAWAI) }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mt-4 p-5">
                                    <h2>Forgot Passsword</h2>

                                    <!-- Password input -->
                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-lock"></i></span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                autocomplete="off" />
                                            <span class="input-group-text btn border" id="basic-addon1" onclick=""><i
                                                    class="fa fa-eye-slash"
                                                    onclick="change(this);myFunction(); "></i></span>
                                        </div>
                                        <label class="form-label" for="form2Example2">New Password</label>
                                    </div>

                                    <div class="form-group mb-4">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fa-solid fa-lock"></i></span>
                                            <input type="password" name="repassword" id="re-password" class="form-control"
                                                autocomplete="off" />
                                            <span class="input-group-text btn border" id="basic-addon1" onclick=""><i
                                                    class="fa fa-eye-slash"
                                                    onclick="change2(this);myFunction2(); "></i></span>
                                        </div>
                                        <label class="form-label" for="form2Example2">Confirm New Password</label>
                                    </div>


                                    <!-- Submit button -->
                                    <button type="submit" class="btn col-md-12 btn-outline-success btn-block mb-2">Change
                                        password</button>
                                    <div class="info text-center blockquote-footer mt-2">
                                        powered by@GOFIT-200710850
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="{{ asset('image/image4.jpg') }}" alt="image"
                                        style="object-fit: cover; height:100%; width: 100%;">
                                </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
