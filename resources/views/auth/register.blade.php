<!DOCTYPE html>
<html>
<head lang="vi">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VCard</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <style>
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
<body class="scroll">
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
                    <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<style>
    .page-login {
        padding-top: 32px;
        padding-bottom: 80px;
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
            <h4 class="lead text-center pb-4 mt-4">Cùng trải ngiệm và tần hưởng các dịch vụ chúng tôi mang lại cho bạn.</h4>
            <style>
                #formLogin {
                    width: 352px;
                    background-color: rgba(0,0,0,.028);
                }
            </style>
            <form id="formLogin" action="{{ url('register') }}" method="post" class="mx-auto p-4">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('name') ? 'has-danger' : '' }}">
                    <label>Tên của bạn *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                    @if ($errors->has('name'))
                        <span class="form-control-feedback">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}">
                    <label>Chọn địa chỉ email bạn dùng *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                    @if ($errors->has('email'))
                        <span class="form-control-feedback">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                    <label>Mật khẩu đăng nhập *</label>
                    <input type="password" name="password" class="form-control">
                    @if ($errors->has('password'))
                        <span class="form-control-feedback">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}">
                    <label>Xác nhận mật khẩu của bạn *</label>
                    <input type="password" name="password_confirmation" class="form-control">
                    @if ($errors->has('password_confirmation'))
                        <span class="form-control-feedback">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                {{--<div class="form-group {{ $errors->has('date_of_birth') ? 'has-danger' : '' }}">--}}
                    {{--<label>Ngày sinh nhật</label>--}}
                    {{--<input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">--}}
                    {{--@if ($errors->has('date_of_birth'))--}}
                        {{--<span class="form-control-feedback">{{ $errors->first('date_of_birth') }}</span>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label>Giới tính</label>--}}
                    {{--<select class="form-control" name="gender">--}}
                        {{--@foreach(['male' => 'Nam', 'female' => 'Nữ', 'other' => 'Khác'] as $k => $v)--}}
                            {{--<option value="{{ $k }}" {{ $k == old('gender') ? 'selected' : '' }}>{{ $v }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                {{--</div>--}}
                {{--<div class="form-group {{ $errors->has('phone') ? 'has-danger' : '' }}">--}}
                    {{--<label>Số điện thoại</label>--}}
                    {{--<input type="text" class="form-control" name="phone">--}}
                    {{--@if ($errors->has('phone'))--}}
                        {{--<span class="form-control-feedback">{{ $errors->first('phone') }}</span>--}}
                    {{--@endif--}}
                {{--</div>--}}
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">Trải ngiệm</button>
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