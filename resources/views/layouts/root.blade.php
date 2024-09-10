<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="PT. Tiara Indoprima">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') | PT. Tiara Indoprima</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('argon2/assets/img/logo.png') }}" type="image/png">
  <!-- Fonts -->
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
  <!-- Page plugins -->
  @yield('styles')
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/datatable-extensions/fixedColumns.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendor/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css') }}">
  <!-- Custom css -->
  <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/wizard/bd-wizard.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/wizard/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/apexcharts/apexcharts.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/summernote/summernote-bs4.min.css') }}">
  <!-- Argon CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css?'.date('Ym')) }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/datatables-searchbuilder.min.css') }}" type="text/css">
  <link rel="stylesheet" href="{{ asset('css/datatables-datetime.min.css') }}" type="text/css">
  {{-- Date CSS --}}
  <link href="{{ asset('assets/vendor/flatpickr/flatpickr.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/flatpickr/material_blue.css') }}" rel="stylesheet">
  {{-- Noty --}}
  <link href="{{ asset('assets/vendor/noty/noty.css') }}" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Lexend+Deca&display=swap" rel="stylesheet">
  
  <script>
    var base_url = "{{ url('').'/' }}"
  </script>
</head>

<body>
  <!-- Sidenav -->
  @include('layouts.sidebar')
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    @include('layouts.navbar')
    <!-- Header -->
    <!-- Header -->
    <div class="header bg-diy pb-6">
        <div class="container-fluid">
            <div class="header-body">
            <div class="row align-items-center py-4">
                @yield('breadcrum')
            </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
      @yield('page')
      <!-- Footer -->
      <footer class="footer pt-0">
        <div class="row align-items-center justify-content-lg-between">
          <div class="col-lg-6">
            <div class="copyright text-center  text-lg-left  text-muted">
              Copyright &copy; All rights reserved
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  
  <!-- The Modal -->
  <div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1"  >
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal_title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modal_body"></div>
        <div class="modal-footer" id="modal_footer"></div>
      </div>
    </div>
  </div>
  <!-- Argon Scripts -->
  
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>

  <!-- Optional JS -->
  <script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('js/jszip.js') }}"></script>
  <script src="{{ asset('js/colvis.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatable-extensions/dataTables.fixedColumns.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/select2/dist/js/select2.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-block-ui/jquery-block-ui.js') }}"></script>
  <script src="{{ asset('js/autoNumeric.js') }}"></script>
  <script src="{{ asset('js/numeral.js') }}"></script>
  <script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/flatpickr/flatpickr.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables-buttons-excel-styles/buttons.html5.styles.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables-buttons-excel-styles/buttons.html5.styles.templates.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/datatables-selected-box/dataTables.checkboxes.min.js') }}"></script>

  <!-- Custom js -->
  <script src="{{ asset('js/datatables-language.js') }}"></script>
  <script src="{{ asset('js/datatables-searchbuilder.min.js') }}"></script>
  <script src="{{ asset('js/datatables-datetime.min.js') }}"></script>
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <script src="{{ asset('js/datetime-moment.js') }}"></script>
  <script src="{{ asset('assets/vendor/wizard/jquery.steps.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/wizard/bd-wizard.js') }}"></script>
  <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
  {{-- Noty JS --}}
  <script src="{{ asset('assets/vendor/noty/noty.js') }}" type="text/javascript"></script>
  <!-- Argon JS -->
  <script src="{{ asset('assets/js/argon.js?v=1.1.0') }}"></script>
  <!-- Demo JS - remove this in your project -->
  <script src="{{ asset('assets/js/demo.min.js') }}"></script>
  {{-- Global js --}}
  <script src="{{ asset('js/global.js') }}"></script>
  @yield('scripts')
  <script>
    $('.dt_table thead').addClass('thead-light');
    
    // Disable right-click
    // document.addEventListener('contextmenu', (e) => e.preventDefault());

    // function ctrlShiftKey(e, keyCode) {
    //   return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
    // }

    // document.onkeydown = (e) => {
    //   // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
    //   if (
    //     event.keyCode === 123 ||
    //     ctrlShiftKey(e, 'I') ||
    //     ctrlShiftKey(e, 'J') ||
    //     ctrlShiftKey(e, 'C') ||
    //     (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
    //   )
    //     return false;
    // };
    $('.select2').select2();

    $(() => {
      // Ryuna.getSaldo()
    })

    $('.btn-saldo-refresh').on('click', () => {
      // Ryuna.getSaldo()
    })
  </script>
</body>

</html>
