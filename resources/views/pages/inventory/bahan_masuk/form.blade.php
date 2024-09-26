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
          <div class="input-group">
              <div class="input-group-prepend">
                  <span class="input-group-text prepend-currency">IDR</span>
              </div>
              <input type="number" name="kurs" step=".01" class="form-control" placeholder="Kurs">
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
                  <div class="form-group col-md-12">
                    <label>Bahan <span class="text-danger">*</span></label>
                    <select name="bahan[0]" class="form-control select2-bahan">
                      <option></option>
                      @foreach ($bahan as $item)
                          <option value="{{$item->uid}}">{{$item->nama}}</option>
                      @endforeach
                    </select>
                    <small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-6 ">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" step=".001" name="jumlah[]" class="form-control" placeholder="Jumlah">
                          <div class="input-group-append" style="display: none">
                              <span class="input-group-text append-satuan"></span>
                          </div>
                      </div>
                  </div>
                  <!-- Jumlah KG (Netto) -->
                  <div class="form-group col-md-12 jumlah-kg" style="display: none;">
                      <label>Jumlah KG (Netto) <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="jumlah_kg[]" class="form-control" step=".001" placeholder="Jumlah">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-6 impor-mata-uang">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang" style="text-transform:uppercase">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-4 impor-nilai">
                      <label>Nilai</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="nilai[]" class="form-control" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Asuransi -->
                  <div class="form-group col-md-4 impor-asuransi">
                      <label>Asuransi </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="asuransi[]" class="form-control" placeholder="Asuransi">
                      </div>
                  </div>
                  <!-- Ongkos -->
                  <div class="form-group col-md-4 impor-ongkos">
                      <label>Ongkos</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="ongkos[]" class="form-control" placeholder="Ongkos">
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-12">
                      <label>Nilai Total </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" step=".01" name="nilai_total[]" class="form-control" placeholder="Nilai Total" readonly>
                      </div>
                  </div>
                  <!-- Gudang Penyimpanan -->
                  <div class="form-group col-md-12">
                      <label>Gudang Penyimpanan </label>
                      <select class="form-control select2-gudang" name="gudang_penyimpanan[0]">
                          <option value="" disabled selected>Choose One</option>
                          @foreach ($gudang as $item)
                              <option value="{{$item->uid}}" {{ $item->uid == "7cd8e26c-b8e0-428e-8433-0adc98239cf5" ? "selected" : "" }}>{{$item->nama}}</option>
                          @endforeach
                      </select>
                  </div>
                  <div class="form-group col-md-12 impor-fasilitas">
                    <label>Fasilitas</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[0]" id="fasilitas1" value="ya">
                      <label class="form-check-label" for="fasilitas1">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[0]" id="fasilitas2" value="tidak">
                      <label class="form-check-label" for="fasilitas2">Tidak</label>
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
              <table class="table table-responsive display nowrap" style="width:100%" id="table-bahanmasuk-ringkasan">
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
          var bahan = $(this).find(`select[name="bahan[${index}]"]`).select2('data')[0].text;
          var jumlah = $(this).find('input[name="jumlah[]"]').val();
          var satuan = $(this).find('.append-satuan').text();
          var nilai_total = $(this).find('input[name="nilai_total[]"]').val();
          var fasilitasName = `fasilitas[${index}]`  // Dynamic name attribute
          var fasilitas = $(this).find('input[name="' + fasilitasName + '"]:checked').val();
          var penyimpanan = $(this).find(`select[name="gudang_penyimpanan[${index}]"]`).select2('data')[0].text;

          // Append the collected data to the table in Step 3
          $('#table-bahanmasuk-ringkasan tbody').append(`
              <tr>
                  <td>${index + 1}</td>
                  <td>${kode_hs}</td>
                  <td>${nomor_seri}</td>
                  <td>${nomor_lot}</td>
                  <td>${bahan}</td>
                  <td>${jumlah} ${satuan}</td>
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
      kosong += '<li>Kolom Supplier Wajib Diisi</li>'
    }

    let validateNomorBukti = $('[name="nomor_bukti"]').val()
    if (!validateNomorBukti) {
      kosong += '<li>Kolom Nomor Bukti Wajib Diisi</li>'
    }

    let validateTanggalBukti = $('[name="tanggal_bukti"]').val()
    if (!validateTanggalBukti) {
      kosong += '<li>Kolom Tanggal Bukti Wajib Diisi</li>'
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

    $('[name="jumlah_kg[]"]').each(function(index) {
      if ($(this).is(":visible")) {
        let jumlahKgValue = $(this).val(); // Get the value of the current field
        
        if (!jumlahKgValue) {  // If the field is empty
          kosong += `<li>Kolom Jumlah KG (Netto) pada data ke - ${index + 1} wajib diisi</li>`;
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
          $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
          $('input[name="nilai_total[]"]').prop('readonly', false)
          $('#dynamic-form .form-item').each(function (index) {
            let satuan = $(this).find('.input-group .append-satuan').text()
            if (satuan == "kg") {
              $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-12").addClass("col-md-6")
              $('input[name="mata_uang[]"]').parent().removeClass("col-md-12").addClass("col-md-6")
            } else {
              $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
              $('input[name="mata_uang[]"]').parent().removeClass("col-md-6").addClass("col-md-12")

            }
          });
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
          $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-12").addClass("col-md-6")
          $('input[name="nilai_total[]"]').prop('readonly', true)
          $('input[name="nilai_total[]"]').val('')
          $('#dynamic-form .form-item').each(function (index) {
            let satuan = $(this).find('.input-group .append-satuan').text()
            if (satuan == "kg") {
              $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-12").addClass("col-md-6")
              $('input[name="mata_uang[]"]').parent().removeClass("col-md-12").addClass("col-md-6")
            } else {
              $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
              $('input[name="mata_uang[]"]').parent().removeClass("col-md-6").addClass("col-md-12")
            }
          });
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
          $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
          $('input[name="nilai_total[]"]').prop('readonly', false)
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
          $('input[name="jumlah[]"]').parent().parent().removeClass("col-md-12").addClass("col-md-6")
          $('input[name="nilai_total[]"]').prop('readonly', true)
          $('input[name="nilai_total[]"]').val('')
        }
    }

    function parseFixed(form, zero) {
      var kursValue = form.val(); // Get the input value
      var kursFloat = parseFloat(kursValue); // Convert to float
      if (isNaN(kursFloat)) {
        $(this).val(''); // Optionally clear the input if it's not a valid number
      } else {
        form.val(kursFloat.toFixed(zero) || ''); // Use an empty string if it's NaN
      }
    }
    $(document).on('blur', 'input[name="kurs"]', function () {
        parseFixed($(this),2);
    });
    

    // step 2

    var formCount = 1; // Counter for form numbering

    let initializeSelect2 =  function() {
      $('.select2-bahan').select2({
          placeholder: "Pilih Bahan", // Optional placeholder
          allowClear: true // Allows the user to clear the selection
      });

      $(".select2-bahan").change(function() {
          var bahan = $(this).val(); // Get the selected value
          if (bahan) {
              $.ajax({
                  url: `{{route('bahan.info')}}`,  // Replace with your controller URL
                  method: 'POST',
                  data: {
                      'bahan': bahan // Send selected bahan ID to the server
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
                        if (res.data.satuan.toLowerCase() === "kg") {
                          $(this).closest('.form-item').find('input[name="jumlah_kg[]"]').parent().parent().slideUp();
                          if (tipe == "impor") {
                            $(this).closest('.form-item').find('input[name="jumlah[]"]').parent().parent().removeClass("col-md-12").addClass("col-md-6")
                          } else {
                            $(this).closest('.form-item').find('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
                          }
                          $(this).closest('.form-item').find('input[name="mata_uang[]"]').parent().removeClass("col-md-12").addClass("col-md-6")
                        } else {
                          $(this).closest('.form-item').find('input[name="jumlah_kg[]"]').parent().parent().slideDown();
                          $(this).closest('.form-item').find('input[name="jumlah[]"]').parent().parent().removeClass("col-md-6").addClass("col-md-12")
                          $(this).closest('.form-item').find('input[name="mata_uang[]"]').parent().removeClass("col-md-6").addClass("col-md-12")
                        }
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

    $(document).on('blur', 'input[name="jumlah[]"]', function () {
        parseFixed($(this),3);
    });
    $(document).on('blur', 'input[name="nilai[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="asuransi[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="ongkos[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="nilai_total[]"]', function () {
        parseFixed($(this),2);
    });
    $(document).on('blur', 'input[name="jumlah_kg[]"]', function () {
        parseFixed($(this),2);
    });
    

    $(document).on('input', 'input[name="mata_uang[]"]', function() {
        var currentForm = $(this).closest('.form-item'); // Get the closest form item
        var mataUangValue = $(this).val(); // Get the current input value

        // Find the corresponding input-group-prepend in the same form and update its text
        currentForm.find('.input-group-prepend .prepend-currency').text(mataUangValue.toUpperCase());
    });

    function calculateTotal(form) {
        // Get values from the current form
        var nilai = parseFloat(form.find('input[name="nilai[]"]').val()) || 0;
        var kurs = parseFloat($('input[name="kurs"]').val()) || 0;  // Default kurs to 1 if empty
        var asuransi = parseFloat(form.find('input[name="asuransi[]"]').val()) || 0;
        var ongkos = parseFloat(form.find('input[name="ongkos[]"]').val()) || 0;

        // Calculate the total value
        var nilaiTotal = (nilai * kurs) + (asuransi * kurs) + (ongkos * kurs);

        // Set the result to the nilai_total input
        form.find('input[name="nilai_total[]"]').val(nilaiTotal.toFixed(2));  // Format to 2 decimal places
    }

     // Event listener for changes in nilai, kurs, asuransi, and ongkos
     $(document).on('input', 'input[name="nilai[]"], input[name="kurs[]"], input[name="asuransi[]"], input[name="ongkos[]"]', function() {
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



      var tipe = $('input[name="tipe"]:checked').val();
      if (tipe == "impor") {
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
                  <div class="form-group col-md-12">
                      <label>Bahan <span class="text-danger">*</span></label>
                      <select name="bahan[${formCount-1}]" class="form-control select2-bahan">
                          <option></option>
                          @foreach ($bahan as $item)
                              <option value="{{$item->uid}}">{{$item->nama}}</option>
                          @endforeach
                      </select>
                      <small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-6 ">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" step=".001" name="jumlah[]" class="form-control" placeholder="Jumlah">
                          <div class="input-group-append" style="display: none">
                              <span class="input-group-text append-satuan"></span>
                          </div>
                      </div>
                  </div>
                  <!-- Jumlah KG (Netto) -->
                  <div class="form-group col-md-12 jumlah-kg" style="display: none;">
                      <label>Jumlah KG (Netto) <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="jumlah_kg[]" class="form-control" step=".001" placeholder="Jumlah">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-6 impor-mata-uang">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang" style="text-transform:uppercase">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-4 impor-nilai">
                      <label>Nilai</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="nilai[]" class="form-control" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Asuransi -->
                  <div class="form-group col-md-4 impor-asuransi">
                      <label>Asuransi </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="asuransi[]" class="form-control" placeholder="Asuransi">
                      </div>
                  </div>
                  <!-- Ongkos -->
                  <div class="form-group col-md-4 impor-ongkos">
                      <label>Ongkos</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text prepend-currency"></span>
                          </div>
                          <input type="number" step=".01" name="ongkos[]" class="form-control" placeholder="Ongkos">
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-12">
                      <label>Nilai Total </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" step=".01" name="nilai_total[]" class="form-control" placeholder="Nilai Total" readonly>
                      </div>
                  </div>
                  <!-- Gudang Penyimpanan -->
                  <div class="form-group col-md-12">
                      <label>Gudang Penyimpanan </label>
                      <select class="form-control select2-gudang" name="gudang_penyimpanan[${formCount-1}]">
                          <option value="" disabled selected>Choose One</option>
                          @foreach ($gudang as $item)
                              <option value="{{$item->uid}}" {{ $item->uid == "7cd8e26c-b8e0-428e-8433-0adc98239cf5" ? "selected" : "" }}>{{$item->nama}}</option>
                          @endforeach
                      </select>
                  </div>
                  <!-- Fasilitas -->
                  <div class="form-group col-md-12 impor-fasilitas">
                    <label>Fasilitas</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[${formCount-1}]" id="fasilitas${formCount+1}" value="ya">
                      <label class="form-check-label" for="fasilitas${formCount+1}">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[${formCount-1}]" id="fasilitas${formCount+2}" value="tidak">
                      <label class="form-check-label" for="fasilitas${formCount+2}">Tidak</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>`;
      } else {
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
                  <!-- Kode HS -->
                  <div class="form-group col-md-4 impor-kode-hs" style="display: none;">
                      <label>Kode HS</label>
                      <input type="text" name="kode_hs[]" class="form-control" placeholder="Kode HS">
                  </div>
                  <!-- Nomor Seri -->
                  <div class="form-group col-md-4 impor-nomor-seri" style="display: none;">
                      <label>Nomor Seri</label>
                      <input type="text" name="nomor_seri[]" class="form-control" placeholder="Nomor Seri">
                  </div>
                  <!-- Nomor Lot -->
                  <div class="form-group col-md-12">
                      <label>Nomor Lot </label>
                      <input type="text" name="nomor_lot[]" class="form-control" placeholder="Nomor Lot">
                  </div>
                  <!-- Bahan -->
                  <div class="form-group col-md-12">
                      <label>Bahan <span class="text-danger">*</span></label>
                      <select name="bahan[${formCount-1}]" class="form-control select2-bahan">
                          <option></option>
                          @foreach ($bahan as $item)
                              <option value="{{$item->uid}}">{{$item->nama}}</option>
                          @endforeach
                      </select>
                      <small id="stok-bahan" style="display: none" class="form-text text-muted"></small>
                  </div>
                  <!-- Jumlah -->
                  <div class="form-group col-md-12 ">
                      <label>Jumlah <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" step=".001" name="jumlah[]" class="form-control" placeholder="Jumlah">
                          <div class="input-group-append" style="display: none">
                              <span class="input-group-text append-satuan"></span>
                          </div>
                      </div>
                  </div>
                  <!-- Jumlah KG (Netto) -->
                  <div class="form-group col-md-12 jumlah-kg" style="display: none;">
                      <label>Jumlah KG (Netto) <span class="text-danger">*</span></label>
                      <div class="input-group">
                          <input type="number" name="jumlah_kg[]" class="form-control" step=".001" placeholder="Jumlah">
                          <div class="input-group-append">
                              <span class="input-group-text">KG</span>
                          </div>
                      </div>
                  </div>
                  <!-- Mata Uang -->
                  <div class="form-group col-md-6 impor-mata-uang" style="display: none;">
                      <label>Mata Uang </label>
                      <input type="text" name="mata_uang[]" class="form-control" placeholder="Mata Uang">
                  </div>
                  <!-- Nilai -->
                  <div class="form-group col-md-4 impor-nilai" style="display: none;">
                      <label>Nilai</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="number" step=".01" name="nilai[]" class="form-control" placeholder="Nilai">
                      </div>
                  </div>
                  <!-- Asuransi -->
                  <div class="form-group col-md-4 impor-asuransi" style="display: none;">
                      <label>Asuransi </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="number" step=".01" name="asuransi[]" class="form-control" placeholder="Asuransi">
                      </div>
                  </div>
                  <!-- Ongkos -->
                  <div class="form-group col-md-4 impor-ongkos" style="display: none;">
                      <label>Ongkos</label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">RP</span>
                          </div>
                          <input type="number" step=".01" name="ongkos[]" class="form-control" placeholder="Ongkos">
                      </div>
                  </div>
                  <!-- Nilai Total -->
                  <div class="form-group col-md-12">
                      <label>Nilai Total </label>
                      <div class="input-group">
                          <div class="input-group-prepend">
                              <span class="input-group-text">IDR</span>
                          </div>
                          <input type="number" step=".01" name="nilai_total[]" class="form-control" placeholder="Nilai Total">
                      </div>
                  </div>
                  <!-- Gudang Penyimpanan -->
                  <div class="form-group col-md-12">
                      <label>Gudang Penyimpanan </label>
                      <select class="form-control select2-gudang" name="gudang_penyimpanan[${formCount-1}]">
                          <option value="" disabled selected>Choose One</option>
                          @foreach ($gudang as $item)
                              <option value="{{$item->uid}}" {{ $item->uid == "7cd8e26c-b8e0-428e-8433-0adc98239cf5" ? "selected" : "" }}>{{$item->nama}}</option>
                          @endforeach
                      </select>
                  </div>
                  <!-- Fasilitas -->
                  <div class="form-group col-md-12 impor-fasilitas" style="display:none;">
                    <label>Fasilitas</label><br>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[${formCount-1}]" id="fasilitas${formCount+1}" value="ya">
                      <label class="form-check-label" for="fasilitas${formCount+1}">Ya</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="fasilitas[${formCount-1}]" id="fasilitas${formCount+2}" value="tidak">
                      <label class="form-check-label" for="fasilitas${formCount+2}">Tidak</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>`;
      }
      // Append the new form to the dynamic form container
      $('#dynamic-form').append(newForm);


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