<form action="{{ route('bagian.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.bagian.form')            
  </form>
  <div id="response_container"></div>
  