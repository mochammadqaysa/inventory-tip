<form action="{{ route('customer.store') }}" method="POST" id="myForm">
    @csrf
    @include('pages.master_data.customer.form')            
  </form>
  <div id="response_container"></div>
  