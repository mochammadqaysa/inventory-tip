<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('argon2/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('argon2/assets/img/logo.png')}}">
  <title>
    Login | PT. Tiara Indoprima
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('argon2/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('argon2/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('argon2/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('argon2/assets/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <style>
    @media (min-width: 1400px) {
        .container, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
            max-width: 1920px;
        }
    }

    @media (max-width: 1200px) and (min-width: 992px) {
      .hide-on-md {
        display: none !important;
      }
    }
  </style>
</head>

<body class="">
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row">
            <div class="col-xl-3 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Sign In</h4>
                  <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                  @if(session('error'))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @endif
                  @error('login_failed')
                  <div class="alert alert-danger alert-dismissible fade show text-white" role="alert">
                    {{ $message }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                  @enderror
                  <form role="form" method="POST" action="{{ route('auth.login_process') }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                      <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" aria-label="Email">
                      @if($errors->has('username'))
                        <span class="text-danger text-sm">{{ $errors->first('username') }}</span>
                      @endif
                    </div>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password">
                      @if($errors->has('password'))
                        <span class="text-danger text-sm">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                    {{-- <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div> --}}
                    <div class="text-center">
                      <button type="submit" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Sign in</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-9 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column hide-on-md">
              <div class="position-relative bg-gradient-dark h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden" style="background-image: url('{{asset('argon2/assets/img/heroindex1.jpg')}}'); background-size: cover;">
                {{-- <span class="mask bg-gradient-dark opacity-6"></span> --}}
                <h4 class="mt-5 text-white font-weight-bolder position-relative">PT. Tiara Indoprima</h4>
                <p class="text-white position-relative">PT. Tiara Indoprima is a dynamic private enterprise in the area of co-extruded thermoplastic sheets, films, and laminated decorative surfaces</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('argon2/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('argon2/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('argon2/assets/js/argon-dashboard.min.js?v=2.0.4')}}"></script>
</body>

</html>