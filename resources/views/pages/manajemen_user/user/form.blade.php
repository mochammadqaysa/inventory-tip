<div class="row">
    <div class="form-group col-md-12">
      <label>Name</label>
      <input type="text" name="name" class="form-control" placeholder="Name" value="{{ @$data->name }}">
    </div>
  
    @if (!isset($data))
    <div class="form-group col-md-6">
      <label>Username</label>
      <input type="text" name="username" class="form-control" placeholder="Username" value="{{ @$data->username }}">
    </div>
    
    <div class="col-md-6">
      <div class="form-group" id="group_pw">
        <label>Password</label>
        <div class="input-group">
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" >
          <div class="input-group-append">
            <button class="btn btn-outline-default" type="button" id="btn-sh-password"><i class="fa fa-eye-slash"></i></button>
          </div>
        </div>
      </div>
    </div>
    @else
    <div class="form-group col-md-12">
      <label>Username</label>
      <input type="text" name="username" class="form-control" placeholder="Username" value="{{ @$data->username }}">
    </div>
    @endif

    
    <div class="form-group col-md-12">
      <label>Role</label>
        {{-- <input type="text" name="role" class="form-control" placeholder="User Group" value="{{ @$data->role }}"> --}}
        <select class="form-control" name="role" id="select2-role">
            @if(isset($data->role->uid))
            <option value="{{ $data->role->uid }}">{{ $data->role->name }}</option>
            @endif
        </select>
      </div>
    </div>

    <div class="row justify-content-md-start">
      <div class="col-md-6">
      <label for="logo">Profile Picture</label>
      <div class="logo_image_picker my-1 position-relative rounded overflow-hidden d-flex justify-content-center align-items-center" 
          style="height: 150px; width: 150px; border: 1.5px dotted #dee2e6; cursor: pointer;">
          
          <div class="text-center upload-placeholder">
              <i class="fas fa-upload fa-2x"></i>
              <p class="small">Klik di sini untuk mengunggah gambar</p>
          </div>

          <img id="imagePreview" src="" alt="Image Preview" class="img-thumbnail position-absolute w-100 h-100" 
              style="object-fit: cover; display: none;">

          <div class="loading_image_picker position-absolute w-100 h-100 d-none" 
              style="backdrop-filter: blur(2px); top: 0; left: 0;">
              <div class="d-flex justify-content-center align-items-center h-100">
                  <img src="{{ asset('img/loading2.gif') }}" style="height: 15px;">
                  <p class="small fw-bold ms-2">Tunggu Sebentar</p>
              </div>
          </div>
      </div>
      <input type="file" name="profile" id="logo" autocomplete="off" style="display: none;">
    </div>
</div>
  
<script>
  var _url_select2 = {
    role: `{{ route('select2.role') }}`,
  }

  var _limit = 10

  function formatResult(res) {
    if (res.loading) {
      return res.text;
    }
    return res.name;
  }

  function formatSelection(res) {
    return res.name || res.text;
  }

  function initSelect2(module){
    $(`#select2-${module}`).select2({
      ajax: {
        url: _url_select2[module],
        dataType: 'json',
        delay: 250,
        data: function (params) {
          // console.log('req', params)
          return {
            term: params.term,
            page: params.page || 0,
            limit: _limit
          };
        },
        processResults: function (data, params) {
          console.log('res', data)
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


  $(() => {
    
    initSelect2('role');
    $('.logo_image_picker').on('click', function() {
        $('#logo').click();
    });

    $('#logo').change(function() {
      const file = this.files[0];
      const fileType = file['type'];
      const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
      
      if ($.inArray(fileType, validImageTypes) < 0) {
          alert('Hanya file gambar yang diperbolehkan (JPG, PNG, GIF).');
          $(this).val(''); // Clear the input if invalid file
          $('#imagePreview').hide();
          $('.upload-placeholder').show();
          return false;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
          $('#imagePreview').attr('src', e.target.result).show();
          $('.upload-placeholder').hide();
      }
      reader.readAsDataURL(file);

      $('.loading_image_picker').removeClass('d-none');

      // Simulate loading delay for demo purposes
      setTimeout(function() {
          $('.loading_image_picker').addClass('d-none');
      }, 1000); // Adjust as needed
  });
  })
</script>