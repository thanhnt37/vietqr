@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text mdl-color-text--blue">{{ session('message') ?: '' }}</h2>
                    </div>
                    <div class="mdl-card__table">
                        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-data-table--full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                                    <th class="mdl-data-table__cell--non-numeric">Lô</th>
                                    <th class="mdl-data-table__cell--non-numeric">Định dạng</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mô tả</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($exports as $k => $export)
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $k + $exports->firstItem() }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $export->batch->name }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $export->type }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $export->title }}</td>
                                    <td>
                                        @if($export->status == 1)
                                            <a href="{{ route('guarantee.exportcode.download', ['export' => $export->id]) }}">tải</a>
                                        @else
                                            processing
                                        @endif
                                        |
                                        <a href="{{ route('guarantee.exportcode.delete', ['export' => $export->id]) }}">xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mdl-typography--text-right">{{ $exports->links() }}</div>
                    </div>
                    <div class="mdl-card__menu">
                        <a href="{{ route('guarantee.batch.list') }}" id="showHistoryGenerateCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipHistory">history</i>
                            Lô mã
                        </a>
                        <span style="margin: 0 24px;">|</span>
                        <button id="showFilterCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipFilter">search</i>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                @include('components.dialog-filter-exportcode')
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
