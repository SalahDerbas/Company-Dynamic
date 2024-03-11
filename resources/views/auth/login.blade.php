<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ A_LOGIN }}</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('backEnd/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('backEnd/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('backEnd/css/custom.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary stisla-login-page">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">{{ A_ADMIN_PANEL }}</h1>
                  </div>
                  <form method="POST" action="{{ route('login') }}" class="user">
                    @csrf

                    <div class="form-group">
                      <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror fz_15" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ A_EMAIL_ADDRESS }}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror fz_15" name="password" required autocomplete="current-password" placeholder="{{ A_PASSWORD }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block fz_15">{{ A_LOGIN }}</button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="fz_15" href="{{ route('password.request') }}">{{ A_FORGET_PASSWORD_QUESTION }}</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('backEnd/js/jquery-3.6.0.min') }}"></script>
  <script src="{{ asset('backEnd/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('backEnd/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('backEnd/js/sb-admin-2.min.js') }}"></script>

</body>
</html>
