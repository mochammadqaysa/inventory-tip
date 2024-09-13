<form action="{{ route('bahan-masuk.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.inventory.bahan_masuk.form')            
  </form>
  <div id="response_container"></div>
  