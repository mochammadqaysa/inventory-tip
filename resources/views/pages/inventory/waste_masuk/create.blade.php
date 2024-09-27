<form action="{{ route('waste-masuk.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.waste_masuk.form')            
  </form>
  <div id="response_container"></div>
  