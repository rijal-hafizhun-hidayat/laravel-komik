<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login | komik</title>
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.sync') }}" method="POST">
                      @csrf
                        <div class="mb-3">
                          <label class="form-label">Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror">
                          @error('username')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div> 
                          @enderror   
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                          @error('password')
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
    <script src="js/bootstrap/bootstrap.min.js"></script>
    @if ( session()->get('toast'))
      <script>
        alert({!! json_encode(session()->get('toast')) !!});
      </script>
    @endif
</body>
</html>