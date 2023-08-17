@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-center  align-items-center">
                  <h5 class="mb-0 fw-bold fs-1">Tambah Data Kamar</h5>
                </div>
                <div class="card-body">
                  <form action="{{ route('kamars.store') }}" method="Post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="image">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" onchange="previewImage()" value ="{{ old('image') }}" required autofocus />
                      </div>
                    <div class="mb-3">
                      <label class="form-label" for="kamar">Jenis Kamar</label>
                      <input type="text" class="form-control @error('kamar') is-invalid @enderror" id="kamar" name="kamar" value ="{{ old('kamar') }}" required autofocus  />
                      @error('kamar')
                      <div class="invalid-feedback">
                       {{ $message }}
                     </div>
                     @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="harga">Harga</label>
                        <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value ="{{ old('harga') }}" required autofocus  />
                        @error('harga')
                        <div class="invalid-feedback">
                         {{ $message }}
                       </div>
                       @enderror
                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>
<script>
    
    function previewImage(){
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
    
        imgPreview.style.display = 'block';
    
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
    
        oFReader.onload = function(oFREvent){
          imgPreview.src = oFREvent.target.result;
        }
      }
</script>
@endsection