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
                                    <th class="mdl-data-table__cell--non-numeric">Mã QR</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mã SMS</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mã lô</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mã sản phẩm</th>
                                    <th class="mdl-data-table__cell--non-numeric">Kích hoạt</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($codes as $code)
                                <tr data-id="{{ $code->id }}">
                                    <td class="mdl-data-table__cell--non-numeric"><a href="{{ route('guarantee.code.show', ['code' => $code->id]) }}">{{ $code->id }}</a></td>
                                    <td class="mdl-data-table__cell--non-numeric"><a href="{{ route('guarantee.code.show', ['code' => $code->id]) }}">{{ $code->code() }}</a></td>
                                    <td class="mdl-data-table__cell--non-numeric"><a href="{{ route('guarantee.code.show', ['code' => $code->id]) }}">{{ $code->sms() }}</a></td>
                                    <td class="mdl-data-table__cell--non-numeric"><a href="{{ route('guarantee.batch.show', ['batch' => $code->batch_id]) }}">{{ $code->batch_id }}</a></td>
                                    <td class="mdl-data-table__cell--non-numeric"><a href="{{ route('guarantee.product.edit', ['product' => $code->product_id]) }}">{{ $code->product_id }}</a></td>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="statusCode{{ $code->id }}" style="width: 36px;">
                                            <input type="checkbox" id="statusCode{{ $code->id }}" class="mdl-switch__input status" {{ $code->active == 1 ? 'checked' : '' }} data-url="{{ route('ajax.code.active', ['code' => $code->id, 'type' => 0, 'status' => $code->active == 1 ? 'false' : 'true'], false) }}">
                                            <span class="mdl-switch__label"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <button type="button" data-code="{{ $code->code() }}" class="mdl-button mdl-js-button mdl-button--colored show-demo">demo</button>
                                        <button type="button" data-form-id="formDelete{{ $code->id }}" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored delete-code">
                                            <i class="material-icons" id="tooltipDelete{{ $code->id }}">delete</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipDelete{{ $code->id }}">Xóa mã với ID {{ $code->id }}</div>
                                        </button>
                                        <form id="formDelete{{ $code->id }}" action="{{ route('guarantee.code.delete', $code->id) }}" method="post">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mdl-typography--text-right">{{ $codes->links() }}</div>
                    </div>
                    <div class="mdl-card__menu">
                        <a href="{{ route('guarantee.exportcode') }}" id="showHistoryGenerateCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">cloud_download</i>
                            Tải mã
                        </a>
                        <a href="{{ route('guarantee.batch.list') }}" id="showHistoryGenerateCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">history</i>
                            Lô bảo hành
                        </a>
                        <span style="margin: 0 24px;">|</span>
                        <button id="showFilterCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">search</i>
                            Tìm kiếm
                        </button>
                        <button type="button" data-form-id="formDeleteMulti" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-code">
                            <i class="material-icons">delete</i>
                            Xóa
                        </button>
                    </div>
                </div>
                @include('components.dialog-filter-code', ['batches' => $batches, 'products' => $products])
                @include('components.dialog-confirm-delete-code')
                @include('components.dialog-demo')
                <form id="formDeleteMulti" action="{{ route('guarantee.code.deleteall') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        "use strict";
        {
            var statuses = document.querySelectorAll('input[type="checkbox"].status');

            for (let status of statuses) {
                status.addEventListener('change', function (event) {
                    var url = this.dataset.url;

                    fetch(url, {
                        credentials: 'include'
                    })
                        .then((response) => {
                            //
                        })
                        .catch((error) => {
                            //
                        });
                });
            }
        }
    </script>
    <script>
        {
            window.addEventListener('load', function (event) {
                var rows = document.querySelectorAll('tbody > tr');

                for (row of rows) {
                    var id = row.dataset.id;
                    var input = row.querySelector('td:first-child input');

                    if (input !=  null) {
                        input.setAttribute('form', 'formDeleteMulti');
                        input.setAttribute('name', 'ids[]');
                        input.setAttribute('value', id);
                    }
                }
            });
        }
    </script>
@endpush