<form action="{{ route('role.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.manajemen_user.role.form')            
  </form>
  <div id="response_container"></div>