<style>
    .step-header {
        padding-bottom: 10px;
        margin-bottom: 10px;
    }
    .step-list {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }
    .step-header-number{
        display: -ms-inline-flexbox;
        display: inline-flex;
        -ms-flex-line-pack: center;
        align-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        width: 2em;
        height: 2em;
        padding: 0.5em 0;
        margin: 0.25rem;
        line-height: 1em;
        color: #fff;
        font-weight: 500;
        background-color: #6c757d;
        border-radius: 1em;
    }

    .step-button{
        text-align: center;
        padding: 0px 50px;
    }

    .step-header-number.active{
        color: #fff;
        background-color: #5e72e4;
    }

    .step-header-title{
        text-align: center;
    }

    .flatpickr-wrapper{
        width: 100% !important
    }

    .logo_image_picker{
        border-radius: 0.4rem !important;
        border: 1.5px dotted #dee2e6;
    }

    .image-hover-handler{
        transition: 0.5s;
    }
    .logo_image_picker:hover{
        .wrap_logo_image_picker{
        transform: scale(0.95)
        }

        .image-hover-handler{
        transform: scale(0.95)
        }
    }

    .wrap_logo_image_picker{
        transition: 0.5s;
    }
</style>

<div class="step-box">
    <div class="step-header">
        <div class="step-list">
          <div class="step-button" data-tab="1">
              <div class="step-header-number active">1</div>
              <div class="step-header-title">Data Awal</div>
          </div>
          <div class="step-button" data-tab="2">
              <div class="step-header-number">2</div>
              <div class="step-header-title">Data Item</div>
          </div>
          <div class="step-button" data-tab="3">
              <div class="step-header-number">3</div>
              <div class="step-header-title">Ringkasan</div>
          </div>
        </div>
    </div>
    <div class="step-body" data-tab="1">
      <div class="row">
        <div class="form-group col-md-12">
          <label>Tipe <span class="text-danger">*</span></label><br>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="tipe2" checked name="tipe" class="custom-control-input" value="lokal">
            <label class="custom-control-label" for="tipe2">Lokal</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="tipe1"  name="tipe" class="custom-control-input" value="ekspor">
            <label class="custom-control-label" for="tipe1">Ekspor</label>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label>Customer Penerima <span class="text-danger">*</span></label>
          <select name="customer" class="form-control select2-customer" id="customer">
            <option></option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Nomor Bukti <span class="text-danger">*</span></label>
          <input type="text" name="nomor_bukti" class="form-control" placeholder="Nomor Bukti" style="text-transform:uppercase">
        </div>
        <div class="form-group col-md-6 ">
          <label>Tanggal Bukti <span class="text-danger">*</span></label>
          <div class='date'>
              <input type='text' class="form-control" name="tanggal_bukti" id='tanggal_bukti' style="background-color: white; " placeholder="Pilih Tanggal Bukti" value="" />
          </div>
        </div>
        <div class="form-group col-md-12" id="lokal-ppn">
          <label>PPN</label>
          <div class="input-group">
              <input type="number" name="ppn" class="form-control" placeholder="PPN">
              <div class="input-group-append">
                  <span class="input-group-text">%</span>
              </div>
          </div>
        </div>
        <div class="form-group col-md-6" id="ekspor-nomor-peb">
          <label>Nomor PEB <span class="text-danger">*</span></label>
          <input type="text" name="nomor_peb" class="form-control" placeholder="Nomor PEB" style="text-transform:uppercase">
        </div>
        <div class="form-group col-md-6" id="ekspor-tgl-peb">
          <label>Tanggal PEB <span class="text-danger">*</span></label>
          <div class='date'>
            <input type='text' class="form-control" name="tanggal_peb" id='tanggal_peb' style="background-color: white; " placeholder="Pilih Tanggal PEB" value="" />
          </div>
        </div>
        
      </div>
    </div>
    <div class="step-body" data-tab="2" style="display: none;">
      <div class="col-md-10 mx-auto mb-5">
        <div id="dynamic-form">
          <!-- Original Form -->
          <div class="form-item card shadow">
            <div class="card-header" id="heading1">
              <div class="d-flex align-items-center">
                  <span class="ml-2 mr-3 item-number">Item 1</span>
                  <hr class="flex-grow-1">
                  <a href="#collapse1" class="btn btn-info btn-sm item-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse1">
                    <i class="fas fa-window-minimize"></i>
                  </a>
                  <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-form" style="display: none"><i class="fas fa-trash"></i></a>
              </div>
            </div>
  
            <div id="collapse1" class="collapse show" aria-labelledby="heading1" data-parent="#dynamic-form">
              <div class="card-body">
                <div class="row">
                  
                  <!-- Barang -->
                  <div class="form-group col-md-12">
                    <label>Barang <span class="text-danger">*</span></label>
                    <select name="barang[0]" class="form-control select2-barang">
                      <option></option>
                      @foreach ($barang as $item)
                          <option value="{{$item->uid}}" data-warna="{{$item->warna}}" data-panjang="{{$item->panjang}}" data-lebar="{{$item->lebar}}" data-tebal="{{$item->tebal}}" data-satuan="{{$item->satuan}}">{{$item->nama}} {{$item->warna}} {{$item->panjang}} x {{$item->lebar}} x {{$item->tebal}}</option>
                      @endforeach
                    </select>
                    <small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-12 ">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah">
                          <div class="input-group-append" style="display: none">
                              <span class="input-group-text append-satuan"></span>
                          </div>
                      </div>
                  </div>
                  <!-- Bruto -->
                  <div class="form-group col-md-6 " style="">
                      <label>Bruto <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="bruto[]" class="form-control" step=".001" placeholder="Bruto">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>

                  <!-- (Netto) -->
                  <div class="form-group col-md-6 " style="">
                      <label>Netto <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="netto[]" class="form-control" step=".001" placeholder="Netto">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-12 ekspor-mata-uang">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang" style="text-transform:uppercase">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-12 " style="">
                      <label>Nilai </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text prepend-currency"></span>
                        </div>
                          <input type="number" name="nilai[]" class="form-control" step=".01" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Nilai PPN -->
                  <div class="form-group col-md-6 lokal-nilai-ppn" style="">
                      <label>Nilai PPN </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                          <input type="number" name="nilai_ppn[]" class="form-control" step=".01" placeholder="Nilai PPN" readonly>
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-6 lokal-nilai-total" style="">
                      <label>Nilai Total </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                          <input type="number" name="nilai_total[]" class="form-control" step=".01" placeholder="Nilai Total" readonly>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Button to add new form -->
        <a href="javascript:void(0)" id="add-form" class="btn btn-success mt-3"><i class="fas fa-plus"></i> Tambah Item</a>
      </div>
    </div>
    <div class="step-body" data-tab="3" style="display: none;">
      <div class="col-md-10 mx-auto">
          <table class="table table-borderless align-items-left table-flush table-header col-md-6">
              <tbody>
                  <tr>
                      <td>Nomor Bukti</td>
                      <td>:</td>
                      <th class="nomor-bukti">Nomor Bukti</th>
                  </tr>
                  <tr>
                      <td>Tanggal Bukti</td>
                      <td>:</td>
                      <th class="tanggal-bukti">Tanggal</th>
                  </tr>
                  <tr>
                      <td>Customer</td>
                      <td>:</td>
                      <th class="customer">Customer</th>
                  </tr>
                  <tr>
                      <td>Negara Tujuan</td>
                      <td>:</td>
                      <th class="negara">Negara</th>
                  </tr>
                  <tr>
                      <td>PPN</td>
                      <td>:</td>
                      <th class="ppn">Customer</th>
                  </tr>
                  <tr>
                      <td>Nomor PEB</td>
                      <td>:</td>
                      <th class="nomor-peb">Nomor PEB</th>
                  </tr>
                  <tr>
                      <td>Tanggal PEB</td>
                      <td>:</td>
                      <th class="tanggal-peb">Tanggal PEb</th>
                  </tr>
              </tbody>
          </table>

          <div class="py-2">
            <h5>Informasi Item</h5>
              <table class="table table-responsive display nowrap" style="width:100%" id="table-barangkeluar-ringkasan">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th class="all">Nama Barang</th>
                          <th class="none">Jumlah</th>
                          <th class="none">Bruto</th>
                          <th class="none">Netto</th>
                          <th class="none">Nilai</th>
                          <th class="none">Nilai PPN</th>
                          <th class="none">Nilai Total</th>
                      </tr>
                  </thead>
                  <tbody>
                  </tbody>
              </table>
          </div>
      </div>
      
    </div>
