<form action="{{ route('jenis-waste.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.master_data.jenis_waste.form')            
  </form>
  <div id="response_container"></div>