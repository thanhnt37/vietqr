<div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
    <div class="mdl-card__title">
        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Khu vực kích hoạt</div>
    </div>
    <div class="mdl-card__menu">
        <a href="#">all</a>
    </div>
    <div class="mdl-card__title">
        <table>
            <tbody>
            @foreach($cities as $city)
            <tr>
                <td>{{ $city->name }}</td>
                <td>{{ $city->log_activities_count }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>