</div>

<script>
  // Collect and display data from Step 1 and Step 2 to Step 3
  function collectAndDisplayData() {
      // Collect data from Step 1
      var customer = $("#customer").select2('data')[0].nama;
      var negara = $("#customer").select2('data')[0].negara;
      var nomor_bukti = $('input[name="nomor_bukti"]').val().toUpperCase();
      var tipe = $('input[name="tipe"]:checked').val();
      var tanggal_bukti = $('input[name="tanggal_bukti"]').val();
      var ppn = $('input[name="ppn"]').val();
      var nomor_peb = $('input[name="nomor_peb"]').val();
      var tanggal_peb = $('input[name="tanggal_peb"]').val();
      
      // Update Step 3 fields
      $('th.customer').html(`${customer} <span class="badge badge-default">${tipe}</span>`);
      $('th.negara').text(negara);
      $('th.nomor-bukti').text(nomor_bukti.toUpperCase());
      $('th.tanggal-bukti').text(tanggal_bukti);
      $('th.ppn').text(ppn + " %");
      $('th.nomor-peb').text(nomor_peb.toUpperCase());
      $('th.tanggal-peb').text(tanggal_peb);

      // Collect and display dynamic data from Step 2 (loop through forms)
      $('#table-barangkeluar-ringkasan tbody').empty(); // Clear table body

      $('#dynamic-form .form-item').each(function(index) {
          var barang = $(this).find(`select[name="barang[${index}]"]`).select2('data')[0].text;
          var jumlah = $(this).find('input[name="jumlah[]"]').val();
          var satuan = $(this).find('.append-satuan').text();
          var bruto = $(this).find('input[name="bruto[]"]').val();
          var netto = $(this).find('input[name="netto[]"]').val();
          var nilai = $(this).find('input[name="nilai[]"]').val();
          var nilai_ppn = $(this).find('input[name="nilai_ppn[]"]').val();
          var nilai_total = $(this).find('input[name="nilai_total[]"]').val();
          let mata_uang = $(this).find('input[name="mata_uang[]"]').val();
          if (tipe == "lokal") {
            mata_uang = "IDR";
          }

          // Append the collected data to the table in Step 3
          $('#table-barangkeluar-ringkasan tbody').append(`
              <tr>
                  <td>${index + 1}</td>
                  <td>${barang}</td>
                  <td>${jumlah} ${satuan}</td>
                  <td>${bruto}</td>
                  <td>${netto}</td>
                  <td>${mata_uang.toUpperCase()}  ${nilai}</td>
                  <td>${mata_uang.toUpperCase()} ${nilai_ppn}</td>
                  <td>${mata_uang.toUpperCase()} ${nilai_total}</td>
              </tr>
          `);
      });

      if (tipe == "lokal") {
        $('th.ppn').parent().show();
        $('th.nomor-peb').parent().hide();
        $('th.tanggal-peb').parent().hide();

        $('#table-barangkeluar-ringkasan th:nth-child(7)').show();
        $('#table-barangkeluar-ringkasan td:nth-child(7)').show();
        $('#table-barangkeluar-ringkasan th:nth-child(8)').show();
        $('#table-barangkeluar-ringkasan td:nth-child(8)').show();
      } else {
        $('th.ppn').parent().hide();
        $('th.nomor-peb').parent().show();
        $('th.tanggal-peb').parent().show();

        $('#table-barangkeluar-ringkasan th:nth-child(7)').hide();
        $('#table-barangkeluar-ringkasan td:nth-child(7)').hide();
        $('#table-barangkeluar-ringkasan th:nth-child(8)').hide();
        $('#table-barangkeluar-ringkasan td:nth-child(8)').hide();
      }
      
  }
  //stepper
  var max_step = 3
  var stepper = new Stepper({
    max_step: max_step
  })

  function nextStep() {
    let curr_position = stepper.position;
    let isValid = false;
    switch(curr_position) {
      case 1:
        isValid = validateStep1();
        if (isValid) {
          $('.btn-prev').show()
        }
        break;
      case 2:
        isValid = validateStep2();
        collectAndDisplayData();
        break;
      case 3:
        isValid = true;
        break;
      default:
        break;
    }

    if (!isValid) {
      return;
    }

    if (curr_position == max_step) {
        save();
      return;
    }

    stepper.next();

    $('.step-button[data-tab="'+stepper.position+'"] > .step-header-number').addClass('active')
    $('.step-body[data-tab="'+curr_position+'"]').hide()
    $('.step-body[data-tab="'+stepper.position+'"]').show()

    if(stepper.position == max_step){
      $('.btn-next').text('Simpan')
    }
  }

  function prevStep() {
    let curr_position = stepper.position
    stepper.prev()
    if(stepper.position < max_step){
      $('.btn-next').text('Lanjut')

      $('#data_pemegang_va').hide()
      // if( (Ryuna.remove_format_rupiah('#mp1 th') >= 100000000 || Ryuna.remove_format_rupiah('#mp2 th') >= 100000000) && $('#disallow_teller').val() == 'false'){
      //   $('#data_pemegang_va').show()
      // }
    }

    if(stepper.position == 1){
      $('.btn-prev').hide()
      // $('.btn-close').show()
    }

    $('.step-button[data-tab="'+curr_position+'"] > .step-header-number').removeClass('active')

    $('.step-body[data-tab="'+curr_position+'"]').hide()
    $('.step-body[data-tab="'+stepper.position+'"]').show()
  }

  function validateStep1() {
    let kosong = ''

    let validateNomorBukti = $('[name="nomor_bukti"]').val()
    if (!validateNomorBukti) {
      kosong += '<li>Kolom Nomor Bukti Wajib Diisi</li>'
    }

    let validateTanggalBukti = $('[name="tanggal_bukti"]').val()
    if (!validateTanggalBukti) {
      kosong += '<li>Kolom Tanggal Bukti Wajib Diisi</li>'
    }

    let validateCustomer = $('[name="customer"]').val()
    if (!validateCustomer) {
      kosong += '<li>Kolom Customer Wajib Diisi</li>'
    }

    var tipe = $('input[name="tipe"]:checked').val();
    if (tipe == "ekspor") {
      let validateNomorPeb = $('[name="nomor_peb"]').val()
      if (!validateNomorPeb) {
        kosong += '<li>Kolom Nomor PEB Wajib Diisi</li>'
      }

      let validateTanggalPeb = $('[name="tanggal_peb"]').val()
      if (!validateTanggalPeb) {
        kosong += '<li>Kolom Tanggal PEB Wajib Diisi</li>'
      }
      
    }


    $('#response_container').empty()
    if(kosong){
      let message = `<div class="alert alert-danger alert-dismissible fade show">
          <ul style="margin: 0; padding: 0">
            Step 1:
            <ul>
                ${kosong}
            </ul>
          </ul>
        </div>`
      $('#response_container').html(message)
      return false;
    }
    return true;
  }

  function validateStep2() {
    let kosong = ''       
    $('#dynamic-form .form-item').each(function (index) {
      let barangValue = $(this).find('.form-group select[name="barang['+index+']"]').val()
      if (!barangValue) {  // If the field is empty
        kosong += `<li>Kolom Barang pada data ke - ${index + 1} wajib diisi</li>`;
      } else {
        let stok = $(this).find('.form-group #stok-bahan').attr("data-stok");
        if (parseFloat(stok) < 1) {
          kosong += `<li>Stok Barang pada data ke - ${index + 1} belum tersedia</li>`;
        }
      }
    });

    $('[name="jumlah[]"]').each(function(index) {
      let jumlahValue = $(this).val(); // Get the value of the current field
      
      if (!jumlahValue) {  // If the field is empty
        kosong += `<li>Kolom Jumlah pada data ke - ${index + 1} wajib diisi</li>`;
      } else {
        var maximum = $(this).attr('max')
        if (parseFloat(jumlahValue) > parseFloat(maximum)) {
          // $(this).addClass('is-invalid'); 
          kosong += `<li>Kolom Jumlah pada data ke - ${index + 1} maksimal diisi ${maximum}</li>`;
        }
      }
    });

    $('[name="bruto[]"]').each(function(index) {
      if ($(this).is(":visible")) {
        let jumlahKgValue = $(this).val(); // Get the value of the current field
        
        if (!jumlahKgValue) {  // If the field is empty
          kosong += `<li>Kolom Bruto pada data ke - ${index + 1} wajib diisi</li>`;
        }
      }
    });

    $('[name="netto[]"]').each(function(index) {
      if ($(this).is(":visible")) {
        let jumlahKgValue = $(this).val(); // Get the value of the current field
        
        if (!jumlahKgValue) {  // If the field is empty
          kosong += `<li>Kolom Netto pada data ke - ${index + 1} wajib diisi</li>`;
        }
      }
    });

    $('#response_container').empty()
    if(kosong){
      let message = `<div class="alert alert-danger alert-dismissible fade show">
          <ul style="margin: 0; padding: 0">
            Step 2
            <ul>
              ${kosong}
            </ul>
          </ul>
        </div>`
      $('#response_container').html(message)
      return false;
    }
    return true;
  }

  
  $(() => {
    $('#tanggal_bukti').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    $('#tanggal_peb').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })

    let _urls = {
      customer: `{{ route('select2.customer') }}`,
    }
    var _limit = 10
    function formatResult(res) {
      if (res.loading) {
        return res.text;
      }
      var $container = $(
          "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar'><img src='"+ base_url+'img/default-avatar.png'+"'/></div>" +
            "<div class='select2-result-repository__meta'>" +
              "<div class='select2-result-repository__title'></div>" +
              "<div class='select2-result-repository__description'></div>" +
            "</div>" +
          "</div>"
        );

        $container.find(".select2-result-repository__title").text(res.nama || '-');
        $container.find(".select2-result-repository__description").text(res.negara || '-');

        return $container
    }

    function formatSelection(res) {
      return res.nama || res.text;
    }
    function loadCustomers(tipe) {
        $('#customer').select2({
        ajax: {
          url: _urls.customer,
          dataType: 'json',
          delay: 250,
          data: function (params) {
            // console.log('req', params)
            return {
              term: params.term,
              page: params.page || 0,
              limit: _limit,
              tipe: tipe // pass the selected 'tipe' value
            };
          },
          processResults: function (data, params) {
            // console.log('res', data)
            params.page = params.page || 0;
            let check = params.page+1;
            return {
              results: data.items,
              pagination: {
                more: (data.total - (check * _limit)) > 0
              }
            };
          },
          cache: true
        },
        placeholder: 'Choose One',
        // minimumInputLength: 1,
        templateResult: formatResult,
        templateSelection: formatSelection
      });
    }
    $('input[name="tipe"]').on('change', function() {
        var selectedTipe = $(this).val();
        console.log(selectedTipe);
        $('#customer').val(null).trigger('change'); 
        loadCustomers(selectedTipe); 
        if (selectedTipe == "lokal") {
          $("#lokal-ppn").show()
          $("#ekspor-nomor-peb").hide()
          $("#ekspor-tgl-peb").hide()
          // step 2
          $('.ekspor-mata-uang').hide()
          $('.lokal-nilai-ppn').show()
          $('.lokal-nilai-total').show()
          $('.prepend-currency').text("IDR")
        } else {
          $("#lokal-ppn").hide()
          $("#ekspor-nomor-peb").show()
          $("#ekspor-tgl-peb").show()
          // step 2
          $('.ekspor-mata-uang').show()
          $('.lokal-nilai-ppn').hide()
          $('.lokal-nilai-total').hide()
          $('.prepend-currency').text("")
        }
    });

    var initialTipe = $('input[name="tipe"]:checked').val();
    if (initialTipe) {
        loadCustomers(initialTipe);
        // $('#supplier').removeAttr("disabled");
        if (initialTipe == "lokal") {
          $("#lokal-ppn").show()
          $("#ekspor-nomor-peb").hide()
          $("#ekspor-tgl-peb").hide()
          // step 2
          $('.ekspor-mata-uang').hide()
          $('.lokal-nilai-ppn').show()
          $('.lokal-nilai-total').show()
          $('.prepend-currency').text("IDR")
        } else {
          $("#lokal-ppn").hide()
          $("#ekspor-nomor-peb").show()
          $("#ekspor-tgl-peb").show()
          // step 2
          $('.ekspor-mata-uang').show()
          $('.lokal-nilai-ppn').hide()
          $('.lokal-nilai-total').hide
          $('.prepend-currency').text("")
        }
    }

    $(document).on('blur', 'input[name="ppn"]', function () {
      var ppn = $(this).val();
      if (ppn > 100) {
        $(this).val(100)
      } else if (ppn < 0) {
        $(this).val(0)
      }
    });

    function parseFixed(form, zero) {
      var kursValue = form.val(); // Get the input value
      var kursFloat = parseFloat(kursValue); // Convert to float
      if (isNaN(kursFloat)) {
        $(this).val(''); // Optionally clear the input if it's not a valid number
      } else {
        form.val(kursFloat.toFixed(zero) || ''); // Use an empty string if it's NaN
      }
    }
    

    // step 2

    var formCount = 1; // Counter for form numbering

    function formatResultBarang(res) {
      if (!res.id) {
        return res.text;
      }
      var $container = $(
          "<div class='select2-result-repository clearfix'>" +
            "<div class='select2-result-repository__avatar'><img src='"+ base_url+'img/default-barang.png'+"'/></div>" +
            "<div class='select2-result-repository__meta'>" +
              "<div class='select2-result-repository__title'></div>" +
              "<div class='select2-result-repository__description'></div>" +
            "</div>" +
          "</div>"
        );

        var warna = $(res.element).data('warna');
        var panjang = $(res.element).data('panjang');
        var lebar = $(res.element).data('lebar');
        var tebal = $(res.element).data('tebal');
        var satuan = $(res.element).data('satuan');
        $container.find(".select2-result-repository__title").text(res.text || '-');
        $container.find(".select2-result-repository__description").html(warna ? `Warna : ${warna} <br> Dimensi : ${panjang} x ${lebar} x ${tebal} <br> Satuan : ${satuan}` : '-');

        return $container
    }

    function formatSelectionBarang(res) {
      return res.text;
    }

    let initializeSelect2 =  function() {
      $('.select2-barang').select2({
          placeholder: "Pilih Barang", // Optional placeholder
          allowClear: true, // Allows the user to clear the selection
          templateResult: formatResultBarang,  // Custom result format
          templateSelection: formatSelectionBarang // Custom selected item format
      });

      $(".select2-barang").change(function() {
          var barang = $(this).val(); // Get the selected value
          if (barang) {
              $.ajax({
                  url: `{{route('barang.info')}}`,  // Replace with your controller URL
                  method: 'POST',
                  data: {
                      'barang': barang // Send selected bahan ID to the server
                  },
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(res) {
                      // Handle success response from the server
                      if (res.status) {

                        $(this).closest('.form-item').find('.input-group-append .append-satuan').parent().show();
                        $(this).closest('.form-item').find('.input-group-append .append-satuan').text(res.data.satuan);
                        $(this).closest('.form-item').find('.form-group #stok-bahan').text("Stok : "+res.data.stok+" "+res.data.satuan);
                        $(this).closest('.form-item').find('.form-group #stok-bahan').slideDown();
                        $(this).closest('.form-item').find('.form-group #stok-bahan').attr("data-stok",res.data.stok);
                        $(this).closest('.form-item').find('input[name="jumlah[]"]').attr("max", res.data.stok);
                        
                      }
                      
                      // Example: Update some input with the value returned from the server
                      // Assuming 'response' contains the value you need
                      // You might need to target the specific cloned form
                      // $(this) here refers to the current select element that triggered the change
                      // $(this).closest('.form-item').find('input[name="some_input_field"]').val(response.someValue);
                      
                      // Example of updating some part of the form with the selected value
                  }.bind(this), // Ensure the correct 'this' context
                  error: function(xhr, status, error) {
                      // Handle any errors
                      console.error('AJAX error:', error);
                  }
              });
          } else {
            $(this).closest('.form-item').find('.input-group-append .append-satuan').parent().hide();
          }
      });

      $('.select2-gudang').select2({
          placeholder: "Select an option", // Optional placeholder
          allowClear: true // Allows the user to clear the selection
      });
    }

    $(document).on('input', 'input[name="mata_uang[]"]', function() {
        var currentForm = $(this).closest('.form-item'); // Get the closest form item
        var mataUangValue = $(this).val(); // Get the current input value

        // Find the corresponding input-group-prepend in the same form and update its text
        currentForm.find('.input-group-prepend .prepend-currency').text(mataUangValue.toUpperCase());
    });

    $(document).on('blur', 'input[name="bruto[]"]', function () {
        parseFixed($(this),3);
    });
    $(document).on('blur', 'input[name="netto[]"]', function () {
        parseFixed($(this),3);
    });
    $(document).on('blur', 'input[name="nilai[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="nilai_ppn[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="nilai_total[]"]', function () {
        parseFixed($(this),2);
    });

    function calculateTotal(form) {
        // Get values from the current form
        var ppn = parseFloat($('input[name="ppn"]').val()) || 0;
        var nilai = parseFloat(form.find('input[name="nilai[]"]').val()) || 0;
        var nilai_ppn = parseFloat(form.find('input[name="nilai_ppn[]"]').val()) || 0;

        // Calculate the total value
        var nilaiPPN = (nilai * ppn) / 100;
        var nilaiTotal = nilaiPPN + nilai;

        // Set the result to the nilai_total input
        form.find('input[name="nilai_ppn[]"]').val(nilaiPPN.toFixed(2));  // Format to 2 decimal places
        form.find('input[name="nilai_total[]"]').val(nilaiTotal.toFixed(2));  // Format to 2 decimal places
    }

     // Event listener for changes in nilai, kurs, asuransi, and ongkos
    $(document).on('input', 'input[name="nilai[]"]', function() {
        var currentForm = $(this).closest('.form-item');  // Get the current form
        calculateTotal(currentForm);  // Calculate the total for the current form
    });
    


    // Function to update the form numbers and accordion ids
    function updateFormNumbers() {
        $('#dynamic-form .form-item').each(function (index) {
            var formIndex = index + 1;

            // Update the Item number in the accordion header
            $(this).find('.item-number').text('Item ' + formIndex);

            // Update the accordion collapse IDs
            var headerId = 'heading' + formIndex;
            var collapseId = 'collapse' + formIndex;

            $(this).find('.card-header').attr('id', headerId);
            $(this).find('.collapse').attr({
                id: collapseId,
                'aria-labelledby': headerId,
            });
            $(this).find('.item-collapse').attr('href', '#' + collapseId);

            // Hide the delete button for the first form
            if (index === 0) {
                $(this).find('.remove-form').hide();
            } else {
                $(this).find('.remove-form').show();
            }
        });
    }


    // Add new form dynamically
    $('#add-form').click(function () {
      formCount++;
      let newForm = ``;


      newForm = `
      <div class="form-item card shadow">
          <div class="card-header" id="heading${formCount}">
            <div class="d-flex align-items-center">
                <span class="ml-2 mr-3 item-number">Item ${formCount}</span>
                <hr class="flex-grow-1">
                <a href="#collapse${formCount}" class="btn btn-info btn-sm item-collapse" data-toggle="collapse" aria-expanded="true" aria-controls="collapse${formCount}">
                  <i class="fas fa-window-minimize"></i>
                </a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm remove-form"><i class="fas fa-trash"></i></a>
            </div>
          </div>

          <div id="collapse${formCount}" class="collapse show" aria-labelledby="heading${formCount}" data-parent="#dynamic-form">
            <div class="card-body">
              <div class="row">       
                  <!-- Barang -->
                  <div class="form-group col-md-12">
                    <label>Barang <span class="text-danger">*</span></label>
                    <select name="barang[${formCount-1}]" class="form-control select2-barang">
                      <option></option>
                      @foreach ($barang as $item)
                          <option value="{{$item->uid}}" data-warna="{{$item->warna}}" data-panjang="{{$item->panjang}}" data-lebar="{{$item->lebar}}" data-tebal="{{$item->tebal}}" data-satuan="{{$item->satuan}}">{{$item->nama}} {{$item->warna}} {{$item->panjang}} x {{$item->lebar}} x {{$item->tebal}}</option>
                      @endforeach
                    </select>
                    <small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-12 ">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah">
                          <div class="input-group-append" style="display: none">
                              <span class="input-group-text append-satuan"></span>
                          </div>
                      </div>
                  </div>
                  <!-- Bruto -->
                  <div class="form-group col-md-6 " style="">
                      <label>Bruto <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="bruto[]" class="form-control" step=".001" placeholder="Bruto">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>

                  <!-- (Netto) -->
                  <div class="form-group col-md-6 " style="">
                      <label>Netto <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="netto[]" class="form-control" step=".001" placeholder="Netto">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-12 ekspor-mata-uang">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang" style="text-transform:uppercase">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-12 " style="">
                      <label>Nilai </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text prepend-currency"></span>
                        </div>
                          <input type="number" name="nilai[]" class="form-control" step=".01" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Nilai PPN -->
                  <div class="form-group col-md-6 lokal-nilai-ppn" style="">
                      <label>Nilai PPN </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                          <input type="number" name="nilai_ppn[]" class="form-control" step=".01" placeholder="Nilai PPN" readonly>
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-6 lokal-nilai-total" style="">
                      <label>Nilai Total </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">IDR</span>
                        </div>
                          <input type="number" name="nilai_total[]" class="form-control" step=".01" placeholder="Nilai Total" readonly>
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>`;

      var tipe = $('input[name="tipe"]:checked').val();
      var htmlObject = $(newForm)
      if (tipe == "ekspor") {
        htmlObject.find('.lokal-nilai-ppn').hide()
        htmlObject.find('.lokal-nilai-total').hide()
        htmlObject.find('.ekspor-mata-uang').show()
        htmlObject.find('.prepend-currency').text("")
      } else {
        htmlObject.find('.lokal-nilai-ppn').show()
        htmlObject.find('.lokal-nilai-total').show()
        htmlObject.find('.ekspor-mata-uang').hide()
        htmlObject.find('.prepend-currency').text("IDR")
      }

      // Append the new form to the dynamic form container
      $('#dynamic-form').append(htmlObject);


        initializeSelect2();
        updateFormNumbers(); // Update numbers and accordion IDs
    });

    // Remove a form when the delete button is clicked
    $(document).on('click', '.remove-form', function () {
        $(this).closest('.form-item').remove(); // Remove the form
        updateFormNumbers(); // Update numbers and accordion IDs
    });

    // Initialize
    updateFormNumbers();
    initializeSelect2();


    // step 3
    
  })
    
  


</script>