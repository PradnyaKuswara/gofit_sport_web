@extends('layouts/application')

@section('judul-page')
    Receipt {{ $presensies->NAMA_MEMBER }}
@endsection

@section('content-section')
    <section>
        {{-- <h2 class="text-center">RECEIPT</h2> --}}
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 35rem;">
            <div class="card-content">
                <h3>GoFit</h3>
                <p>Jl. Centralpark No.101 Yogyakarta</p>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <h3>STRUK PRESENSI KELAS</h3>
                <p>No Struk: {{ $presensies->KODE_BOOKING_KELAS }} </p>
                @if ($presensies->WAKTU_KONFIRMASI_PRESENSI_KELAS != null)
                    <p>Tanggal :
                        {{ \Carbon\Carbon::parse($presensies->WAKTU_KONFIRMASI_PRESENSI_KELAS)->format('d/m/Y H:i:s') }}
                    </p>
                @else
                    <p>Tanggal : Belum dikonfirmasi </p>
                @endif

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
                <p>Member : {{ $presensies->ID_MEMBER }} / {{ $presensies->NAMA_MEMBER }}</p>
                <p>Kelas : {{ $presensies->NAMA_KELAS }}</p>
                <p>Instruktur : {{ $presensies->NAMA_INSTRUKTUR }}</p>
                @if ($presensies->TARIF_KELAS != 1)
                    <p>Tarif : Rp.{{ $presensies->TARIF_KELAS }}</p>
                    <p>Sisa deposit : Rp.{{ $presensies->SISA_DEPOSIT_MEMBER }}</p>
                @else
                    <p>Sisa Deposit: {{ $presensies2->DEPO_SISA }}x</p>
                    <p>Berlaku Sampai: {{ \Carbon\Carbon::parse($presensies2->MASA_BERLAKU)->format('d/m/Y H:i:s') }}</p>
                @endif


            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/presensi-booking-class'
            window.location.href = "{{ URL::to('dashboard/presensi-booking-class') }}"
        };
    </script>
@endsection
