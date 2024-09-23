<form action="{{ route('bahan-keluar.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.bahan_keluar.form_edit')            
  </form>
  <div id="response_container"></div>