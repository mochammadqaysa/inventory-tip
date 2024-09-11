<form action="{{ route('changepass.profile', $uid) }}" method="POST" id="myForm">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group" id="group_pw1">
                <label>Old Password</label>
                <div class="input-group">
                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Old Password" >
                <div class="input-group-append">
                    <button class="btn btn-outline-default" type="button" id="btn-sh-old-password"><i class="fa fa-eye-slash"></i></button>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" id="group_pw2">
                <label>New Password</label>
                <div class="input-group">
                <input type="password" id="new_password" name="new_password" class="form-control" placeholder="New Password" >
                <div class="input-group-append">
                    <button class="btn btn-outline-default" type="button" id="btn-sh-new-password"><i class="fa fa-eye-slash"></i></button>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group" id="group_pw3">
                <label>New Password Confirmation</label>
                <div class="input-group">
                <input type="password" id="new_password_confirm" name="new_password_confirmation" class="form-control" placeholder="New Password Confirmation" >
                <div class="input-group-append">
                    <button class="btn btn-outline-default" type="button" id="btn-sh-confirm-password"><i class="fa fa-eye-slash"></i></button>
                </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="response_container"></div>

<script>
    $('#btn-sh-confirm-password').on('click', () => {
      let icon = $('#btn-sh-confirm-password i').attr('class');
      if(icon == 'fa fa-eye-slash'){
        $('#new_password_confirm').attr('type', 'text')
        $('#btn-sh-confirm-password i').attr('class', 'fa fa-eye')
      }else{
        $('#new_password_confirm').attr('type', 'password')
        $('#btn-sh-confirm-password i').attr('class', 'fa fa-eye-slash')
      }
    });
    $('#btn-sh-new-password').on('click', () => {
      let icon = $('#btn-sh-new-password i').attr('class');
      if(icon == 'fa fa-eye-slash'){
        $('#new_password').attr('type', 'text')
        $('#btn-sh-new-password i').attr('class', 'fa fa-eye')
      }else{
        $('#new_password').attr('type', 'password')
        $('#btn-sh-new-password i').attr('class', 'fa fa-eye-slash')
      }
    });
    $('#btn-sh-old-password').on('click', () => {
      let icon = $('#btn-sh-old-password i').attr('class');
      if(icon == 'fa fa-eye-slash'){
        $('#old_password').attr('type', 'text')
        $('#btn-sh-old-password i').attr('class', 'fa fa-eye')
      }else{
        $('#old_password').attr('type', 'password')
        $('#btn-sh-old-password i').attr('class', 'fa fa-eye-slash')
      }
    });
</script>