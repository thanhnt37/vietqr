@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text mdl-color-text--blue"></h2>
                    </div>
                    <div class="mdl-card__table">
                        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-data-table--full-width">
                            <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">Tên</th>
                                <th class="mdl-data-table__cell--non-numeric">Số điện thoại</th>
                                <th class="mdl-data-table__cell--non-numeric">Email</th>
                                <th class="mdl-data-table__cell--non-numeric">Địa chỉ</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr data-id="{{ $customer->id }}">
                                    <td class="mdl-data-table__cell--non-numeric">{{ $customer->name }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $customer->phone }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $customer->email }}</td>
                                    <td class="mdl-data-table__cell--non-numeric" style="white-space: normal">{{ $customer->address }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="mdl-typography--text-right">{{ $customers->links() }}</div>
                    </div>
                    <div class="mdl-card__menu">
                        <button id="showFilterCustomer" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipFilter">search</i>
                            <div class="mdl-tooltip" for="tooltipFilter">Lọc điểm bán</div>
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                @include('components.dialog-filter-customer')
            </div>
        </div>
    </section>
@endsection