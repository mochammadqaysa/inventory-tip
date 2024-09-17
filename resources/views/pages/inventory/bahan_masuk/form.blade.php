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
            <input type="radio" id="tipe1"  name="tipe" class="custom-control-input" value="impor">
            <label class="custom-control-label" for="tipe1">Impor</label>
          </div>
          
        </div>
        <div class="form-group col-md-12">
          <label>Supplier <span class="text-danger">*</span></label>
          <select name="supplier" class="form-control select2" disabled id="supplier">
            <option value="" disabled>Choose One</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label>Nomor Bukti <span class="text-danger">*</span></label>
          <input type="text" name="nomor_bukti" class="form-control" placeholder="Nomor Bukti">
        </div>
        <div class="form-group col-md-6 ">
          <label>Tanggal Bukti <span class="text-danger">*</span></label>
          <div class='date'>
            <input type='text' class="form-control" name="tanggal_bukti" id='tanggal_bukti' style="background-color: white; " placeholder="Pilih Tanggal Bukti" value="" />
          </div>
        </div>
        <div class="form-group col-md-6" id="impor-nomor-pib">
          <label>Nomor PIB</label>
          <input type="text" name="nomor_pib" class="form-control" placeholder="Nomor PIB" >
        </div>
        <div class="form-group col-md-6" id="impor-tgl-pib">
          <label>Tanggal PIB</label>
          <div class='date'>
            <input type='text' class="form-control" name="tanggal_pib" id='tanggal_pib' style="background-color: white; " placeholder="Pilih Tanggal PIB" value="" />
          </div>
        </div>
        <div class="form-group col-md-12">
          <label>Nomor PO</label>
          <input type="text" name="nomor_po" class="form-control" placeholder="Nomor PO" >
        </div>
        <div class="form-group col-md-12" id="impor-kurs">
          <label>Kurs</label>
          <input type="text" name="kurs" class="form-control" placeholder="Kurs">
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
                  <span class="ml-2 mr-3 item-number">Data 1</span>
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
                  <!-- Kode HS -->
                  <div class="form-group col-md-4 impor-kode-hs">
                      <label>Kode HS</label>
                      <input type="text" name="kode_hs[]" class="form-control" placeholder="Kode HS">
                  </div>
                  <!-- Nomor Seri -->
                  <div class="form-group col-md-4 impor-nomor-seri">
                      <label>Nomor Seri</label>
                      <input type="text" name="nomor_seri[]" class="form-control" placeholder="Nomor Seri">
                  </div>
                  <!-- Nomor Lot -->
                  <div class="form-group col-md-4">
                      <label>Nomor Lot </label>
                      <input type="text" name="nomor_lot[]" class="form-control" placeholder="Nomor Lot">
                  </div>
                  <!-- Bahan -->
                  <div class="form-group col-md-6">
                      <label>Bahan <span class="text-danger">*</span></label>
                      <input type="text" name="bahan[]" class="form-control" placeholder="Bahan">
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-6">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <input type="text" name="jumlah[]" class="form-control" placeholder="Jumlah">
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-6 impor-mata-uang">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-6 impor-nilai">
                      <label>Nilai</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="text" name="nilai[]" class="form-control" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Asuransi -->
                  <div class="form-group col-md-6 impor-asuransi">
                      <label>Asuransi </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="text" name="asuransi[]" class="form-control" placeholder="Asuransi">
                      </div>
                  </div>
                  <!-- Ongkos -->
                  <div class="form-group col-md-6 impor-ongkos">
                      <label>Ongkos</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="text" name="ongkos[]" class="form-control" placeholder="Ongkos">
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-12">
                      <label>Nilai Total </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">IDR</span>
                          </div>
                          <input type="text" name="nilai_total[]" class="form-control" placeholder="Nilai" disabled>
                      </div>
                  </div>
                  <!-- Gudang Penyimpanan -->
                  <div class="form-group col-md-12">
                      <label>Gudang Penyimpanan </label>
                      <select class="form-control select2" name="gudang_penyimpanan[]">
                          <option value="" disabled selected>[ Choose One ]</option>
                          <option value="gudang_a">Gudang A</option>
                          <option value="gudang_b">Gudang B</option>
                      </select>
                  </div>
                  <div class="form-group col-md-12 impor-fasilitas">
                    <label>Fasilitas</label><br>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="fasilitas1" checked name="fasilitas" class="custom-control-input" value="ya">
                      <label class="custom-control-label" for="fasilitas1">Ya</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" id="fasilitas2"  name="fasilitas" class="custom-control-input" value="tidak">
                      <label class="custom-control-label" for="fasilitas2">Tidak</label>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Button to add new form -->
        <a href="javascript:void(0)" id="add-form" class="btn btn-success mt-3">Add More Data</a>
      </div>
    </div>
    <div class="step-body" data-tab="3" style="display: none;">
      <div class="col-md-10 mx-auto">
          <table class="table table-borderless align-items-left table-flush table-header col-md-6">
              <tbody>
                  <tr>
                      <td>Supplier</td>
                      <td>:</td>
                      <th class="supplier"> <span class="badge badge-default ml-2 supplier-type">tipe supplier</span></th>
                  </tr>
                  <tr>
                      <td>Negara Asal</td>
                      <td>:</td>
                      <th class="negara-asal"></th>
                  </tr>
                  <tr>
                      <td>Nomor Bukti</td>
                      <td>:</td>
                      <th class="nomor-bukti">Nomor Bukti</th>
                  </tr>
                  <tr>
                      <td>Nomor PO</td>
                      <td>:</td>
                      <th class="nomor-po">Nomor PO</th>
                  </tr>
                  <tr>
                      <td>Nomor PIB</td>
                      <td>:</td>
                      <th class="nomor-pib">Nomor PIB</th>
                  </tr>
                  <tr>
                      <td>Tanggal PIB</td>
                      <td>:</td>
                      <th class="tanggal-pib">Tanggal</th>
                  </tr>
              </tbody>
          </table>

          <div class="py-2">
            <h5>Informasi Item</h5>
              <table class="table display nowrap" style="width:100%" id="table-bahanmasuk-ringkasan">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th class="all">Kode HS</th>
                          <th class="all">Nomor Seri</th>
                          <th class="all">Nomor Lot</th>
                          <th class="all">Nama Bahan</th>
                          <th class="none">Jumlah</th>
                          <th class="none">Nilai Total</th>
                          <th class="none">Fasilitas</th>
                          <th class="none">Penyimpanan</th>
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
      var tipe = $('input[name="tipe"]:checked').val();
      var supplier = $("#supplier").select2('data')[0].nama;
      var negara = $("#supplier").select2('data')[0].negara;
      var nomor_bukti = $('input[name="nomor_bukti"]').val();
      var nomor_po = $('input[name="nomor_po"]').val();
      var nomor_pib = $('input[name="nomor_pib"]').val();
      var tanggal_pib = $('input[name="tanggal_pib"]').val();
      
      // Update Step 3 fields
      $('th.supplier').html(supplier + ` <span class="badge badge-default ml-2 supplier-type">${tipe}</span>`);
      $('th.negara-asal').text(negara);
      $('th.nomor-bukti').text(nomor_bukti);
      $('th.nomor-po').text(nomor_po);

      // Collect and display dynamic data from Step 2 (loop through forms)
      $('#table-bahanmasuk-ringkasan tbody').empty(); // Clear table body

      $('#dynamic-form .form-item').each(function(index) {
          var kode_hs = $(this).find('input[name="kode_hs[]"]').val();
          var nomor_seri = $(this).find('input[name="nomor_seri[]"]').val();
          var nomor_lot = $(this).find('input[name="nomor_lot[]"]').val();
          var bahan = $(this).find('input[name="bahan[]"]').val();
          var jumlah = $(this).find('input[name="jumlah[]"]').val();
          var nilai_total = $(this).find('input[name="nilai_total[]"]').val();
          var fasilitas = $(this).find('input[name="fasilitas"]:checked').val();
          var penyimpanan = $(this).find('select[name="gudang_penyimpanan[]"] option:selected').text();

          // Append the collected data to the table in Step 3
          $('#table-bahanmasuk-ringkasan tbody').append(`
              <tr>
                  <td>${index + 1}</td>
                  <td>${kode_hs}</td>
                  <td>${nomor_seri}</td>
                  <td>${nomor_lot}</td>
                  <td>${bahan}</td>
                  <td>${jumlah}</td>
                  <td>${nilai_total}</td>
                  <td>${fasilitas}</td>
                  <td>${penyimpanan}</td>
              </tr>
          `);
      });
      
      if (tipe == 'lokal') {
        $('th.nomor-pib').parent().hide();
        $('th.tanggal-pib').parent().hide();
        $('#table-bahanmasuk-ringkasan th:nth-child(2)').hide();
        $('#table-bahanmasuk-ringkasan td:nth-child(2)').hide();
        $('#table-bahanmasuk-ringkasan th:nth-child(3)').hide();
        $('#table-bahanmasuk-ringkasan td:nth-child(3)').hide();
        $('#table-bahanmasuk-ringkasan th:nth-child(8)').hide();
        $('#table-bahanmasuk-ringkasan td:nth-child(8)').hide();
      } else {
        $('th.nomor-pib').parent().show();
        $('th.tanggal-pib').parent().show();
        $('th.nomor-pib').text(nomor_pib);
        $('th.tanggal-pib').text(tanggal_pib);

        
        $('#table-bahanmasuk-ringkasan th:nth-child(2)').show();
        $('#table-bahanmasuk-ringkasan td:nth-child(2)').show();
        $('#table-bahanmasuk-ringkasan th:nth-child(3)').show();
        $('#table-bahanmasuk-ringkasan td:nth-child(3)').show();
        $('#table-bahanmasuk-ringkasan th:nth-child(8)').show();
        $('#table-bahanmasuk-ringkasan td:nth-child(8)').show();
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
    let validateTipe = $('[name="tipe"]').val()
    if (!validateTipe) {
      kosong += '<li>Kolom Tipe Wajib Diisi</li>'
    }
    
    let validateSupplier = $('[name="supplier"]').val()
    if (!validateSupplier) {
      kosong += '<li>Kolom Supplier Diisi</li>'
    }

    let validateNomorBukti = $('[name="nomor_bukti"]').val()
    if (!validateNomorBukti) {
      kosong += '<li>Kolom Nomor Bukti Diisi</li>'
    }

    let validateTanggalBukti = $('[name="tanggal_bukti"]').val()
    if (!validateTanggalBukti) {
      kosong += '<li>Kolom Tanggal Bukti Diisi</li>'
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
    $('[name="bahan[]"]').each(function(index) {
      let bahanValue = $(this).val(); // Get the value of the current field
      
      if (!bahanValue) {  // If the field is empty
        kosong += `<li>Kolom Bahan pada data ke - ${index + 1} wajib diisi</li>`;
      }
    });

    $('[name="jumlah[]"]').each(function(index) {
      let jumlahValue = $(this).val(); // Get the value of the current field
      
      if (!jumlahValue) {  // If the field is empty
        kosong += `<li>Kolom Jumlah pada data ke - ${index + 1} wajib diisi</li>`;
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
    $('#tanggal_pib').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
    })
    let _urls = {
      supplier: `{{ route('select2.supplier') }}`,
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
    function loadSuppliers(tipe) {
        $('#supplier').select2({
        ajax: {
          url: _urls.supplier,
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
        $('#supplier').val(null).trigger('change'); 
        loadSuppliers(selectedTipe); 
        if (selectedTipe == "lokal") {
          $("#impor-nomor-pib").hide()
          $("#impor-tgl-pib").hide()
          $("#impor-kurs").hide()
          // step 2
          $(".impor-kode-hs").hide()
          $(".impor-nomor-seri").hide()
          $(".impor-mata-uang").hide()
          $(".impor-nilai").hide()
          $(".impor-asuransi").hide()
          $(".impor-ongkos").hide()
          $(".impor-fasilitas").hide()
          $('input[name="nomor_lot[]"]').parent().removeClass("col-md-4").addClass("col-md-12")
          $('input[name="nilai_total[]"]').prop('disabled', false)
        } else {
          $("#impor-nomor-pib").show()
          $("#impor-tgl-pib").show()
          $("#impor-kurs").show()
          // step 2
          $(".impor-kode-hs").show()
          $(".impor-nomor-seri").show()
          $(".impor-mata-uang").show()
          $(".impor-nilai").show()
          $(".impor-asuransi").show()
          $(".impor-ongkos").show()
          $(".impor-fasilitas").show()
          $('input[name="nomor_lot[]"]').parent().removeClass("col-md-12").addClass("col-md-4")
          $('input[name="nilai_total[]"]').prop('disabled', true)
        }
    });

    var initialTipe = $('input[name="tipe"]:checked').val();
    if (initialTipe) {
        loadSuppliers(initialTipe);
        $('#supplier').removeAttr("disabled");
        if (initialTipe == "lokal") {
          $("#impor-nomor-pib").hide()
          $("#impor-tgl-pib").hide()
          $("#impor-kurs").hide()
          // step 2
          $(".impor-kode-hs").hide()
          $(".impor-nomor-seri").hide()
          $(".impor-mata-uang").hide()
          $(".impor-nilai").hide()
          $(".impor-asuransi").hide()
          $(".impor-ongkos").hide()
          $(".impor-fasilitas").hide()
          $('input[name="nomor_lot[]"]').parent().removeClass("col-md-4").addClass("col-md-12")
          $('input[name="nilai_total[]"]').prop('disabled', false)
        } else {
          $("#impor-nomor-pib").show()
          $("#impor-tgl-pib").show()
          $("#impor-kurs").show()
          // step 2
          $(".impor-kode-hs").show()
          $(".impor-nomor-seri").show()
          $(".impor-mata-uang").show()
          $(".impor-nilai").show()
          $(".impor-asuransi").show()
          $(".impor-ongkos").show()
          $(".impor-fasilitas").show()
          $('input[name="nomor_lot[]"]').parent().removeClass("col-md-12").addClass("col-md-4")
          $('input[name="nilai_total[]"]').prop('disabled', true)
        }
    }

    // step 2

    var formCount = 1; // Counter for form numbering

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
        var originalForm = $('#dynamic-form .form-item').first().clone(); // Clone the first form
        originalForm.find('input').val(''); // Clear input values
        originalForm.find('select').val('').trigger('change'); // Reset select2 dropdown
        originalForm.appendTo('#dynamic-form'); // Append the form

        updateFormNumbers(); // Update numbers and accordion IDs
    });

    // Remove a form when the delete button is clicked
    $(document).on('click', '.remove-form', function () {
        $(this).closest('.form-item').remove(); // Remove the form
        updateFormNumbers(); // Update numbers and accordion IDs
    });

    // Initialize
    updateFormNumbers();


    // step 3
    
  })
    
  


</script>