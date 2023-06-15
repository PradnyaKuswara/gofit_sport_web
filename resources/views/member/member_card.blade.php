@extends('layouts/application')

@section('judul-page')
    Member Card {{ $member->NAMA_MEMBER }}
@endsection

@section('content-section')
    <section>
        <h2 class="text-center">MEMBER CARD</h2>
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 50rem;">
            <div class="card-content">
                <h3>GoFit</h3>
                <p>Jl. Centralpark No.10 Yogyakarta</p>
                <h3>Member Card</h3>
                <p>Member ID : {{ $member->ID_MEMBER }} </p>
                <p>Nama : {{ $member->NAMA_MEMBER }} </p>
                <p>Alamat : {{ $member->ALAMAT_MEMBER }} </p>
                <p>Telepon : {{ $member->TELEPON_MEMBER }}</p>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/member'
            window.location.href = "{{ URL::to('dashboard/member') }}"
        };
    </script>
@endsection
