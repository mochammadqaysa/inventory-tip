<form action="{{ route('barang-keluar.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.barang_keluar.form')            
  </form>
  <div id="response_container"></div>
  