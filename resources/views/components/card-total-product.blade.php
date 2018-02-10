<div class="mdl-card mdl-card--auto-height mdl-card--full-width mdl-card mdl-shadow--2dp">
    <div class="mdl-card__title">
        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Tổng số sản phẩm</div>
    </div>
    <div class="mdl-card__supporting-text">
        <div class="mdl-typography--display-2">{{ $count }}</div>
    </div>
    <div class="mdl-card__menu">
        <a href="{{ route('guarantee.product.list') }}">chi tiết</a>
    </div>
</div>