<form action="{{ route('gudang.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.gudang.form')            
  </form>
  <div id="response_container"></div>