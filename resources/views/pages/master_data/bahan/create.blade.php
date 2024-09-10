<form action="{{ route('bahan.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.bahan.form')            
  </form>
  <div id="response_container"></div>
  