@extends('layouts/application')

@section('judul-page')
    Receipt {{ $presensies->member->NAMA_MEMBER }}
@endsection

@section('content-section')
    <section>
        {{-- <h2 class="text-center">RECEIPT</h2> --}}
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 35rem;">
            <div class="card-content">
                <h3>GoFit</h3>
                <p>Jl. Centralpark No.10 Yogyakarta</p>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <h3>STRUK PRESENSI GYM</h3>
                <p>No Struk: {{ $presensies->KODE_BOOKING_GYM }} </p>
                @if ($presensies->WAKTU_KONFIRMASI_PRESENSI != null)
                    <p>Tanggal :
                        {{ \Carbon\Carbon::parse($presensies->WAKTU_KONFIRMASI_PRESENSI)->format('d/m/Y H:i:s') }}
                    </p>
                @else
                    <p>Tanggal : Belum dikonfirmasi </p>
                @endif

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <p>Member : {{ $presensies->ID_MEMBER }} / {{ $presensies->member->NAMA_MEMBER }}</p>
                <p>Slot Waktu : {{ $presensies->SLOT_WAKTU_GYM }}</p>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/presensi-booking-gym'
            window.location.href = "{{ URL::to('dashboard/presensi-booking-gym') }}"
        };
    </script>
@endsection
