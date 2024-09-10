<form action="{{ route('customer.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.customer.form')            
  </form>
  <div id="response_container"></div>