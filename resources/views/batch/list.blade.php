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
                                    <th class="mdl-data-table__cell--non-numeric">Tên</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mã sản phẩm</th>
                                    <th class="mdl-data-table__cell--non-numeric">Loại</th>
                                    <th>Số lượng</th>
                                    <th>Ngày tạo</th>
                                    <th class="mdl-data-table__cell--non-numeric" style="text-align: center;">Trạng thái</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($batches as $batch)
                                <tr data-id="{{ $batch->id }}">
                                    <td class="mdl-data-table__cell--non-numeric">{{ $batch->id }}</td>
                                    <td class="mdl-data-table__cell--non-numeric" style="white-space: normal;">{{ $batch->name }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $batch->product_id }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $batch->metadata['service'] == 1 ? 'bảo hành' : 'chống giả' }}</td>
                                    <td>{{ $batch->quantity }}</td>
                                    <td>{{ $batch->createdDate() }}</td>
                                    <td class="mdl-data-table__cell--non-numeric" style="text-align: center;">{{ $batch->generate_code_status == 0 ? 'chưa' : 'đã tạo' }}</td>
                                    <td>
                                        <a href="{{ route('guarantee.batch.show', ['batch' => $batch->id]) }}" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
                                            <i class="material-icons" id="tooltipEdit{{ $batch->id }}">info</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipEdit{{ $batch->id }}">Thông tin lô với ID {{ $batch->id }}</div>
                                        </a>
                                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored show-export-code" data-id="{{ $batch->id }}">
                                            <i class="material-icons" id="tooltipExport{{ $batch->id }}">import_export</i>
                                            <div class="mdl-tooltip" for="tooltipExport{{ $batch->id }}">Xuất mã</div>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mdl-typography--text-right">{{ $batches->links() }}</div>
                    </div>
                    <div class="mdl-card__menu">
                        <a href="{{ route('guarantee.exportcode') }}" id="showHistoryGenerateCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">cloud_download</i>
                            Download
                        </a>
                        <span style="margin: 0 24px;">|</span>
                        <button id="showFilterCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">search</i>
                            Tìm kiếm
                        </button>
                        <button type="submit" form="formDeleteMulti" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">delete</i>
                            Xóa
                        </button>
                        <button id="showModalAddCode" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">add</i>
                            Tạo lô tem
                        </button>
                    </div>
                </div>
                @include('components.dialog-add-batch')
                @include('components.dialog-filter-batch')
                @include('components.dialog-export-code')
                @if(session('update'))
                    @include('components.dialog-tutorial-exportcode')
                @endif
                <form id="formDeleteMulti" action="{{ route('guarantee.batch.deleteall') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}
                </form>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
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