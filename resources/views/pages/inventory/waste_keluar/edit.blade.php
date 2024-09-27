<form action="{{ route('waste-keluar.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.waste_keluar.form_edit')            
  </form>
  <div id="response_container"></div>