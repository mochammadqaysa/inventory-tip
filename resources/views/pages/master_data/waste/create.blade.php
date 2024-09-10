<form action="{{ route('waste.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.waste.form')            
  </form>
  <div id="response_container"></div>
  