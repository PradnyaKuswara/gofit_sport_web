@extends('layouts/application')

@section('judul-page')
    Confirmation pay
@endsection

@section('content-section')
    <section>
        <div class=" card my-5 p-5  rounded shadow-lg w-100 mx-auto">
            <h3 class="card-title text-center">CONFIRMATION PAY</h3>
            <hr style="width: 100%; color: black; height: 1px; background-color:black;" />
            <form action="{{ url('dashboard/create-money-deposit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row mb-2 d-flex">
                    <div class="form-group col-md-5">
                        <p>ID Member: {{ $member->ID_MEMBER }}</p>
                        <p>Nama Member: {{ $member->NAMA_MEMBER }}</p>
                        <p>Alamat Member: {{ $member->ALAMAT_MEMBER }}</p>
                        <label class="font-weight-bold mb-2 mt-2"><b>Jumlah Uang</b> </label>
                        <input type='text' class="form-control mb-3"name="JUMLAH_UANG" placeholder="Input your money"
                            autocomplete="off" />
                    </div>
                    <div class="form-group col-md-6 ms-auto">
                        <input type='text' class="form-control mb-3"name="ID_MEMBER"
                            placeholder="Input date of birth member" autocomplete="off" value="{{ $member->ID_MEMBER }}"
                            hidden />
                        <label class="font-weight-bold mb-2"><b>Sisa Deposit Member</b></label>
                        <input type='text' class="form-control mb-3"name="SISA_DEPOSIT"
                            placeholder="Input date of birth member" autocomplete="off"
                            value="{{ $member->SISA_DEPOSIT_MEMBER }}" readonly />
                        <label class="font-weight-bold mb-2"><b>Tanggal Transaksi</b></label>
                        <input type='text' class="form-control mb-3"name="TANGGAL_EXPIRED_TRANSAKSI_AKTIVASI"
                            placeholder="Input date of birth member" autocomplete="off"
                            value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" disabled />
                        <label class="font-weight-bold mb-2"><b>Jumlah Deposit</b></label>
                        <input type='text' class="form-control mb-3"name="JUMLAH_DEPOSIT"
                            placeholder="Input date of birth member" autocomplete="off" value="{{ $jumlah_deposit }}"
                            readonly />

                    </div>
                </div>
                <button type="submit" class="btn btn-success btn-block col-md-12 mb-4"
                    data-loading-text="Loading...">Deposit</button>
            </form>
        </div>
    </section>
@endsection
