@extends('layouts/application')

@section('judul-page')
    Receipt {{ $dataActivation->member->NAMA_MEMBER }}
@endsection

@section('content-section')
    <section>
        {{-- <h2 class="text-center">RECEIPT</h2> --}}
        <div class="card my-3 p-3 bg-body rounded shadow-sm mx-auto"style="width: 50rem;">
            <div class="card-content">
                <div class="d-flex justify-content-between">
                    <div>
                        <h3 class="font-weight-bold">GoFit</h3>
                        <p>Jl. Centralpark No.10 Yogyakarta</p>
                    </div>
                    <div>
                        <p>No Struk : {{ $dataActivation->ID_TRANSAKSI_AKTIVASI }}</p>
                        <p>Tanggal :
                            {{ \Carbon\Carbon::parse($dataActivation->TANGGAL_TRANSAKSI_AKTIVASI)->format('d/m/Y H:i:s') }}
                        </p>
                    </div>

                </div>

                <hr style="width: 100%; color: black; height: 1px; background-color:black;" />

                <h3>Receipt</h3>
                <p>Member : {{ $dataActivation->member->ID_MEMBER }} /
                    {{ $dataActivation->member->NAMA_MEMBER }} </p>
                <p>Aktivasi Tahunan : Rp.{{ $dataActivation->BIAYA_AKTIVASI }},- </p>
                <p>Masa Aktif Member :
                    {{ \Carbon\Carbon::parse($dataActivation->TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI)->format('d/m/Y H:i:s') }}
                </p>
                {{-- <p>Uang Kembalian: Rp.{{ $dataActivation->KEMBALIAN }},-</p> --}}
                <div class="float-end">
                    <p>Kasir : P{{ $dataActivation->pegawai->ID_PEGAWAI }} / {{ $dataActivation->pegawai->NAMA_PEGAWAI }}
                    </p>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.print();
        window.onafterprint = function(event) {
            // window.location.href = 'http://localhost:8000/dashboard/activation-transaction'
            window.location.href = "{{ URL::to('dashboard/activation-transaction') }}"
        };
    </script>
@endsection
