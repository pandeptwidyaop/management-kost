<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app.name','')}} | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{url('/')}}"><b>{{config('app.name','')}}</b>Panel</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{url('/register')}}" method="post">
      {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
        <input type="text" class="form-control" placeholder="Full name" name="name" value="{{old('name')}}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
        @if ($errors->has('name'))
          <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
        @endif

      </div>
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
          <span class="help-block">
              <strong>{{ $errors->first('email') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
          <span class="help-block">
              <strong>{{ $errors->first('password') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        @if ($errors->has('password_confirmation'))
          <span class="help-block">
              <strong>{{ $errors->first('password_confirmation') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('address') ? ' has-error' : '' }}">
        <input class="form-control" type="text" name="address" value="{{old('address')}}" placeholder="Type your address">
        <span class="glyphicon glyphicon-home form-control-feedback"></span>
        @if ($errors->has('address'))
          <span class="help-block">
              <strong>{{ $errors->first('address') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('handphone') ? ' has-error' : '' }}">
        <input class="form-control" type="text" name="handphone" value="{{old('handphone')}}" placeholder="Handphone number">
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        @if ($errors->has('handphone'))
          <span class="help-block">
              <strong>{{ $errors->first('handphone') }}</strong>
          </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('id_number') ? ' has-error' : '' }}">
        <input class="form-control" type="text" name="id_number" value="{{old('id_number')}}" placeholder="ID Number (KTP)">
        <span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
        @if ($errors->has('id_number'))
          <span class="help-block">
              <strong>{{ $errors->first('id_number') }}</strong>
          </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
    <a href="{{url('/login')}}" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
