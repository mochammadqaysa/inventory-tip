<form action="{{ route('barang-keluar.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.barang_keluar.form_edit')            
  </form>
  <div id="response_container"></div>