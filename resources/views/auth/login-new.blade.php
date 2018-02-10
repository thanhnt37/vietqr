<!DOCTYPE html>
<html>
<head lang="vi">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VCard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
        body {
            /*font-family: 'Roboto'*/
        }
        .scroll {
            overflow: scroll;
            overflow-x: hidden;
        }
        .scroll::-webkit-scrollbar {
            width: 0.4rem;
        }

        .scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .scroll::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,.28);
        }
        .sd-2dp {
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.4),
            0 3px 1px -2px rgba(0, 0, 0, 0.2),
            0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }
    </style>
</head>
<body>
<header class="container">
    <nav class="navbar navbar-light navbar-toggleable fix-top">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav">
                <li class="nav-item active"><a class="nav-link" href="#">Qrcode là gì</a></li>
                <li class="nav-item active ml-4"><a class="nav-link" href="#">Dịch vụ của chúng tôi</a></li>
                <li class="nav-item active ml-4"><a class="nav-link" href="#">Liên hệ</a></li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<style>
    .page-login {
        padding-top: 32px;
    }
</style>
<main class="container page-login">
    <div class="row">
        <div class="col-7">
            <h1 class="display-3 mb-4 text-primary">life is a one way ticket</h1>
            <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        </div>
        <div class="col-5">
            <h4 class="text-center font-weight-normal pb-4 mt-4">Don't dream your life, live you dreams</h4>
            <style>
                #formLogin {
                    width: 320px;
                }
            </style>
            <form id="formLogin" action="{{ route('login') }}" method="post" class="mx-auto pt-2" style="width: 320px;">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="inputUsername" class="sr-only">Tên đăng nhập</label>
                    <input type="text" name="email" value="{{ old('email') }}" class="form-control" id="inputEmail" placeholder="Tên đăng nhập">
                    @if ($errors->has('email'))
                        <span class="form-control-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="sr-only">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Mật khẩu">
                    @if ($errors->has('password'))
                        <span class="form-control-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </div>
                <div class="text-center">
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        Quên mật khẩu?
                    </a>
                </div>
            </form>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>