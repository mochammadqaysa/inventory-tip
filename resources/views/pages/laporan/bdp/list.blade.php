@extends('layouts.root')

@section('title', 'Laporan Pemakaian Barang Dalam Proses')

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Laporan</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><object type="image/svg+xml" data="{{asset('assets/img/brand/file-bahan.svg')}}" class="custom-icon custom-icon-small custom-icon-white"></object></a></li>
      <li class="breadcrumb-item active" aria-current="page">Pemakaian Barang Dalam Proses</li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      <div class="card-body">
        <form action="{{ route('result-report.bdp') }}" method="GET" id="myForm">
          <div class="row align-items-center" id="form-list">
            <div class="form-group col-md-12">
              <label>Periode <span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="text" class="form-control" name="periode" id="periode" style="background-color: white;" placeholder="Pilih Periode" aria-describedby="validationPeriod" />
                <div class="input-group-append">
                  <span class="input-group-text">
                    <i class="fas fa-calendar"></i>
                  </span>
                </div>
                <div id="validationPeriod" class="invalid-feedback">
                  Mohon isi periode terlebih dahulu
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group col-md-12">
              <button class="btn btn-block bg-diy text-white">Submit <i class="fas fa-paper-plane"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>

  function validateForm() {
    let ids = [];
    const periode = $('[name="periode"]').val();

    // Clear previous validation states
    $('[name="periode"]').removeClass('is-invalid');

    // Validate 'periode' field
    if (!periode) {
      ids.push('periode');
      $('#periode').addClass('is-invalid');
    }

    if (ids.length > 0) {
      return false; // Validation failed, stop submission
    }
    return true; // Validation passed, allow submission
  }

  // Bind the validate function to the form's submit event
  $(document).ready(function() {
    $('#myForm').on('submit', function(event) {
      if (!validateForm()) {
        event.preventDefault(); // Prevent form submission if validation fails
      }
    });
  });



  $(document).ready(() => {

    // Tipe Change Event
    $('input[name="tipe"]').on('change', function() {
      const selectedTipe = $(this).val();
      if (selectedTipe === 'impor') {
        $('#impor-fasilitas').slideDown();
      } else {
        $('#impor-fasilitas').slideUp();
      }
    });

    // Flatpickr Initialization
    $("#periode").flatpickr({
      mode: "range",
      dateFormat: "Y-m-d",
      onChange: (selectedDates, dateStr, instance) => {
        instance.element.value = dateStr.replace(" to ", " - ");
      }
    });

    // Select2 Initialization
    $('.select2-bahan').select2({
      placeholder: "Semua Bahan",
      allowClear: true,
      templateResult: formatResult,
      templateSelection: formatSelection
    });

    // Helper functions for Select2
    function formatResult(res) {
      if (!res.id) return res.text;
      const $container = $(
        `<div class='select2-result-repository clearfix'>
          <div class='select2-result-repository__avatar'><img src='${base_url}img/default-bahan.png'/></div>
          <div class='select2-result-repository__meta'>
            <div class='select2-result-repository__title'></div>
            <div class='select2-result-repository__description'></div>
          </div>
        </div>`
      );
      $container.find(".select2-result-repository__title").text(res.text || '-');
      return $container;
    }

    function formatSelection(res) {
      return res.text;
    }
  });
</script>
@endsection
