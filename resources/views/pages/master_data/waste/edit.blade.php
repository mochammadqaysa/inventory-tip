<form action="{{ route('waste.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.waste.form')            
  </form>
  <div id="response_container"></div>