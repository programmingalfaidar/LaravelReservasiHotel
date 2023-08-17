@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-6">
                <h3>Halaman Detail Pesanan</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <img class="card-img-top" src="{{ asset('storage/' . $PDetail->Kamar->image) }}" alt="Card image cap"
                        height="300" />
                    <div class="card-body">
                        <div class="card">
                            <h5 class="card-header">{{ $PDetail->Kamar->kamar }}</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <tbody class="table-border-bottom-0">
                                        <tr>
                                            <td>Harga Satuan</td>
                                            <td>:</td>
                                            <td>Rp.{{ number_format($PDetail->Kamar->harga) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Kamar</td>
                                            <td>:</td>
                                            <td>{{ number_format($PDetail->jumlah) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Total Harga</td>
                                            <td>:</td>
                                            <td>Rp.{{ number_format($PDetail->harga) }}</td>
                                        </tr>
                                </table>
                                </tbody>

                                {{-- alert checekout --}}
                                @if (session()->has('success'))
                                    <div class="row mt-3">
                                        <div class="col-lg-8">
                                            <small>
                                                <div class="alert alert-primary alert-dismissible" role="alert">
                                                    {{ session('success') }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </small>
                                        </div>
                                    </div>
                                @endif
                                {{-- endalert --}}

                                @if ($PDetail->status == 0)
                                    <small><strong>
                                            <p class="mx-3" style="font-style: italic; ">Silahkan Melakukan Chekout
                                                Terlebih dahulu sebelum melakukan upoad pembayaran</p>
                                        </strong></small>
                                @else
                                    <small class="mt-3"><strong>
                                            <p style="font-style: italic; margin-top: 5px; margin-left:20px">Silahkan Uploud
                                                Bukti Pembayaran
                                                Anda</p>
                                        </strong></small>
                                @endif
                            </div>
                            @if ($PDetail->status == 0)
                                <a href="/checkout/{{ $PDetail->id }}" class="btn btn-warning btn-sm col-lg-2 mx-3 mb-3"
                                    onclick="return confirm('Yakin Ingin Melakukan Chekcout ??')"><i
                                        class="bx bx-cart">CheckOut</i></a>
                            @elseif($PDetail->status == 1)
                                {{-- form checkout --}}
                                @if (empty($buktiTf))
                                    <form action="/Bukti-Pembayaran-User" method="Post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row ms-4">
                                            <div class="col-lg-8">
                                                <img class="col-lg-2 img-preview img-fluid mb-2" alt="">
                                                <input type="hidden" name="pesanan_detail_id" value="{{ $PDetail->id }}">
                                                <input type="file" name="image" class="form-control mb-2 col-lg-4"
                                                    onchange="PreviewImage()" id="image" required>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm ms-3 my-3 border-rounded-top">Silahkan
                                                    Kirim
                                                    Bukti Pembayaran</button>
                                            </div>
                                        </div>

                                    </form>
                                @else
                                    <p>dsds</p>
                                @endif
                            @else
                                <p>sdds</p>
                                {{-- <p>Kembali Ke Halaman History Anda</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="/history/{{ auth()->user()->id }}" class="btn btn-primary">History</a>

                                    </div>
                                </div> --}}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endsection
