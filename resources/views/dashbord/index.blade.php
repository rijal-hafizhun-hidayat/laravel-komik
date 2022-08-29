<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <title>Komik | dashbord</title>
</head>
<body>
    <div class="container mt-5">
      <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        @if (session()->get('isAdmin') === 1)
          <a href="{{ route('komik.create') }}" class="btn btn-success">Tambah</a>
          <a href="{{ route('komik.printKomik') }}" class="btn btn-primary">Print</a>
          <a href="{{ route('akun.index') }}" class="btn bg-info">Akun</a>
        @endif
          <a href="{{ route('user.logout') }}" class="btn btn-danger mr-auto">Log Out</a>
      </div>
      
      <div class="row">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Komik</th>
              <th scope="col">Penulis</th>
              <th scope="col">Penerbit</th>
              <th scope="col">Gambar</th>
              @if (session()->get('isAdmin') === 1)
                <th scope="col">Action</th>
              @endif
              
            </tr>
          </thead>
          <tbody>
            @foreach ( $data as $row => $value )
            <tr>
              <td>{{ $data->firstItem() + $row }}</td>
              <td>{{ $value->nama }}</td>
              <td>{{ $value->penulis }}</td>
              <td>{{ $value->penerbit }}</td>
              <td><img class="img-fluid" width="100px" height="100px" src="{{ asset('storage/'.$value->gambar) }}" alt=""></td>
              <td>
                @if (session()->get('isAdmin') === 1)
                <div class="btn-group">
                  <a href="destroy/{{ $value->id }}" class="btn btn-danger">Hapus</a>
                  <a href="show/{{ $value->id }}" class="btn btn-warning">Edit</a>
                </div>
                @endif
              </td>
            </tr>
            @endforeach
        </table>
        {{ $data->links() }}
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