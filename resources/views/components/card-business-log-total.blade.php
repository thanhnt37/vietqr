<div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
    <div class="mdl-card__title">
        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Mã bảo hành</div>
    </div>
    <div class="mdl-card__menu">
        <a href="{{ route('guarantee.code.list') }}">all</a>
    </div>
    <div class="mdl-card__title">
        <table>
            <tbody>
            <tr>
                <td>Tổng:</td>
                <td>{{ $log->code }}</td>
            </tr>
            <tr>
                <td>Kích hoạt: </td>
                <td>{{ $log->code_activated_sms + $log->code_activated_app }}</td>
            </tr>
            <tr>
                <td>kích hoạt sms: </td>
                <td>{{ $log->code_activated_sms }}</td>
            </tr>
            <tr>
                <td>kích hoạt app: </td>
                <td>{{ $log->code_activated_app }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>