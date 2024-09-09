@extends('layouts.root')

@section('title', 'Backup Data')

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Manajemen Data</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="fas fa-digital-tachograph"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">Backup Data</li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
<div class="row">
  <div class="col-xl-12 order-xl-1">
    <div class="card">
      {{-- <div class="card-header">
        <form action="{{ route('dashboard.upload') }}" method="post" id="form-upload" enctype="multipart/form-data">
          @csrf
          <input type="file" id="" class="form-control" name="files[]" webkitdirectory directory multiple >
          <button class="btn btn-primary"  type="submit">upload</button>
        </form>
      </div> --}}
      <div class="card-body">
        {{-- @include('admin.alert') --}} 
        <div class="row">
          <div class="col-md-12">
              <div class="alert alert-danger">
                  <strong>Mohon ikuti intruksi dibawah ini !</strong>
              </div>
          </div>
            <div class="col-md-12">
                <div class="alert alert-primary">
                    <strong>1.</strong> Silakan masukan file-file kedalam satu folder (Rekomendasi Nama folder : <strong>{{ date('Y-m-d') }} / tanggal hari ini</strong>)
                </div>
            </div>
        </div>
        <div class="row">
            {{-- <div class="form-group col-md-12">
                <label></label>
                <a href="{!! asset('upload/templates/template-nasabah.xlsx') !!}" class="btn btn-success" >
                    <i class="fa fa-download"></i> Download Template Disini</a>
            </div> --}}
            <div class="col-md-12">
                <div class="alert alert-primary">
                    <strong>2.</strong> Lakukan tinjau ulang file-file yang ada di dalam folder yang akan di upload
                </div>
            </div>
            <div class="col-md-12">
                <div class="alert alert-primary">
                    <strong>3.</strong> Pilih folder dengan klik <strong>Choose Files</strong> dibawah
                </div>
            </div>
            <div class="col-md-12">
                <div class="alert alert-primary">
                    <strong>4.</strong> Klik tombol <strong><i class="fa fa-upload"></i> Upload</strong>
                </div>
            </div>
            <div class="col-md-5 mt-3 mb-2 py-auto d-flex align-items-center">
                <label class="custom-toggle mb-0">
                    <input type="checkbox" onchange="change_status(this)">
                    <span class="custom-toggle-slider rounded-circle" data-label-off="" data-label-on=""></span>
                </label>
                <span class="ml-2">Saya mengerti dengan ketentuan diatas</span>
            </div>
            <div class="form-group col-md-12">
              <form action="{{route('dashboard.upload')}}" method="POST" id="form-upload" enctype="multipart/form-data">
                @php
                  use App\Helpers\Menu;
                  use App\Helpers\AuthCommon;
                  $user = AuthCommon::getUser();
                @endphp
                <div class="form-inline">
                  <input type="hidden"  id="uid" name="uid" value="{{$user->uid}}">
                    <input type="file" required disabled id="file" class="form-control" name="files[]" webkitdirectory directory multiple style="margin-right: 10px" >
                    <button type="submit" disabled class="btn btn-success" >
                        <i class="fa fa-upload"></i> Upload
                    </button>
                </div>
              </form>
            </div>
        </div>

        {{-- <form action="{{ route('dashboard.upload') }}" method="post" id="form-upload" enctype="multipart/form-data">
          @csrf
          <input type="file" id="" class="form-control" name="files[]" webkitdirectory directory multiple >
          <button class="btn btn-primary"  type="submit">upload</button>
        </form> --}}
        <div class="table-responsive py-2">
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

<script>
   let xhr = null;  // Variable to store the XMLHttpRequest object
   let timeoutID = null;

   function updateProgress(percent) {
      $('.progress-percentage span').text('Proses Upload: ' + percent + '%');
      $('.progress-bar').css('width', percent + '%').attr('aria-valuenow', percent);
  }
  $('#form-upload').submit(function(e) {
        e.preventDefault();
        let el_form = $('#form-upload')
        let target = el_form.attr('action')
        let formData = new FormData();
        formData.append('uid',$("#uid").val());
        let files = $('#file')[0].files;

        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        // Show the progress overlay at the start of the upload
        Ryuna.progressLoading(0);

        xhr = $.ajax({
            url: target,
            type: 'POST',
            data: formData,
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            xhr: function() {
                let xhr = new window.XMLHttpRequest();

                // Event listener for progress update
                xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                        let percentComplete = Math.round((e.loaded / e.total) * 100);
                        updateProgress(percentComplete);  // Update the progress bar dynamically
                    }
                }, false);

                return xhr;
            },
            success: function(response) {
                updateProgress(100);  // Set to 100% on success
                $.unblockUI()
                // setTimeout(, 1000);  // Hide the overlay after a short delay
                Swal.fire({
                  title: "Berhasil Upload Folder",
                  text: '',
                  type: 'success',
                  confirmButtonColor: '#007bff'
                })
            },
            error: function(e) {
              console.log(e)
                $.unblockUI();  // Hide the overlay on error
                Swal.fire({
                  title: "Gagal Upload Folder",
                  text: '',
                  type: 'error',
                  confirmButtonColor: '#007bff'
                })
            }
        });
    });

  
  function change_status(e){
    const blocked = $(e).prop("checked");

    if (blocked) {
      $('#form-upload input').prop('disabled', false);
      $('#form-upload button').prop('disabled', false);
    } else {
      $('#form-upload input').prop('disabled', true);
      $('#form-upload button').prop('disabled', true);
    }
  }
</script>
@endsection