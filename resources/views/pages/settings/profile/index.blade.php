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
<div class="row">
    <div class="col-md-3 ">
      <div class="card long-card">
        <div class="card-body">
          <button class="btn btn-block btn-primary mb-3" onclick="create()"><i class="fas fa-user-friends"></i> New Account</button>
          <h2 class="text-primary">Filter</h2>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Paired</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Unpaired</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-md-9 ">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between">
            <h2>Telegram Account</h2>
            <p>asd Account</p>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-5 border-right" id="list-telegram-account" style="display: none;">
              
            </div>
            <div class="col-md-7" id="detail-account" style="display: none;">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection