<form action="{{ route('barang.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.barang.form')            
  </form>
  <div id="response_container"></div>