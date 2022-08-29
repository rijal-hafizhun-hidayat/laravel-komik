<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <title>Akun | Komik</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('akun.update', ['id' => $data->id]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" value="{{ $data->name }}" name="name" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror     
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" value="{{ $data->username }}" name="username" class="form-control @error('username') is-invalid @enderror">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div> 
                            @enderror    
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" name="passwordOld" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="passwordNew" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Role: </label>
                            <select class="form-select @error('is_admin') is-invalid @enderror" name="is_admin" aria-label="Default select example">
                                <option @if ($data->is_admin === 1) selected @endif value="1">Admin</option>
                                <option @if ($data->is_admin === 0) selected @endif value="0">pengunjung</option>
                            </select>
                            @error('role')
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
    @if ( session()->get('toast'))
        <script>
            alert({!! json_encode(session()->get('toast')) !!});
        </script>
    @endif
</body>
</html>