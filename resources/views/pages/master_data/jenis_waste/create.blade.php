<form action="{{ route('jenis-waste.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.jenis_waste.form')            
  </form>
  <div id="response_container"></div>
  