<form action="{{ route('role.store') }}" method="POST" id="myForm">
  @csrf
  @include('pages.manajemen_user.role.form')            
</form>
<div id="response_container"></div>
