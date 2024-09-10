<form action="{{ route('bahan.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.bahan.form')            
  </form>
  <div id="response_container"></div>