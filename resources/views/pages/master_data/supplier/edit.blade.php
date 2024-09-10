<form action="{{ route('supplier.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.supplier.form')            
  </form>
  <div id="response_container"></div>