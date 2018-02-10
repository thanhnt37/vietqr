<div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
    <div class="mdl-card__title">
        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Điểm bảo hành</div>
    </div>
    <div class="mdl-card__supporting-text">
        <table>
            <thead>
            <tr>
                <th>Điểm bảo hành</th>
                <th>Số lượng</th>
            </tr>
            </thead>
            <tbody>
            @foreach($agencies as $agency)
            <tr>
                <td class="lc">{{ $agency->name }}</td>
                <td>{{ $agency->log_activities_count }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions mdl-typography--text-right">
        <a href="#" class="mdl-button mdl-js-button mdl-button--accent">view all</a>
    </div>
</div>