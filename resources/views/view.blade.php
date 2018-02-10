<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VQR</title>
    <link rel="manifest" href="/manifest.json">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="/styles/main.css">
    <link rel="stylesheet" href="/styles/dialog-polyfill.css">
    <style>
        .c1.mdl-card {
            min-width: 100%;
        }
        .c1 > .mdl-card__title {
            color: #fff;
            height: 240px;
            background: url('{{ $productImage }}') center / cover;
        }
        .c1 .mdl-card__subtitle-text {
            color: inherit;
            align-self: flex-end;
        }
        .c2.mdl-card {
            margin-top: 16px;
            width: 100%;
        }
        .c2 .mdl-list {
            margin-top: 0;
        }
        .c3.mdl-card {
            margin-top: 16px;
            width: 100%;
        }
        .mdl-card__supporting-text {
            width: 100%;
            box-sizing: border-box;
        }
    </style>

    <script src="/scripts/dialog-polyfill.js"></script>
</head>
<body class="mdl-color--grey-100 mdl-color-text--grey-700">
    <div class="mdl-layout mdl-js-layout">
        <main class="mdl-layout__content">
            <div class="c1 mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">{{ $productName }}</div>
                </div>
            </div>
            @if ($service == 2)
                <div class="mdl-shadow--2dp" style="margin-top: 16px; width: 100%; min-height: auto; color: #FFF; text-align: center;background: #4285f4">
                    <h4 class="mdl-typography--text-uppercase" style=" padding: 16px;">Sản phẩm chính hãng</h4>
                </div>
                @if ($code->anti_counterfeit == 0)
                    @include('components.dialog-active-cg-code', ['codeId' => $codeId, 'sms' => $sms])
                @endif
            @endif
            <div class="c2 mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">Thông tin doanh nghiệp</div>
                </div>
                <ul class="mdl-list">
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">business</i>
                            <span>{{ $businessName ?: 'Chưa có' }}</span>
                        </span>
                    </li>
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">phone</i>
                            <a href="tel:{{ $businessPhone }}">{{ $businessPhone ?: 'Chưa có' }}</a>
                        </span>
                    </li>
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">email</i>
                            <a href="mailto:{{ $businessEmail }}">{{ $businessEmail ?: 'Chưa có' }}</a>
                        </span>
                    </li>
                    <li class="mdl-list__item">
                        <span class="mdl-list__item-primary-content">
                            <i class="material-icons mdl-list__item-icon">location_city</i>
                            <span>{{ $businessAddress ?: 'Chưa có' }}</span>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="c3 mdl-card mdl-shadow--2dp">
                <div class="mdl-card__title">
                    <div class="mdl-card__title-text">Thông tin sản phẩm</div>
                </div>
                <div class="mdl-card__supporting-text">{!! $productInformation ?: 'Chưa có thông tin sản phẩm' !!}</div>
            </div>
            @if($active && $service == 1)
                @include('components.dialog-active-code', ['codeId' => $codeId])
            @endif
            @if(!$active && $service == 1)
                @include('components.dialog-actived-guarantee', ['gactive' => $gactive])
            @endif
            @if(session('message'))
                @include('components.dialog-active-success')
            @endif
        </main>
    </div>

    <script src="/scripts/main.min.js"></script>

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
