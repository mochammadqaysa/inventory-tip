<form action="{{ route('barang-masuk.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.barang_masuk.form')            
  </form>
  <div id="response_container"></div>
  