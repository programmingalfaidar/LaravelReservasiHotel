@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                {{-- Card --}}
                <div class="card border-0 p-3">
                    <div class="card-body">

                        <h3 class="mb-4">{{ $title }}</h3>

                        {{-- Alert --}}
                        @if (session()->has('success'))
                            <small>
                                <div class="alert alert-primary alert-dismissible" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </small>
                        @endif
                        {{-- End Alert --}}

                        {{-- Table --}}
                        <div class="table-responsive">
                            <small>
                                <table class="table table-sm mb-5 table-bordered">
                                    <thead class="bg-secondary text-white">
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Kamar</th>
                                            <th>Harga</th>
                                            <th>Jumlah Kamar</th>
                                            <th>Total Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($pDetails))
                                            @if ($pDetails->count() > 0)
                                                @foreach ($pDetails as $detail)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        {{-- <td><img src="{{ asset('storage/'. $PDetails->kamar->image) }}" class="card-img-top" width="50" height="200"></td>  --}}
                                                        <td><a href="{{ asset('storage/' . $detail->Kamar->image) }}"
                                                                target="_blank"><img
                                                                    src="{{ asset('storage/' . $detail->Kamar->image) }}"
                                                                    alt="" width="40"
                                                                    title="{{ $detail->Kamar->image }}"></a></td>
                                                        <td>{{ $detail->kamar->kamar }}</td>
                                                        <td>RP. {{ number_format($detail->kamar->harga) }}</td>

                                                        <td>{{ $detail->jumlah }}</td>
                                                        <td>Rp. {{ number_format($detail->harga) }}</td>
                                                        <td>
                                                            <?php
                                                            $buktiTf = App\Models\BuktiPembayaranUser::where('pesanan_detail_id', $detail->id)->first();
                                                            ?>
                                                            @if (!empty($buktiTf))
                                                                <a href="/cetak-pdf/{{ $detail->id }}"
                                                                    class="btn btn-info btn-sm text-end">Cetak</a>
                                                            @endif
                                                            <a
                                                                href="/detail-pesanan-user/{{ $detail->id }}"class="btn btn-sm btn-warning">Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td class="text-danger" colspan="8">Anda belum memiliki history
                                                        pemesanan tiket</td>
                                                </tr>
                                            @endif
                                        @else
                                            <tr>
                                                <td class="text-danger" colspan="8">Anda belum memiliki history pemesanan
                                                    tiket</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </small>
                        </div>
                        {{-- End Table --}}

                    </div>
                    <div class="col-lg-4 offset-lg-4 ">
                        @if (empty($buktiTf))
                            <marquee behavior="" direction=""><small>
                                    <p class="text-end text-success" style="font-style: italic"><strong>Silahkan upload
                                            bukti
                                            pembayaran agar bisa mencetak tiket!</strong></p>
                                </small></marquee>
                        @else
                            <small>
                                <p class="text-end text-success text-center" style="font-style: italic; font-size: 20px">
                                    <strong>Silahkan Cetak Tiket
                                    </strong>
                                </p>
                            </small>

                    </div>
                    @endif
                </div>
                {{-- End card --}}
            </div>
        </div>

    </div>

    </div>
    </div>
@endsection
