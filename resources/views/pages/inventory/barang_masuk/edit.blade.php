<form action="{{ route('barang-masuk.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.barang_masuk.form_edit')            
  </form>
  <div id="response_container"></div>