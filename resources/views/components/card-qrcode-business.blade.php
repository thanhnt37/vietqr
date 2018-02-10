<div class="mdl-card mdl-card--auto-height mdl-card--full-width mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
        QR Code marketing
    </div>
    <div class="mdl-card__supporting-text" style="padding-top: 0; padding-bottom: 0">
        <span>Cập nhật thông tin doanh nghiệp và <a href="{{ route('business.qrcode.download', ['business' => $business->id]) }}">download</a> qrcode để sử dụng</span>
    </div>
    <div class="mdl-card__title">
        <img src="{{ route('business.qrcode', ['business' => $business->id]) }}" alt="{{ $business->name }}" style="max-width: 100%;">
    </div>
    <div class="mdl-card__actions">
        <a href="{{ route('business.qrcode.download', ['business' => $business->id]) }}" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">download</a>
    </div>
</div>