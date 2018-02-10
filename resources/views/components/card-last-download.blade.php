<div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
    <div class="mdl-card__title">
        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Last download</div>
    </div>
    <div class="mdl-card__supporting-text">
        <table>
            <thead>
            <tr>
                <th>Title</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($downloads as $download)
            <tr>
                <td class="lc">{{ $download->title }}</td>
                <td><a href="{{ route('guarantee.exportcode.download', ['export' => $download->id]) }}">download</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mdl-card__actions mdl-typography--text-right">
        <a href="{{ route('guarantee.exportcode') }}" class="mdl-button mdl-js-button mdl-button--accent">view all</a>
    </div>
</div>