@extends('layouts.root')

@section('title', 'Role')

@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Manajemen User</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="fas fa-user-astronaut"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">Role</li>
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
        <div class="table-responsive py-2">
          {!! $dataTable->table(['class' => 'table dt_table table-flush table-vertical-align']) !!}
          
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')

{!! $dataTable->scripts() !!}
<script>
  let _url = {
    create: `{{ route('role.create') }}`,
    edit: `{{ route('role.edit', ':id') }}`,
    show: `{{ route('role.show', ':id') }}`,
    destroy: `{{ route('role.destroy', ':id') }}`
  }

  function create(){
    Ryuna.blockUI()
    $.get(_url.create).done((res) => {
      Ryuna.modal({
        title: res?.title,
        body: res?.body,
        footer: res?.footer
      })
      Ryuna.unblockUI()
    }).fail((xhr) => {
      Ryuna.unblockUI()
      Swal.fire({
        title: 'Whoops!',
        text: xhr?.responseJSON?.message ? xhr.responseJSON.message : 'Internal Server Error',
        type: 'error',
        confirmButtonColor: '#007bff'
      })
    })
  }

  function edit(id){
    Ryuna.blockUI()
    $.get(_url.edit.replace(':id', id)).done((res) => {
      Ryuna.modal({
        title: res?.title,
        body: res?.body,
        footer: res?.footer
      })
      Ryuna.unblockUI()
    }).fail((xhr) => {
      Ryuna.unblockUI()
      Swal.fire({
        title: 'Whoops!',
        text: xhr?.responseJSON?.message ? xhr.responseJSON.message : 'Internal Server Error',
        type: 'error',
        confirmButtonColor: '#007bff'
      })
    })
  }

  function upload() {
    Ryuna.blockElement('.modal-content');
    let el_form = $('#form-upload')
    let target = el_form.attr('action')
    
    // Create a new FormData object
    let formData = new FormData();
    
    // Get all file inputs (ensure your HTML has input type="file" with webkitdirectory attribute)
    let fileInput = el_form.find('input[type="file"]')[0];
    
    // Loop through all files and add them to formData
    for (let i = 0; i < fileInput.files.length; i++) {
        let file = fileInput.files[i];
        // Append each file with its relative path
        formData.append('files[]', file, file.webkitRelativePath);
    }
    
    // You can append other form data if needed
    el_form.find(':input').each(function() {
        let input = $(this);
        if (input.attr('type') !== 'file') {
            formData.append(input.attr('name'), input.val());
        }
    });
  
    $.ajax({
      url: target,
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
    }).done((res) => {
      if (res?.status == true) {
        let html = '<div class="alert alert-success alert-dismissible fade show">';
        html += `${res?.message}`;
        html += '</div>';
        Ryuna.noty('success', '', res?.message);
        $('#response_container').html(html);
        Ryuna.unblockElement('.modal-content');
  
        if ($('[name="_method"]').val() == undefined) {
          el_form[0].reset();
        }
      }
    }).fail((xhr) => {
      if (xhr?.status == 422) {
        let errors = xhr.responseJSON.errors;
        let html = '<div class="alert alert-danger alert-dismissible fade show">';
        html += '<ul>';
        for (let key in errors) {
          html += `<li>${errors[key]}</li>`;
        }
        html += '</ul>';
        html += '</div>';
        $('#response_container').html(html);
        Ryuna.unblockElement('.modal-content');
      } else {
        let html = '<div class="alert alert-danger alert-dismissible fade show">';
        html += `${xhr?.responseJSON?.message}`;
        html += '</div>';
        Ryuna.noty('error', '', xhr?.responseJSON?.message);
        $('#response_container').html(html);
        Ryuna.unblockElement('.modal-content');
      }
    });
}


  function save(){
    $('#response_container').empty();
    Ryuna.blockElement('.modal-content');
    let el_form = $('#myForm')
    let target = el_form.attr('action')
    let formData = new FormData(el_form[0])
  
    $.ajax({
      url: target,
      data: formData,
      processData: false,
      contentType: false,
      type: 'POST',
    }).done((res) => {
      if(res?.status == true){
        let html = '<div class="alert alert-success alert-dismissible fade show">'
        html += `${res?.message}`
        html += '</div>'
        Ryuna.noty('success', '', res?.message)
        $('#response_container').html(html)
        Ryuna.unblockElement('.modal-content')
  
        if($('[name="_method"]').val() == undefined) {
          el_form[0].reset()
          // $('[name="role"]').val(null).trigger('change')
          // $('[name="branch"]').val(null).trigger('change')
          // $('[name="jobposition"]').val(null).trigger('change')
        }
        window.LaravelDataTables["roles-table"].draw()
      }
    }).fail((xhr) => {
      if(xhr?.status == 422){
        let errors = xhr.responseJSON.errors
        let html = '<div class="alert alert-danger alert-dismissible fade show">'
        html += '<ul>';
        for(let key in errors){
          html += `<li>${errors[key]}</li>`;
        }
        html += '</ul>'
        html += '</div>'
        $('#response_container').html(html)
        Ryuna.unblockElement('.modal-content')
      }else{
        let html = '<div class="alert alert-danger alert-dismissible fade show">'
        html += `${xhr?.responseJSON?.message}`
        html += '</div>'
        Ryuna.noty('error', '', xhr?.responseJSON?.message)
        $('#response_container').html(html)
        Ryuna.unblockElement('.modal-content')
      }
    })
  }
  
  function destroy(id){
    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Anda tidak dapat mengembalikan data yang sudah terhapus",
      type: 'question',
      showCancelButton: true,
      confirmButtonColor: '#dc3545',
      cancelButtonColor: '#007bff',
      confirmButtonText: 'Yes',
      cancelButtonText: 'No'
    }).then((result) => {
      console.log(result)
      if (result.value) {
        $.ajax({
          url: _url.destroy.replace(':id', id),
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: 'DELETE',
        }).done((res) => {
          Swal.fire({
            title: res.message,
            text: '',
            type: 'success',
            confirmButtonColor: '#007bff'
          })
        window.LaravelDataTables["roles-table"].draw()
        }).fail((xhr) => {
          Swal.fire({
            title: xhr.responseJSON.message,
            text: '',
            type: 'error',
            confirmButtonColor: '#007bff'
          })
        })
      }
    })
  }
</script>
@endsection