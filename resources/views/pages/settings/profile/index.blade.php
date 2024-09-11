@extends('layouts.root')

@section('title', 'Profile')


@section('breadcrum')
<div class="col-lg-6 col-7">
  <h6 class="h2 text-white d-inline-block mb-0">Settings</h6>
  <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
    <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
      <li class="breadcrumb-item"><a href="#"><i class="fas fa-id-badge"></i></a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
  </nav>
</div>
@endsection

@section('page')
@php
use App\Helpers\AuthCommon;
$user = AuthCommon::getUser();
@endphp
<div class="row">
    <div class="col-md-3 ">
      <div class="card long-card">
        <div class="card-body" >
          <div class="row p-2" id="detail-account" style="padding-bottom: 0px">
            <div class="col-md-5 d-flex align-items-center">
              <img src="{{ asset($user->profile_picture == null ? 'img/default-avatar.png' : 'upload/' . $user->profile_picture)}}" class="rounded-circle" style="width: 100px; height:100px;" alt="circle-picture">
            </div>
            <div class="col-md-7 mt-4">
              <h2>{{$user->name}}</h2>
              <p> <i class="fas fa-user-tag mr-2"></i>{{$user->role->name}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-9 ">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h2>Menu</h2>
          </div>
        </div>
        <div class="card-body bg-secondary">
          <div class="row ">
            <div class="col-md-12" id="list-menu" style="">
              <a href="javascript:formEditProfil()" class="row-account">
                <div class="card shadow" id="account-${v.id}" style="padding-bottom: 0px">
                  <div class="card-body">
                    <h2><i class="fas fa-edit mr-3"></i> Edit Profil</h2>
                  </div>
                </div>
              </a>
              <a href="javascript:formChangePassword()" class="row-account">
                <div class="card shadow" id="account-${v.id}" style="padding-bottom: 0px">
                  <div class="card-body">
                    <h2><i class="fas fa-unlock-alt mr-3"></i> Change Password</h2>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-md-7" id="detail-" style="display: none;">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  let _url = {
    form_profile: `{{ route('form.profile') }}`,
    change_pass: `{{ route('password.profile') }}`,
  }
  // let detail_account = $("#detail-account"); 
  // detail_account.slideDown();
  function formEditProfil() {
    Ryuna.blockUI()
    $.get(_url.form_profile).done((res) => {
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

  function saveProfile(){
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
        location.reload();
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

  function formChangePassword() {
    Ryuna.blockUI()
    $.get(_url.change_pass).done((res) => {
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

  function savePassword(){
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
        location.reload();
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
</script>
@endsection