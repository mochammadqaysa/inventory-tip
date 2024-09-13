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
              <div class="step-header-title">Dokumentasi</div>
          </div>
          <div class="step-button" data-tab="2">
              <div class="step-header-number">2</div>
              <div class="step-header-title">Item</div>
          </div>
          <div class="step-button" data-tab="3">
              <div class="step-header-number">3</div>
              <div class="step-header-title">Ringkasan</div>
          </div>
        </div>
    </div>
    <div class="step-body" data-tab="1">
      <div class="form-group col-md-12">
        <label>Tipe <span class="text-danger">*</span></label><br>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="tipe1" {{ @$data->tipe == 'impor' ? 'checked' : '' }} name="tipe" class="custom-control-input" value="impor">
          <label class="custom-control-label" for="tipe1">Impor</label>
        </div>
        <div class="custom-control custom-radio custom-control-inline">
          <input type="radio" id="tipe2" {{ @$data->tipe == 'lokal' ? 'checked' : '' }} name="tipe" class="custom-control-input" value="lokal">
          <label class="custom-control-label" for="tipe2">Lokal</label>
        </div>
      </div>
      <div class="form-group col-md-12">
        <label>Supplier</label>
        <select name="supplier" class="form-control select2" id="supplier">
          <option value="" disabled>Choose One</option>
          @foreach($supplier as $item)
          <option value="{{ $item->uid }}" data-tipe="{{ $item->tipe }}">{{$item->nama}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-12">
        <label>Nomor Bukti <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" placeholder="Nama Customer" value="{{ @$data->nama }}">
      </div>
      <div class="form-group col-md-12 ">
        <label>Tanggal Bukti</label>
        <div class='date'>
          <input type='text' class="form-control" name="execution_date" id='promise_pay' style="background-color: white; " placeholder="Choose Date" value="" />
        </div>
      </div>
      <div class="form-group col-md-12">
        <label>Nomor PO <span class="text-danger">*</span></label>
        <input type="text" name="nama" class="form-control" placeholder="Nama Customer" value="{{ @$data->nama }}">
      </div>

    </div>
    <div class="step-body" data-tab="2" style="display: none;">
      <div class="form-group col-md-12">
        <label>Jenis Identitas</label>
        <select class="form-control select2" name="va[identity_type]" id="select2-identity_type">
          <option value="" disabled selected>[ Choose One ]</option>
          <option value="ktp">KTP</option>
          <option value="passport">Passport</option>
          <option value="kitas_kitap">KITAS/KITAP</option>
        </select>
      </div>
    </div>
    <div class="step-body" data-tab="3" style="display: none;">
      <div class="form-group col-md-6">
        <label>Username</label>
        <input type="text" name="userMaker[username]" data-role="maker" class="form-control" placeholder="Username">
      </div>
    </div>
</div>

<script>
// $('#supplier').val('');
    $(() => {
      $('#supplier').val('');
      $('#supplier').select2({
        placeholder: 'Select an option'
      });
    })
    $('input[name="tipe"]').change(function() {
        // Get the selected radio button value (impor or lokal)
        var selectedTipe = $(this).val();
        
        // Loop through the supplier dropdown options
        $('#supplier option').each(function() {
            // Check the 'data-tipe' attribute of each option
            var optionTipe = $(this).data('tipe');
            
            // Show the option if it matches the selected tipe or if it's the default 'Choose One'
            if (optionTipe === selectedTipe || !optionTipe) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

        // Reset the Select2 dropdown after filtering
        $('#supplier').val(null).trigger('change');
    });
    let date = $('.promise_pay').val();
    $('#promise_pay').flatpickr({
      static: true,
      dateFormat: "Y-m-d",
      // timeFormat: "H:i",
      // enableSeconds: true,
      // time_24hr: true,
      // onChange: function(selectedDates, dateStr, instance){
      //   if(dateStr) instance.close();
      // }
      // onChange: function(selectedDates, dateStr, instance) {
      //     instance.element.value = dateStr.replace('to', '-');
      //     date = selectedDates;
      // }
    })
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
        break;
      case 3:
        isValid = validateStep3();
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
    let jenis_bank = $('[name="mitra[jenis_bank]"]').val()
    // if (!jenis_bank) {
    //   kosong += '<li>Kolom Jenis bank wajib diisi</li>'
    // }


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

  // function validateStep2() {
  //   let kosong = ''
  //   let identity_type = $('[name="va[identity_type]"]').val()
  //   if(!identity_type){
  //     kosong += '<li>Kolom Jenis identitas virtual account wajib diisi</li>'
  //   }

  //   let identity_number = $('[name="va[identity_number]"]').val()
  //   if(identity_type == 'ktp'){
  //     if(identity_number?.length != 16){
  //       kosong += 'Kolom Nomor Identitas virtual account wajib 16 digits'
  //     }
  //   } else {
  //     if(!identity_number){
  //       kosong += '<li>Kolom Nomor Identitas virtual account wajib diisi</li>'
  //     }
  //   }

  //   let email = $('[name="va[email]"]').val()
  //   if(!email){
  //     kosong += '<li>Kolom Email virtual account wajib diisi</li>'
  //   }

  //   let transaksi_va = $('[name="va[transaksi_va]"]').val()
  //   if(!transaksi_va){
  //     kosong += '<li>Kolom Transaksi virtual account wajib diisi</li>'
  //   }

  //   let mode = $('[name="va[mode]"]').val()
  //   if(!mode){
  //     kosong += '<li>Kolom Mode transaksi virtual account wajib Diisi</li>'
  //   }

  //   let jenis_va = $('[name="va[jenis_va]"]').val()
  //   if(!jenis_va){
  //     kosong += '<li>Kolom Jenis virtual account wajib diisi</li>'
  //   }

  //   let auto_reset = $('[name="deposit_auto_reset"]').val()
  //   if(auto_reset == 'false'){
  //     var name_0 = $('[name="billDetails[0][billName]"]').val();
  //     var descriptionId_0 = $('[name="billDetails[0][billDescription][indonesia]"]').val();

  //     if(!name_0){
  //       kosong += `<li>Kolom Nama pada tagihan 1 wajib diisi.</li>`;
  //       $('#billName_1_res').html(`Kolom Nama pada tagihan 1 wajib diisi.`)
  //       $('[name="billDetails[0][billName]"]').removeClass('is-valid').addClass('is-invalid')
  //     } else {
  //       $('#billName_1_res').html('')
  //       $('[name="billDetails[0][billName]"]').removeClass('is-invalid').addClass('is-valid')
  //     }

  //     if(!descriptionId_0){
  //       kosong += `<li>Kolom  Deskripsi (Indonesia) pada tagihan 1 wajib diisi.</li>`;
  //       $('#billDescription_id_1_res').html(`Kolom  Deskripsi (Indonesia) pada tagihan 1 wajib diisi`)
  //       $('[name="billDetails[0][billDescription][indonesia]"]').removeClass('is-valid').addClass('is-invalid')
  //     } else {
  //       $('[name="billDetails[0][billDescription][indonesia]"]').removeClass('is-invalid').addClass('is-valid')
  //       $('#billDescription_id_1_res').html('')
  //     }


  //     for(i = 1; i <= 5; i++){
  //       var bilInfo = $(`[name="billDetails[0][additionalInfo][billInfo${i}]"]`).val();
  //       var bilValue = $(`[name="billDetails[0][additionalInfo][billValue${i}]"]`).val();

  //       if(bilInfo){
  //         $(`#billInfo${i}_1_res`).html('')
  //         $(`[name="billDetails[0][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //       }

  //       if(bilValue){
  //         $(`#billValue${i}_1_res`).html('')
  //         $(`[name="billDetails[0][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //       }

  //       if((!bilInfo || !bilValue) && (bilInfo || bilValue)){
  //         if(!bilInfo){
  //           kosong += `<li>Kolom Bill Info ${i} pada tagihan 1 wajib diisi.</li>`
  //           $(`[name="billDetails[0][additionalInfo][billInfo${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //           $(`#billInfo${i}_1_res`).html(`Kolom Bill Info ${i} pada tagihan 1 wajib diisi.`)
  //         }
  //         if(!bilValue){
  //           kosong += `<li>Kolom Bill Value ${i} pada tagihan 1 wajib diisi.</li>`
  //           $(`#billValue${i}_1_res`).html(`Kolom Bill Value ${i} pada tagihan 1 wajib diisi.`)
  //           $(`[name="billDetails[0][additionalInfo][billValue${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //         }
  //       }

  //       if(!bilInfo && !bilValue){
  //         $(`#billInfo${i}_1_res`).html('')
  //         $(`[name="billDetails[0][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //         $(`#billValue${i}_1_res`).html('')
  //         $(`[name="billDetails[0][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //       }

  //     }

  //     var name_1 = $('[name="billDetails[1][billName]"]').val();
  //     var descriptionId_1 = $('[name="billDetails[1][billDescription][indonesia]"]').val();

  //     if(name_1){
  //       $('#billName_2_res').html('')
  //       $('[name="billDetails[1][billName]"]').removeClass('is-invalid').addClass('is-valid')
  //     }

  //     if(descriptionId_1){
  //       $('[name="billDetails[1][billDescription][indonesia]"]').removeClass('is-invalid').addClass('is-valid')
  //       $('#billDescription_id_2_res').html('')
  //     }

  //     if ((!name_1 || !descriptionId_1) && (name_1 || descriptionId_1)) {
  //       if(!name_1){
  //         kosong += `<li>Kolom Nama pada tagihan 2 wajib diisi.</li>`;
  //         $('#billName_2_res').html(`Kolom Nama pada tagihan 2 wajib diisi.`)
  //         $('[name="billDetails[1][billName]"]').removeClass('is-valid').addClass('is-invalid')
  //       } else {
  //         $('#billName_2_res').html('')
  //         $('[name="billDetails[1][billName]"]').removeClass('is-invalid').addClass('is-valid')
  //       }

  //       if(!descriptionId_1){
  //         kosong += `<li>Kolom  Deskripsi (Indonesia) pada tagihan 2 wajib diisi.</li>`;
  //         $('#billDescription_id_2_res').html(`Kolom  Deskripsi (Indonesia) pada tagihan 2 wajib diisi`)
  //         $('[name="billDetails[1][billDescription][indonesia]"]').removeClass('is-valid').addClass('is-invalid')
  //       } else {
  //         $('[name="billDetails[1][billDescription][indonesia]"]').removeClass('is-invalid').addClass('is-valid')
  //         $('#billDescription_id_2_res').html('')
  //       }
  //     }

  //     if(!name_1  && !descriptionId_1){
  //       $('#billName_2_res').html('')
  //       $('[name="billDetails[1][billName]"]').removeClass('is-invalid').removeClass('is-valid')
  //       $('[name="billDetails[1][billDescription][indonesia]"]').removeClass('is-invalid').removeClass('is-valid')
  //       $('#billDescription_id_2_res').html('')
  //     }

  //     for(i = 1; i <= 5; i++){
  //       var bilInfo = $(`[name="billDetails[1][additionalInfo][billInfo${i}]"]`).val();
  //       var bilValue = $(`[name="billDetails[1][additionalInfo][billValue${i}]"]`).val();

  //       if(bilInfo){
  //         $(`[name="billDetails[1][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //         $(`#billInfo${i}_2_res`).html(``)
  //       }

  //       if(bilValue){
  //         $(`[name="billDetails[1][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //         $(`#billValue${i}_2_res`).html(``)
  //       }

  //       if((!bilInfo || !bilValue) && (bilInfo || bilValue)){
  //         if(!bilInfo){
  //           kosong += `<li>Kolom Bill Info ${i} pada tagihan 2 wajib diisi.</li>`
  //           $(`[name="billDetails[1][additionalInfo][billInfo${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //           $(`#billInfo${i}_2_res`).html(`Kolom Bill Info ${i} pada tagihan 2 wajib diisi`)
  //         }

  //         if(!bilValue){
  //           kosong += `<li>Kolom Bill Value ${i} pada tagihan 2 wajib diisi.</li>`
  //           $(`[name="billDetails[1][additionalInfo][billValue${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //           $(`#billValue${i}_2_res`).html(`Kolom Bill Info ${i} pada tagihan 2 wajib diisi.`)
  //         }
  //       }

  //       if(!bilInfo && !bilValue){
  //         $(`[name="billDetails[1][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //         $(`#billInfo${i}_2_res`).html(``)
  //         $(`[name="billDetails[1][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //         $(`#billValue${i}_2_res`).html(``)
  //       }
  //     }

  //     var name_2 = $('[name="billDetails[2][billName]"]').val();
  //     var descriptionId_2 = $('[name="billDetails[2][billDescription][indonesia]"]').val();

  //     if(name_2){
  //       $('#billName_3_res').html('')
  //       $('[name="billDetails[2][billName]"]').removeClass('is-invalid').addClass('is-valid')
  //     }

  //     if(descriptionId_2){
  //       $('[name="billDetails[2][billDescription][indonesia]"]').removeClass('is-invalid').addClass('is-valid')
  //       $('#billDescription_id_3_res').html('')
  //     }

  //     if ((!name_2 || !descriptionId_2) && (name_2 || descriptionId_2)) {
  //       if(!name_2){
  //         kosong += `<li>Kolom Nama pada tagihan 3 wajib diisi.</li>`;
  //         $('#billName_3_res').html(`Kolom Nama pada tagihan 3 wajib diisi.`)
  //         $('[name="billDetails[2][billName]"]').removeClass('is-valid').addClass('is-invalid')
  //       } else {
  //         $('#billName_3_res').html('')
  //         $('[name="billDetails[2][billName]"]').removeClass('is-invalid').addClass('is-valid')
  //       }

  //       if(!descriptionId_2){
  //         kosong += `<li>Kolom  Deskripsi (Indonesia) pada tagihan 3 wajib diisi.</li>`;
  //         $('#billDescription_id_3_res').html(`Kolom  Deskripsi (Indonesia) pada tagihan 3 wajib diisi`)
  //         $('[name="billDetails[2][billDescription][indonesia]"]').removeClass('is-valid').addClass('is-invalid')
  //       } else {
  //         $('[name="billDetails[2][billDescription][indonesia]"]').removeClass('is-invalid').addClass('is-valid')
  //         $('#billDescription_id_3_res').html('')
  //       }
  //     }

  //     if(!name_2  && !descriptionId_2){
  //       $('#billName_3_res').html('')
  //       $('[name="billDetails[2][billName]"]').removeClass('is-invalid').removeClass('is-valid')
  //       $('[name="billDetails[2][billDescription][indonesia]"]').removeClass('is-invalid').removeClass('is-valid')
  //       $('#billDescription_id_3_res').html('')
  //     }

  //     for(i = 1; i <= 5; i++){
  //       var bilInfo = $(`[name="billDetails[2][additionalInfo][billInfo${i}]"]`).val();
  //       var bilValue = $(`[name="billDetails[2][additionalInfo][billValue${i}]"]`).val();

  //       if(bilInfo){
  //         $(`[name="billDetails[2][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //         $(`#billInfo${i}_3_res`).html(``)
  //       }

  //       if(bilValue){
  //         $(`[name="billDetails[2][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').addClass('is-valid')
  //         $(`#billValue${i}_3_res`).html(``)
  //       }

  //       if((!bilInfo || !bilValue) && (bilInfo || bilValue)){
  //         if(!bilInfo){
  //           kosong += `<li>Kolom Bill Info ${i} pada tagihan 3 wajib diisi.</li>`
  //           $(`[name="billDetails[2][additionalInfo][billInfo${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //           $(`#billInfo${i}_3_res`).html(`Kolom Bill Info ${i} pada tagihan 3 wajib diisi`)
  //         }
  //         if(!bilValue){
  //           kosong += `<li>Kolom Bill Value ${i} pada tagihan 3 wajib diisi.</li>`
  //           $(`[name="billDetails[2][additionalInfo][billValue${i}]"]`).removeClass('is-valid').addClass('is-invalid')
  //           $(`#billValue${i}_3_res`).html(`Kolom Bill Value ${i} pada tagihan 3 wajib diisi`)
  //         }
  //       }

  //       if(!bilInfo && !bilValue){
  //         $(`[name="billDetails[2][additionalInfo][billInfo${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //         $(`#billInfo${i}_3_res`).html(``)
  //         $(`[name="billDetails[2][additionalInfo][billValue${i}]"]`).removeClass('is-invalid').removeClass('is-valid')
  //         $(`#billValue${i}_3_res`).html(``)
  //       }
  //     }


  //     $('#expiredDate').removeClass('is-invalid').addClass('is-valid')
  //     $('#expiredDate_date').html(``)
  //     if(!$('#expiredDate').val()){
  //       kosong += `<li>Kolom Tanggal Kadaluarsa Tagihan wajib diisi</li>`
  //       $('#expiredDate_res').html(`Kolom Tanggal Kadaluarsa Tagihan wajib diisi`)
  //       $('#expiredDate').removeClass('is-valid').addClass('is-invalid')
  //     }

  //     var callback_url = $('#callback_url').val()
  //     $('#callback_url').addClass('is-valid').removeClass('is-invalid')
  //     $('#callback_url_res').html('')
  //     if(!callback_url){
  //       $('#callback_url').removeClass('is-valid').addClass('is-invalid')
  //       $('#callback_url_res').html('Kolom Callback URL wajib diisi <br>')
  //       kosong += '<li>Kolom Callback URL wajib diisi</li>'
  //     } else {
  //       //pattern  untuk memeriksa apakah input mengandung http / https
  //       var urlPattern = /^(http:\/\/|https:\/\/)/;

  //       if(!urlPattern.test(callback_url)){
  //         $('#callback_url').removeClass('is-valid').addClass('is-invalid')
  //         $('#callback_url_res').html('Kolom Callback URL wajib mengandung http:// atau https://')
  //         kosong += '<li>Kolom Callback URL wajib mengandung http:// atau https://</li>'
  //       }
  //     }
  //   }

  //   if($('[name="va[jenis_va]"]').val() == 'static'){
  //     if(!$('[name="va[virtual_account]"]').val()){
  //       kosong += '<li>Kolom Nomor Virtual Account wajib diisi</li>'
  //     }else if($('[name="va[virtual_account]"]').val().length < 12){
  //       kosong += '<li>Kolom Nomor Virtual Account harus 12 digit</li>'
  //     }
  //   }

  //   const optionPemegangVa = [
  //     {
  //       name: 'alamat_identitas',
  //       label: 'Alamat Identitas'
  //     },
  //     {
  //       name: 'alamat_domisili',
  //       label: 'Alamat Domisili'
  //     },
  //     {
  //       name: 'kode_pekerjaan',
  //       label: 'Pekerjaan'
  //     },
  //     {
  //       name: 'alamat_tempat_kerja',
  //       label: 'Pekerjaan'
  //     },
  //     {
  //       name: 'nomor_telepon_tempat_kerja',
  //       label: 'Pekerjaan'
  //     },
  //     {
  //       name: 'kode_penghasilan',
  //       label: 'Penghasilan'
  //     },
  //     {
  //       name: 'penghasilan_rata_rata_pertahun',
  //       label: 'Penghasilan rata-rata pertahun'
  //     },
  //     {
  //       name: 'kode_agama',
  //       label: 'Agama'
  //     },
  //     {
  //       name: 'kode_pendidikan',
  //       label: 'Pendidikan'
  //     },
  //     {
  //       name: 'tempat_lahir',
  //       label: 'Tempat Lahir'
  //     },
  //     {
  //       name: 'tanggal_lahir',
  //       label: 'Tanggal Lahir'
  //     },
  //     {
  //       name: 'jenis_kelamin',
  //       label: 'Jenis Kelamin'
  //     },
  //     {
  //       name: 'kode_kewarganegaraan',
  //       label: 'Kewarganegaraan'
  //     },
  //     {
  //       name: 'kode_status_perkawinan',
  //       label: 'Status Perkawinan'
  //     },
  //     {
  //       name: 'nama_gadis_ibu_kandung',
  //       label: 'Nama gadis ibu kandung'
  //     },
  //     {
  //       name: 'identitas_pemilik_manfaat',
  //       label: 'Identitas Pemilik Manfaat (Beneficial Ownler)'
  //     },
  //     {
  //       name: 'kode_sumber_dana',
  //       label: 'Sumber Dana'
  //     },
  //     {
  //       name: 'tujuan_transaksi',
  //       label: 'Tujuan Transaksi'
  //     },
  //   ]
  //   //jika transaksi >= 100 jt
  //   if( (Ryuna.remove_format_rupiah('#mp1 th') >= 100000000 || Ryuna.remove_format_rupiah('#mp2 th') >= 100000000) && $('#disallow_teller').val() == 'false' ){
  //     if(!$('[name="va[virtualAccountPhone]"]').val()){
  //       kosong += '<li>Kolom Nomor Telepon virtual account wajib diisi</li>'
  //     }
  //     if($('[name="va[trxActor]"]').val() == 'true'){
  //       optionPemegangVa.map(item => {
  //         if(!$(`[name='additionalTrxActor[${item.name}]']`).val()){
  //           kosong += `<li>Kolom ${item.label} pelaku transaksi virtual account wajib diisi</li>`
  //         }
  //       })

  //       if(($('#select2-pekerjaan_pemegang_va-container').html()).toLowerCase() == 'lainnya'){
  //           if(!$('[name="additionalTrxActor[pekerjaan_lainnya]"]').val()){
  //           kosong += `<li>Kolom Pekerjaan Lainnya pelaku transaksi virtual account wajib diisi</li>`
  //           }
  //       }

  //       if(($('#select2-agama_pemegang_va-container').html()).toLowerCase() == 'lainnya'){
  //           if(!$('[name="additionalTrxActor[agama_lainnya]"]').val()){
  //           kosong += `<li>Kolom Agama Lainnya pelaku transaksi virtual account wajib diisi</li>`
  //           }
  //       }

  //       if(($('#select2-sumber_dana_pemegang_va-container').html()).toLowerCase() == 'lainnya'){
  //           if(!$('[name="additionalTrxActor[sumber_dana_lainnya]"]').val()){
  //           kosong += `<li>Kolom Sumber Dana Lainnya pelaku transaksi virtual account wajib diisi</li>`
  //           }
  //       }
  //     }
  //   }

  //   $('#response_container').empty()
  //   if(kosong){
  //     let message = `<div class="alert alert-danger alert-dismissible fade show">
  //         <ul style="margin: 0; padding: 0">
  //           Step 2
  //           <ul>
  //             ${kosong}
  //           </ul>
  //         </ul>
  //       </div>`
  //     $('#response_container').html(message)
  //     return false;
  //   }
  //   return true;
  // }


  // function validateStep3() {
  //   let maker_element = {
  //     username: $('[name="userMaker[username]"][data-role="maker"]'),
  //     email: $('[name="userMaker[email]"][data-role="maker"]'),
  //     firstname: $('[name="userMaker[firstname]"][data-role="maker"]'),
  //     lastname: $('[name="userMaker[lastname]"][data-role="maker"]')
  //   }

  //   let approver_element = {
  //     username: $('[name="userApprover[username]"][data-role="approver"]'),
  //     email: $('[name="userApprover[email]"][data-role="approver"]'),
  //     firstname: $('[name="userApprover[firstname]"][data-role="approver"]'),
  //     lastname: $('[name="userApprover[lastname]"][data-role="approver"]')
  //   }

  //   let maker = {
  //     username: $('[name="userMaker[username]"][data-role="maker"]').val(),
  //     email: $('[name="userMaker[email]"][data-role="maker"]').val(),
  //     firstname: $('[name="userMaker[firstname]"][data-role="maker"]').val(),
  //     lastname: $('[name="userMaker[lastname]"][data-role="maker"]').val(),
  //     errors: []
  //   }

  //   let approver = {
  //     username: $('[name="userApprover[username]"][data-role="approver"]').val(),
  //     email: $('[name="userApprover[email]"][data-role="approver"]').val(),
  //     firstname: $('[name="userApprover[firstname]"][data-role="approver"]').val(),
  //     lastname: $('[name="userApprover[lastname]"][data-role="approver"]').val(),
  //     errors: []
  //   }

  //   maker_element.username.removeClass('is-invalid');
  //   maker_element.email.removeClass('is-invalid');
  //   maker_element.firstname.removeClass('is-invalid');
  //   maker_element.lastname.removeClass('is-invalid');

  //   approver_element.username.removeClass('is-invalid');
  //   approver_element.email.removeClass('is-invalid');
  //   approver_element.firstname.removeClass('is-invalid');
  //   approver_element.lastname.removeClass('is-invalid');

  //   maker_element.username.addClass('is-valid')
  //   maker_element.email.addClass('is-valid')
  //   maker_element.firstname.addClass('is-valid')
  //   maker_element.lastname.addClass('is-valid')

  //   approver_element.username.addClass('is-valid')
  //   approver_element.email.addClass('is-valid')
  //   approver_element.firstname.addClass('is-valid')
  //   approver_element.lastname.addClass('is-valid')

  //   if (!maker.username) {
  //     maker.errors.push('Kolom Username maker wajib diisi')
  //     maker_element.username.removeClass('is-valid');
  //     maker_element.username.addClass('is-invalid');
  //   } else if (maker.username === approver.username) {
  //     maker.errors.push('Kolom Username maker tidak boleh sama dengan username approver')
  //     maker_element.username.removeClass('is-valid');
  //     maker_element.username.addClass('is-invalid');
  //   } else if (maker.email === approver.email) {
  //     maker.errors.push('Kolom Email maker tidak boleh sama dengan email approver')
  //     maker_element.email.removeClass('is-valid');
  //     maker_element.email.addClass('is-invalid');
  //   } else {
  //     let isUsernameMakerValid = Ryuna.isUsernameValid(maker.username);
  //     if (!isUsernameMakerValid.first_rule) {
  //       maker.errors.push('Kolom Username maker terdiri dari alfanumerik (a-z 0-9), titik (.), stripe (-) dan underscore (_)')
  //       maker_element.username.removeClass('is-valid');
  //       maker_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameMakerValid.second_rule) {
  //       maker.errors.push('Kolom Username maker tidak boleh diawali dan diakhiri dengan titik (.), stripe (-) atau underscore (_)')
  //       maker_element.username.removeClass('is-valid');
  //       maker_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameMakerValid.third_rule) {
  //       maker.errors.push('Kolom Username maker tidak boleh mengandung titik (.), stripe (-) atau underscore (_) secara berurutan')
  //       maker_element.username.removeClass('is-valid');
  //       maker_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameMakerValid.fourth_rule) {
  //       maker.errors.push('Kolom Username maker minimal 5 karakter dan maksimal 20 karakter')
  //       maker_element.username.removeClass('is-valid');
  //       maker_element.username.addClass('is-invalid');
  //     }
  //   }

  //   if (!approver.username) {
  //     approver.errors.push('Kolom Username approver wajib diisi')
  //     approver_element.username.removeClass('is-valid');
  //     approver_element.username.addClass('is-invalid');
  //   } else if (maker.username === approver.username) {
  //     approver.errors.push('Kolom Username approver tidak boleh sama dengan username approver')
  //     approver_element.username.removeClass('is-valid');
  //     approver_element.username.addClass('is-invalid');
  //   }else if (maker.email === approver.email) {
  //     maker.errors.push('Kolom Email approver tidak boleh sama dengan email maker')
  //     approver_element.email.removeClass('is-valid');
  //     approver_element.email.addClass('is-invalid');
  //   } else {
  //     let isUsernameApproverValid = Ryuna.isUsernameValid(approver.username);
  //     if (!isUsernameApproverValid.first_rule) {
  //       approver.errors.push('Kolom Username approver terdiri dari alfanumerik (a-z 0-9), titik (.), stripe (-) dan underscore (_)')
  //       approver_element.username.removeClass('is-valid');
  //       approver_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameApproverValid.second_rule) {
  //       approver.errors.push('Kolom Username approver tidak boleh diawali dan diakhiri dengan titik (.), stripe (-) atau underscore (_)')
  //       approver_element.username.removeClass('is-valid');
  //       approver_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameApproverValid.third_rule) {
  //       approver.errors.push('Kolom Username approver tidak boleh mengandung titik (.), stripe (-) atau underscore (_) secara berurutan')
  //       approver_element.username.removeClass('is-valid');
  //       approver_element.username.addClass('is-invalid');
  //     }
  //     if (!isUsernameApproverValid.fourth_rule) {
  //       approver.errors.push('Kolom Username approver minimal 5 karakter dan maksimal 20 karakter')
  //       approver_element.username.removeClass('is-valid');
  //       approver_element.username.addClass('is-invalid');
  //     }
  //   }

  //   if (!maker.email) {
  //     maker.errors.push('Kolom Email maker wajib diisi')
  //     maker_element.email.removeClass('is-valid');
  //     maker_element.email.addClass('is-invalid');
  //   } else if (!Ryuna.isEmail(maker.email)) {
  //     maker.errors.push('Kolom Email maker tidak valid')
  //     maker_element.email.removeClass('is-valid');
  //     maker_element.email.addClass('is-invalid');
  //   }
  //   if (!approver.email) {
  //     approver.errors.push('Kolom Email approver wajib diisi')
  //     approver_element.email.removeClass('is-valid');
  //     approver_element.email.addClass('is-invalid');
  //   } else if (!Ryuna.isEmail(approver.email)) {
  //     approver.errors.push('Kolom Email approver tidak valid')
  //     approver_element.email.removeClass('is-valid');
  //     approver_element.email.addClass('is-invalid');
  //   }

  //   if (!maker.firstname) {
  //     maker.errors.push('Kolom Nama depan maker wajib diisi')
  //     maker_element.firstname.removeClass('is-valid');
  //     maker_element.firstname.addClass('is-invalid');
  //   }

  //   if (!approver.firstname) {
  //     approver.errors.push('Kolom Nama depan approver wajib diisi')
  //     approver_element.firstname.removeClass('is-valid');
  //     approver_element.firstname.addClass('is-invalid');
  //   }

  //   if (!maker.lastname) {
  //     maker.errors.push('Kolom Nama belakang maker wajib diisi')
  //     maker_element.lastname.removeClass('is-valid');
  //     maker_element.lastname.addClass('is-invalid');
  //   }

  //   if (!approver.lastname) {
  //     approver.errors.push('Kolom Nama belakang approver wajib diisi')
  //     approver_element.lastname.removeClass('is-valid');
  //     approver_element.lastname.addClass('is-invalid');
  //   }

  //   if (maker.errors.length > 0 || approver.errors.length > 0) {
  //     let message = `<div class="alert alert-danger alert-dismissible fade show">
  //         <ul style="margin: 0; padding: 0">
  //           Step 3:
  //           <ul>
  //               ${maker.errors.map(error => `<li>${error}</li>`).join('')}
  //               ${approver.errors.map(error => `<li>${error}</li>`).join('')}
  //           </ul>
  //         </ul>
  //       </div>`;
  //     $('#response_container').html(message);
  //     return false;
  //   }

  //   return true;
  // }
</script>