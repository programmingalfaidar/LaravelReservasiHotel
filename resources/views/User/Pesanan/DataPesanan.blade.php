@extends('layouts.main')

@section('content')
    <div class="container mt-3">
        <div class="row mt-3">
            <div class="col-lg-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show col-lg-8" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">

            <div class="col-lg-4">
                <div class="input-group input-group-merge mb-3">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Search..." aria-label="Search..."
                        aria-describedby="basic-addon-search31" />
                </div>

            </div>
        </div>

        <div class="row">
            @foreach ($kamars as $kamar)
                <div class="col-lg-4 col-md-6">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/' . $kamar->image) }}" class="card-img-top" width="50"
                            height="200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $kamar->kamar }}</h5>
                            <p class="card-text">
                                Rp {{ $kamar->harga }}/<span>Malam</span>
                            </p>
                            <div class="mb-3">
                                <a href="/pemesanan/{{ $kamar->id }}" class="btn btn-primary">Pesan</a>
                            </div>
                            <p class="card-text">
                                <small class="text-muted">{{ $kamar->created_at->diffForHumans() }}</small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
