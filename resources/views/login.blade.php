
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>School ERP | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="../../index2.html"><b>Login</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login-user') }}" method="post">
        @csrf
         @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
         @endif
         @if(Session::has('fail'))
             <div class="alert alert-danger">{{Session::get('fail')}}</div>
         @endif
        <div class="form-group has-feedback">
        <select class="form-control" name="role_id">
                    <option value="">Select Role</option>
                    <option value="1">Admin</option>
                    <option value="2">Accountant</option>

        </select>
         <span class="text-danger"><b>@error('role_id'){{$message}} @enderror</b></span>
      </div>
      <br/>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <span class="text-danger"><b>@error('email'){{$message}} @enderror</b></span>
      </div>
       <br />
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <span class="text-danger"><b>@error('password'){{$message}} @enderror</b></span>
      </div>
       <br />
      <div class="row">

        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br />
    <a href="#">I forgot my password</a><br>


  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<script src="{{ asset("bower_components/jquery/dist/jquery.min.js") }}"></script>

<script src="{{ asset("bower_components/bootstrap/dist/js/bootstrap.min.js") }}"></script>

<!-- iCheck -->
<script src="{{ asset("plugins/iCheck/icheck.min.js") }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
