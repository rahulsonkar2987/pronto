<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="card-text">
                       <p>password update:-</p>
                       <form action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                          <label for="">password</label>
                          <input type="password" class="form-control" name="password" value="{{ old('password') }}"  id="" >
                            <span class="text-danger">@error('password'){{ $message; }} @enderror</span>
                        </div>
                        <div class="form-group">
                            <label for="">password</label>
                            <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}"  id="" >
                            <span class="text-danger">@error('password_confirmation'){{ $message; }} @enderror</span>
                          </div>
                        <input type="submit" class="btn btn-warning" value="Update">
                       </form>
                       <p class="text-danger">{{ session()->get('status') ?? '' }}</p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>