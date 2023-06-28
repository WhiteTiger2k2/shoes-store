<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Trang Đăng Nhập</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('css/admin/login.css')}}" rel="stylesheet">
</head>

<body>
	<div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>
        <div class="panel-body">
            <form role="form" method="post" action="{{route('admin.login.store')}}">
                @csrf
                <div class="form-group">
                    <input class="form-control" placeholder="Email" name="email" type="email">
                    <i class="fa fa-user"></i>
                    <span>
                        @if($errors->any('email'))
                          {{ $errors->first('email') }}
                        @endif
                    </span>
                </div>
                <div class="form-group">
                    <input class="form-control" placeholder="Mật khẩu" name="password" type="password">
                    <i class="fa fa-lock"></i>
                    <span>
                        @if($errors->any('password'))
                          {{ $errors->first('password') }}
                        @endif
                      </span>
                </div>
                <div class="form-group">
                    <button type="submit" class="submit">Đăng nhập</button>
                </div>
                <div class="two-col">
                    <div class="checkbox">
                        <label>
                            <input name="remember" type="checkbox" value="on"> Nhớ tài khoản
                        </label>
                    </div>
                    <div class="forgot">
                        <label>
                            <a href="#">Forgot password?</a>
                        </label>
                    </div>
                </div>
            </form>
        </div>
    </div>	
</body>

</html>
