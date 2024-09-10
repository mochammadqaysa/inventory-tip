<form action="{{ route('bagian.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.bagian.form')            
  </form>
  <div id="response_container"></div>