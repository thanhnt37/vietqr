<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="Viet QR, qr code, qr marketing, nông sản, sản phẩm, mã vạch">
    <title>Viet QR</title>
    <meta name="msapplication-tap-highlight" content="no">
    <link rel="manifest" href="/manifest.json">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Web Starter Kit">
    <link rel="icon" sizes="192x192" href="/images/touch/chrome-touch-icon-192x192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Web Starter Kit">
    <link rel="apple-touch-icon" href="/images/touch/apple-touch-icon.png">
    <meta name="msapplication-TileImage" content="/images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#2F3BA2">
    <meta name="theme-color" content="#2F3BA2">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/styles/dialog-polyfill.css">
    <link rel="stylesheet" href="/styles/main.css">
    <script src="/scripts/dialog-polyfill.js"></script>
    <style>
        .mdl-card__title {
            min-height: 60px;
        }
    </style>
    @stack('styles')
</head>
<body class="mdl-color--grey-100 mdl-color-text--grey-700">
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
        <header class="mdl-layout__header">
            <div class="mdl-layout__header-row">
                <div class="mdl-layout-spacer"></div>
                <form action="{{ route('guarantee.search-code') }}" method="get">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" name="code" type="text" id="sample3">
                        <label class="mdl-textfield__label" for="sample3">Tìm kiếm serial, qrcode, sms</label>
                    </div>
                </form>
                <div class="mdl-layout-spacer"></div>
                <nav class="mdl-navigation mdl-layout--large-screen-only">
                    <div class="mdl-navigation__link"><i class="material-icons">notifications_none</i></div>
                    <div class="mdl-navigation__link">
                        <div class="user">
                            <img class="avatar" src="{{ $business->logo ? asset('storage/images/'.$business->logo) : '/images/avatar-default.png' }}" alt="Avatar">
                            <span class="name line-clamp--one-line" style="padding-bottom: 21px;max-width: 240px;display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical; overflow: hidden;">{{ $business->getDisplayName() ?: auth()->user()->name }}</span>
                        </div>
                    </div>
                </nav>
                <div class="menu" style="position: relative;">
                    <button id="demo-menu-top-right" class="mdl-button mdl-js-button mdl-button--icon">
                        <i class="material-icons">arrow_drop_down</i>
                    </button>
                    <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                        data-mdl-for="demo-menu-top-right">
                        <li class="mdl-menu__item" onclick="event.preventDefault();document.getElementById('formLogout').submit();">
                            Đăng xuất
                            <form id="formLogout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>
        <div class="mdl-layout__drawer">
            <div class="mdl-layout__title business">
                <img class="avatar" src="/images/avatar-default.png" alt="Viet QR">
                <span class="name">Viet QR</span>
            </div>
            <nav class="mdl-navigation" style="padding-bottom: 56px;">
                <a class="mdl-navigation__link {{ Route::is('guarantee.dashboard') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.dashboard') }}"><i class="material-icons">equalizer</i>Thống kê</a>
                <a class="mdl-navigation__link {{ Route::is('business.information') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('business.information') }}"><i class="material-icons">business</i>Thông tin doanh nghiệp</a>
                <a class="mdl-navigation__link {{ Route::is('guarantee.product.list') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.product.list') }}"><i class="material-icons">info</i>Thông tin sản phẩm</a>
                <a class="mdl-navigation__link {{ Route::is('customer.list') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('customer.list') }}"><i class="material-icons">contact_phone</i>Khách hàng</a>
                <hr>
                <a class="mdl-navigation__link {{ Route::is('guarantee.batch.list') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.batch.list') }}"><i class="material-icons">group_work</i>Lô tem</a>
                <a class="mdl-navigation__link {{ Route::is('guarantee.code.list') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.code.list') }}"><i class="material-icons">border_clear</i>Thông tin tem</a>
                <a class="mdl-navigation__link {{ Route::is('guarantee.exportcode') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.exportcode') }}"><i class="material-icons">cloud_download</i>Download tem</a>
                <hr>
                <a class="mdl-navigation__link {{ Route::is('guarantee.mamagement') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.mamagement') }}"><i class="material-icons">security</i>Dịch vụ bảo hành</a>
                <a class="mdl-navigation__link {{ Route::is('guarantee.agency.list') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.agency.list') }}"><i class="material-icons">store</i>Điểm bán</a>
                <hr>
                <a class="mdl-navigation__link {{ Route::is('guarantee.setting') ? 'mdl-navigation__link--current' : '' }}" href="{{ route('guarantee.setting') }}"><i class="material-icons">settings</i>Cài đặt</a>
            </nav>
        </div>
        <main class="mdl-layout__content">
            @yield('content')
        </main>
    </div>
    <script src="/scripts/main.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>
    @stack('scripts')

    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-XXXXX-X', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>
