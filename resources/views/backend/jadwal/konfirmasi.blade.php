@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Konfirmasi Kedatangan</h5>

            </div>
            <div class="ibox-content">
                <div class="search-form">
                    <form action="{{ route('backend.jadwal.konfirmasi') }}" method="get">
                        <div class="input-group">
                            <input type="text" placeholder="Kode booking" id="cari" name="cari" value="{{ $cari }}" class="form-control input-lg">
                            <div class="input-group-btn">
                                <button class="btn btn-lg btn-primary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if($cari)
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">

                <h5>Detail Booking</h5>

            </div>
            <div class="ibox-content">

                @if(!$transaksi)

                <h2>Detail booking tidak ditemukan.</h2>

                @else
                @if($transaksi->status == 1 || $transaksi->status == 2)
                <div class="pull-right">
                    <form action="{{ route('backend.jadwal.konfirmasiulang') }}" method="post">
                        @csrf
                        <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi->id }}" />
                        <input type="hidden" name="search" id="search" value="{{ $cari }}" />
                        <input type="hidden" name="status" id="status" value="" />
                        <button class="btn btn-outline btn-primary dim" type="submit" onClick="changeStatus(3)"><i class="fa fa-check"></i> Dikonfirmasi</button>
                        <button class="btn btn-outline btn-danger dim" type="submit" onClick="changeStatus(-1)"><i class="fa fa-times"></i> Dibatalkan</button>
                    </form>
                </div>
                @endif

                <div class="timeline-item">
                    <div class="row">
                        <div class="col-xs-3 date">
                            <i class="fa fa-calendar-plus-o"></i>
                        </div>
                        <div class="col-xs-7 content no-top-border">
                            <p class="m-b-xs text-capitalize"><h3>Detail jadwal</h3></p>

                            <p>Kode booking : <strong>{{ $transaksi->kodebooking }}</strong></p>
                            <p>Tanggal booking : {{ $transaksi->tanggalbooking->format('d-m-Y').', '.date('H:i',strtotime($transaksi->jampraktek_awal)).' - '.date('H:i',strtotime($transaksi->jampraktek_akhir)) }}</p>
                            <p>Jam kedatangan : {{ isset($transaksi->antrian->jam_kedatangan) ? date('H:i',strtotime($transaksi->antrian->jam_kedatangan)) : '-' }}</p>
                            <p>Poliklinik : {{ $transaksi->poliklinik->namapoliklinik }}</p>
                            <p>Dokter : {{ $transaksi->dokter->namalengkap }}</p>
                            <p>Status kedatangan : <strong>{{ $transaksi->statusTransaksi->xs1 }}</strong></p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="row">
                        <div class="col-xs-3 date">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="col-xs-7 content no-top-border">
                            <p class="m-b-xs"><h3>Detail pasien</h3></p>

                            <p>Nama : {{ ucwords($transaksi->keluarga->namalengkap) }}</p>
                            <p>Status dalam keluarga : {{ $transaksi->keluarga->status_dalam_keluarga }}</p>
                            <p>Tanggal lahir : {{ ($transaksi->keluarga->tanggal_lahir) ? $transaksi->keluarga->tanggal_lahir->format('d-m-Y') : '' }}</p>
                            <p>Telepon : {{ $transaksi->keluarga->notelpon }}</p>
                            <p>Alamat : {{ $transaksi->keluarga->alamat }}</p>
                            <p>Email : {{ $transaksi->keluarga->email }}</p>
                        </div>
                    </div>
                </div>

                <div class="timeline-item">
                    <div class="row">
                        <div class="col-xs-3 date">
                            <i class="fa fa-user-circle"></i>
                            <img alt="image" class="img-circle" style="max-width: 50px" src="{{ env('API_PATH').'/uploads/profiles/'.$transaksi->user->image }}">
                        </div>
                        <div class="col-xs-7 content no-top-border">
                            <p class="m-b-xs"><h3>Detail akun pengguna</h3></p>

                            <p>Nama : {{ ucwords($transaksi->user->name) }}</p>
                            <p>Tanggal terdaftar : {{ $transaksi->user->created_at->format('d-m-Y H:i:s') }}</p>
                            <p>Telepon : {{ $transaksi->user->telephone }}</p>
                            <p>Alamat : {{ $transaksi->user->address }}</p>
                            <p>Email : {{ $transaksi->user->email }}</p>
                        </div>
                    </div>
                </div>

                @endif
            </div>
        </div>
    </div>
    @endif
</div>

@endsection

@section('onpage-js')

@include('backend.layouts.message')

<script>
    $(document).ready(function () {

    });

    function changeStatus(id){
        $("#status").val(id);
    }
</script>

@endsection
