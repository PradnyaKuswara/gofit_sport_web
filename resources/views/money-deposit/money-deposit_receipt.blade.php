@extends('layouts/application')

@section('judul-page')
    Receipt {{ $datadepomoney->member->NAMA_MEMBER }}
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
                        <p>No Struk : {{ $datadepomoney->ID_TRANSAKSI_DEPOSIT_UANG }}</p>
                        <p>Tanggal :
                            {{ \Carbon\Carbon::parse($datadepomoney->TANGGAL_DEPOSIT_UANG)->format('d/m/Y H:i:s') }}</p>
                    </div>

                </div>



                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

                <h3>Receipt</h3>
                <p>Member : {{ $datadepomoney->member->ID_MEMBER }} / {{ $datadepomoney->member->NAMA_MEMBER }} </p>
                <p>Deposit : Rp.{{ $datadepomoney->JUMLAH_DEPOSIT }},- </p>
                @if ($datadepomoney->BONUS_DEPOSIT != null)
                    <p>Bonus deposit : Rp.{{ $datadepomoney->BONUS_DEPOSIT }},- </p>
                @else
                    <p>Bonus deposit : Rp.0,- </p>
                @endif
                @if ($datadepomoney->SISA_DEPOSIT != null)
                    <p>Sisa deposit : Rp.{{ $datadepomoney->SISA_DEPOSIT }},- </p>
                @else
                    <p>Sisa deposit : Rp.0,- </p>
                @endif
                <p>Total deposit : Rp.{{ $datadepomoney->TOTAL_DEPOSIT }},- </p>
                {{-- <p>Uang Kembalian: Rp.{{ $datadepomoney->KEMBALIAN }},-</p> --}}
                <div class="float-end">
                    <p>Kasir : P{{ $datadepomoney->pegawai->ID_PEGAWAI }} /
                        {{ $datadepomoney->pegawai->NAMA_PEGAWAI }}</p>
                </div>

            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/money-deposit'
            window.location.href = "{{ URL::to('dashboard/money-deposit') }}"
        };
    </script>
@endsection
