@extends('layouts.main')

@section('content')
    <div class="container mt-4">

        @if (session()->has('success'))
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="alert alert-primary" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row mb-3">
            <div class="col-lg-4">
                <a href="/tambah-keranjang" class="btn btn-primary">Tambah Pesanan</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Image</th>
                                    <th>Kamar</th>
                                    <th>harga</th>
                                    <th>Jumlah Kamar</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if (!empty($pesanans))
                                    @if ($pesanans->count() > 0)
                                        @foreach ($pesanans as $pesanan)
                                            <tr>
                                                {{-- <td>{{ $loop->iteration }}</td> --}}
                                                <td>{{ $loop->iteration }}</td>
                                                <td><a href="{{ asset('storage/' . $pesanan->kamar->image) }}"
                                                        target="_blank"><img
                                                            src="{{ asset('storage/' . $pesanan->kamar->image) }}"
                                                            alt="" width="60"
                                                            title="{{ $pesanan->kamar->kamar }}"></a></td>
                                                <td>{{ $pesanan->Kamar->kamar }}</td>
                                                <td>Rp.{{ number_format($pesanan->Kamar->harga) }}</td>
                                                {{-- <td>{{ $pesanan->Pesanan->tanggal_pesan }}</td> --}}
                                                {{-- <td>{{ $pesanan->Pesanan->jumlah_kamar }}</td> --}}
                                                <td>{{ $pesanan->jumlah }}</td>
                                                <td>Rp. {{ number_format($pesanan->harga) }}</td>
                                                <td><a href="/detail-pesanan-user/{{ $pesanan->id }}"
                                                        class="badge bg-warning"><span
                                                            class="badge badge-warning btn-sm border-0"><i
                                                                class="bx bxs-bullseye"></i></span></a></td>

                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                @else
                                    <td colspan="6">Anda belum pesan</strong></td>
                                @endif

                            </tbody>
                    </div>
                </div>
            </div>
        @endsection
