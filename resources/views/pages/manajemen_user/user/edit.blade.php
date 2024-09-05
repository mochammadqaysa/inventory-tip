<form action="{{ route('user.update', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    @include('pages.manajemen_user.user.form')            
  </form>
  <div id="response_container"></div>
  <script>
    $('#btn-sh-password').on('click', () => {
      let icon = $('#btn-sh-password i').attr('class');
      if(icon == 'fa fa-eye-slash'){
        $('#password').attr('type', 'text')
        $('#btn-sh-password i').attr('class', 'fa fa-eye')
      }else{
        $('#password').attr('type', 'password')
        $('#btn-sh-password i').attr('class', 'fa fa-eye-slash')
      }
    });
  
  </script>