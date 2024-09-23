<form action="{{ route('bahan-keluar.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.bahan_keluar.form')            
  </form>
  <div id="response_container"></div>
  