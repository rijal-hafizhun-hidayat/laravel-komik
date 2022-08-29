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
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ route('akun.create') }}" class="btn btn-primary">Tambah</a>
            <a href="{{ route('user.logout') }}" class="btn btn-danger mr-auto">Log Out</a>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ( $data as $row => $value )
                    <tr>
                        <th scope="row">{{ $data->firstItem() + $row }}</th>
                        <td>{{ $value->username }}</td>
                        @if ($value->is_admin === 1)
                            <td>Admin</td>
                        @else
                            <td>Pengunjung</td>
                        @endif
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <a href="{{ route('akun.destroy', ['id' => $value->id]) }}" class="btn btn-danger">Hapus</a>
                                <a href="{{ route('akun.show', ['id' => $value->id]) }}" class="btn btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
              </table>
              {{ $data->links() }}
        </div>
    </div>
    <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>