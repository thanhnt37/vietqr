@extends('layout')

@section('content')
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                    <div class="mdl-card__title">
                        @if (session('message'))<h2 class="mdl-card__title-text mdl-color-text--blue">{{ session('message') }}</h2>@endif
                    </div>
                    <div class="mdl-card__table">
                        <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-data-table--full-width">
                            <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">ID</th>
                                    <th class="mdl-data-table__cell--non-numeric">Ảnh</th>
                                    <th class="mdl-data-table__cell--non-numeric">Mã GTIN</th>
                                    <th class="mdl-data-table__cell--non-numeric">Tên</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr data-id="{{ $product->id }}">
                                    <td class="mdl-data-table__cell--non-numeric">{{ $product->id }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">
                                        <img src="{{ $product->logo ? asset('storage/images/'.$product->logo) : 'holder.js/32x32' }}" width="32" height="32">
                                    </td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $product->gtin }}</td>
                                    <td class="mdl-data-table__cell--non-numeric">{{ $product->name }}</td>
                                    <td>
                                        <a href="{{ route('guarantee.product.edit', $product->id) }}" class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored">
                                            <i class="material-icons" id="tooltipEdit{{ $product->id }}">mode_edit</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipEdit{{ $product->id }}">Sửa sản phẩm với ID {{ $product->id }}</div>
                                        </a>
                                        <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored delete-product"
                                            data-form-id="formDeleteProduct{{ $product->id }}">

                                            <i class="material-icons" id="tooltipDelete{{ $product->id }}">delete</i>
                                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipDelete{{ $product->id }}">Xóa sản phẩm với ID {{ $product->id }}</div>
                                        </button>
                                        <form id="formDeleteProduct{{ $product->id }}" action="{{ route('guarantee.product.delete', $product->id) }}" method="post">{{ csrf_field() }}{{ method_field('delete') }}</form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mdl-card__menu">
                        <button id="showFilterProduct" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipFilter">search</i>
                            <div class="mdl-tooltip" for="tooltipFilter">Lọc sản phẩm</div>
                            Tìm kiếm
                        </button>
                        <button type="button" data-form-id="formDeleteMulti" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored delete-product">
                            <i class="material-icons" id="tooltipDeleteAll">delete</i>
                            <div class="mdl-tooltip" for="tooltipDeleteAll">Xóa sản phẩm</div>
                            Xóa
                        </button>
                        <button id="showModalAddProduct" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons" id="tooltipAdd">add</i>
                            <div class="mdl-tooltip mdl-tooltip--left" for="tooltipAdd">Thêm sản phẩm</div>
                            Thêm
                        </button>
                    </div>
                </div>
                @include('components.dialog-add-product')
                @include('components.dialog-filter-product')
                @include('components.dialog-confirm-delete-product')
                <form id="formDeleteMulti" action="{{ route('guarantee.product.deleteall') }}" method="post">
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