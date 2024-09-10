<form action="{{ route('gudang.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.gudang.form')            
  </form>
  <div id="response_container"></div>
  