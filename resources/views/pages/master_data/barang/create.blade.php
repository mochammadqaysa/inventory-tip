<form action="{{ route('barang.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.barang.form')            
  </form>
  <div id="response_container"></div>
  