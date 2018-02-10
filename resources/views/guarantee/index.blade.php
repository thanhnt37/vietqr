@extends('layout')
<style>
    .mdl-table.mdl-data-table {
        border: none;
    }
</style>
@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-total-code')
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-total-batch')
            </div>
            <div class="mdl-cell mdl-cell--4-col">
                @include('components.card-total-download')
            </div>
        </div>
    </section>
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <div class="mdl-card__subtitle-text mdl-color-text--grey-900">Khách hàng kích hoạt bảo hành</div>
                    </div>
                    <table class="mdl-table mdl-data-table mdl-js-data-table mdl-data-table--full-width">
                        <thead>
                        <tr>
                            <th class="mdl-data-table__cell--non-numeric">STT</th>
                            <th class="mdl-data-table__cell--non-numeric">Tên Khách hàng</th>
                            <th class="mdl-data-table__cell--non-numeric">Số điện thoại</th>
                            <th class="mdl-data-table__cell--non-numeric">Email</th>
                            <th class="mdl-data-table__cell--non-numeric">Địa chỉ</th>
                            <th>Mã kích hoạt</th>
                            <th>Hạn bảo hành</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($customers as $k => $user)
                            <tr>
                                <td class="mdl-data-table__cell--non-numeric">{{ $k + 1 }}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{ $user->name }}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{ $user->phone }}</td>
                                <td class="mdl-data-table__cell--non-numeric">{{ $user->email }}</td>
                                <td class="mdl-data-table__cell--non-numeric" style="white-space: normal;">{{ $user->address }}</td>
                                <td><a href="{{ route('guarantee.code.show', ['code' => $user->code_id]) }}">{{ $user->code_id }}</a></td>
                                <td>{{ $user->getExpireDate() }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="mdl-typography--text-right">{{ $customers->links() }}</div>
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

@push('scripts')
@endpush