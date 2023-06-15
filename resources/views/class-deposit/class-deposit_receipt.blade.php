@extends('layouts/application')

@section('judul-page')
    Receipt {{ $datadepoclass->member->NAMA_MEMBER }}
@endsection

@section('content-section')
    <section>
        {{-- <h2 class="text-center">RECEIPT</h2> --}}
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 35rem;">
            <div class="card-content">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3>GoFit</h3>
                        <p>Jl. Centralpark No.10 Yogyakarta</p>
                    </div>
                    <div>
                        <p>No Struk : {{ $datadepoclass->ID_TRANSAKSI_PAKET }}</p>
                        <p>Tanggal :
                            {{ \Carbon\Carbon::parse($datadepoclass->TANGGAL_DEPOSIT_KELAS)->format('d/m/Y H:i:s') }}</p>
                    </div>

                </div>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

                <h3>Receipt</h3>
                <p>Member : {{ $datadepoclass->member->ID_MEMBER }} / {{ $datadepoclass->member->NAMA_MEMBER }} </p>
                @if ($datadepoclass->ID_PROMO == 2)
                    <p>Deposit (bayar 5 gratis 1):
                        Rp.{{ $datadepoclass->JUMLAH_PEMBAYARAN }},- ({{ $datadepoclass->promot->MINIMAL_PEMBELIAN }} x
                        Rp.{{ $datadepoclass->kelas->TARIF }}) </p>
                @else
                    <p>Deposit (bayar 10 gratis 3):
                        Rp.{{ $datadepoclass->JUMLAH_PEMBAYARAN }},- ({{ $datadepoclass->promot->MINIMAL_PEMBELIAN }} x
                        Rp.{{ $datadepoclass->kelas->TARIF }}) </p>
                @endif

                <p>Jenis kelas: {{ $datadepoclass->kelas->NAMA_KELAS }}</p>
                <p>Total deposit {{ $datadepoclass->kelas->NAMA_KELAS }} : {{ $datadepoclass->TOTAL_DEPOSIT_KELAS }}</p>
                <p>Berlaku sampai dengan:
                    {{ \Carbon\Carbon::parse($datadepoclass->MASA_BERLAKU_KELAS)->format('d/m/Y H:i:s') }}
                </p>
                <div class="float-end">
                    <p>Kasir : P{{ $datadepoclass->pegawai->ID_PEGAWAI }} /
                        {{ $datadepoclass->pegawai->NAMA_PEGAWAI }}</p>
                </div>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/class-deposit'
            window.location.href = "{{ URL::to('dashboard/class-deposit') }}"
        };
    </script>
@endsection
