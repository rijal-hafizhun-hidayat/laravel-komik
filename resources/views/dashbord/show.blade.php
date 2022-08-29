<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Komik | show</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
  </head>
  <body>
    <div class="container">
        <div class="row mt-5">
            <div class="card p-3">
                <div class="card-body">
                    <form action="{{ route('komik.update', ['id' => $data->id]) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Komik</label>
                            <input type="text" value="{{ $data->nama }}" name="nama" class="form-control @error('nama') is-invalid @enderror">
                            @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror                       
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penulis</label>
                            <input type="text" value="{{ $data->penulis }}" name="penulis" class="form-control @error('penulis') is-invalid @enderror">
                            @error('penulis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror 
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" value="{{ $data->penerbit }}" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
                            @error('penerbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror 
                        </div>
                        <div class="mb-3">
                            <label class="form-label @error('gambar') is-invalid @enderror">File Gambar: </label>
                            <input type="file" name="gambar" id="">
                            @error('gambar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div> 
                            @enderror 
                        </div>                
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
  </body>
</html>
