<form action="{{ route('bahan-masuk.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.inventory.bahan_masuk.form_edit')            
  </form>
  <div id="response_container"></div>