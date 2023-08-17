@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4 mt-3">
                    <h5 class="card-header">Default</h5>
                    <div class="card-body">
                        <form action="/pemesanan/{{ $kamar->id }}" method="Post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_pesanan" value="{{ $data->id }}">
                            <div class="mb-3">
                                <label for="kamar" class="form-label">Nama Kamar</label>
                                <input type="text" class="form-control" name="kamar" value="{{ $data->kamar }}"
                                    id="kamar" aria-describedby="defaultFormControlHelp" required autofocus disabled />
                            </div>
                            <div class="mb-3">
                                <label for="html5-date-input" class="form-label">Tanggal ChekcIn</label>
                                <input name="tanggal_pesan" class="form-control" type="date" value="2021-06-18"
                                    id="html5-date-input" />
                            </div>
                            <div class="mb-3">
                                <label for="defaultFormControlInput" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="defaultFormControlInput" name="harga"
                                    value="Rp. {{ $data->harga }}" aria-describedby="defaultFormControlHelp" required
                                    autofocus disabled />
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
                                <input class="form-control" type="number" value="0" id="jumlah_kamar"
                                    name="jumlah_kamar" />
                            </div>
                            <input type="hidden" name="cek_pesanan" value="0">

                            <div class="mt-3">
                                <button class="btn btn-primary text-end" type="submit">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
