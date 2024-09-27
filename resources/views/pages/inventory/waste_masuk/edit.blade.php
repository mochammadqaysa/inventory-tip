<form action="{{ route('waste-masuk.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.waste_masuk.form_edit')            
  </form>
  <div id="response_container"></div>