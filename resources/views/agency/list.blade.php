@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        @if (session('message'))<h2 class="mdl-card__title-text mdl-color-text--blue">{{ session('message') }}</h2>@endif
                    </div>
                    <div class="mdl-card__table">
                        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-data-table--full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                                    <th class="mdl-data-table__cell--non-numeric">Tên</th>
                                    <th class="mdl-data-table__cell--non-numeric">Địa chỉ</th>
                                    <th class="mdl-data-table__cell--non-numeric">Thành phố</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($agencies as $agency)
                                <tr data-id="{{ $agency->id }}">
                                    <td class="mdl-data-table__cell--non-numeric">{{ $agency->id }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $agency->name }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $agency->address }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $agency->city->name }}</td>
                                    <td>
                                        <a href="{{ route('guarantee.agency.edit', $agency->id) }}" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
                                            <i class="material-icons" id="tooltipEdit{{ $agency->id }}">mode_edit</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipEdit{{ $agency->id }}">Sửa điểm bán với ID {{ $agency->id }}</div>
                                        </a>
                                        <button type="submit" form="formDelete{{ $agency->id }}" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
                                            <i class="material-icons" id="tooltipDelete{{ $agency->id }}">delete</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipDelete{{ $agency->id }}">Xóa điểm bán với ID {{ $agency->id }}</div>
                                        </button>
                                        <form id="formDelete{{ $agency->id }}" action="{{ route('guarantee.agency.delete', $agency->id) }}" method="post">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mdl-card__menu">
                        <button id="showFilterAgency" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipFilter">search</i>
                            <div class="mdl-tooltip" for="tooltipFilter">Lọc điểm bán</div>
                            Tìm kiếm
                        </button>
                        <button type="submit" form="formDeleteMulti" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipDeleteAll">delete</i>
                            <div class="mdl-tooltip" for="tooltipDeleteAll">Xóa điểm bán</div>
                            Xóa
                        </button>
                        <button id="showModalAddAgency" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipAdd">add</i>
                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipAdd">Thêm điểm ban</div>
                            Thêm
                        </button>
                    </div>
                </div>
                @include('components.dialog-add-agency')
                @include('components.dialog-filter-agency')
                <form id="formDeleteMulti" action="{{ route('guarantee.agency.deleteall') }}" method="post">
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