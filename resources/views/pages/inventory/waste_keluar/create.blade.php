<form action="{{ route('waste-keluar.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.waste_keluar.form')            
  </form>
  <div id="response_container"></div>
  