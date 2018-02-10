@extends('layout')

@push('styles')
    <style>
        .mdl-data-table {
            width: 100%;
            border: none;
        }
        .mdl-card.mdl-card--auto-height {
            min-height: auto;
        }
    </style>
@endpush

@section('content')
    <header>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width mdl-card--auto-height">
                    <div class="mdl-card__title">
                        <div class="mdl-card__title-text"><a href="{{ route('guarantee.code.list') }}"><i class="material-icons">arrow_back</i> Danh sách mã</a></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <section>
        <div class="mdl-grid mdl-grid--no-spacing">
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <div class="mdl-card__title-text">Thông tin mã</div>
                            </div>
                            <table class="mdl-data-table mdl-js-data-table">
                                <tbody>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">ID</td>
                                    <td>{{ $code->id }}</td>
                                </tr>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">QR Code</td>
                                    <td>{{ $code->code() }}</td>
                                </tr>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">SMS</td>
                                    <td>{{ $code->sms() }}</td>
                                </tr>
                                <tr>
                                    <td class="mdl-data-table__cell--non-numeric">Active</td>
                                    <td>
                                        <label class="mdl-switch mdl-js-switch mdl-js-ripple-effect" for="statusCode{{ $code->id }}" style="width: 36px;">
                                            <input type="checkbox" id="statusCode{{ $code->id }}" class="mdl-switch__input status" {{ $code->active == 1 ? 'checked' : '' }} data-url="{{ route('ajax.code.active', ['code' => $code->id, 'type' => 0, 'status' => $code->active == 1 ? 'false' : 'true'], false) }}">
                                            <span class="mdl-switch__label"></span>
                                        </label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--12-col">
                        <?php $product = $code->product ?>
                        <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <div class="mdl-card__title-text">Sản phẩm</div>
                            </div>
                            @if($product)
                                <table class="mdl-data-table mdl-js-data-table">
                                    <tbody>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">ID</td>
                                        <td>{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Tên sản phẩm</td>
                                        <td>{{ $product->name }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="mdl-card__supporting-text">
                                    <p>Bạn muốn <a id="showModalUpdateProductForCode" href="javascript:void(0)">thay đổi</a> sản phẩm cho lô tem này.</p>
                                </div>
                            @else
                                <div class="mdl-card__supporting-text">
                                    <p>Chưa có thông tin sản phẩm cho lô tem này. hãy <a id="showModalUpdateProductForCode" href="javascript:void(0)">cập nhật</a> thêm sản phẩm cho lô.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--6-col">
                <div class="mdl-grid">
                    <div class="mdl-cell mdl-cell--12-col">
                        <div class="mdl-card mdl-card--full-width mdl-shadow--2dp">
                            <div class="mdl-card__title">
                                <div class="mdl-card__title-text">Thông tin bảo hành</div>
                            </div>
                            @if($guaranteeActive = $code->guaranteeActive)
                                <table class="mdl-data-table mdl-js-data-table">
                                    <tbody>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Tên khách hàng</td>
                                        <td>{{ $guaranteeActive->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Số điện thoại</td>
                                        <td>{{ $guaranteeActive->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Email</td>
                                        <td>{{ $guaranteeActive->email }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Địa chỉ</td>
                                        <td style="white-space: normal;text-align: left">{{ $guaranteeActive->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Ngày kích hoạt</td>
                                        <td>{{ $guaranteeActive->getActiveDate() }}</td>
                                    </tr>
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">Hạn bảo hành</td>
                                        <td>{{ $guaranteeActive->getExpireDate() }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="mdl-card__supporting-text">
                                    <p>Mã đã kích hoạt bảo hành. Bạn muốn cập nhật thông tin kích hoạt ? <a id="showModalActive" href="javascript:void(0)">cập nhật</a></p>
                                </div>
                            @else
                                <div class="mdl-card__supporting-text">
                                    <p>Mã chưa kích hoạt bảo hành. Bạn muốn kích hoạt ? <a id="showModalActive" href="javascript:void(0)">kích hoạt</a></p>
                                </div>
                            @endif
                            @include('components.dialog-guarantee-active', ['active' => $guaranteeActive, 'code' => $code])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-card mdl-card--full-width">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text mdl-color-text--blue">Lịch sử bảo hành</h2>
                    </div>
                    @if($histories = $code->histories()->latest('date')->get())
                        <div class="mdl-card__table">
                            <table class="mdl-data-table mdl-js-data-table mdl-data-table--selectable mdl-data-table--full-width">
                                <thead>
                                <tr>
                                    <th class="mdl-data-table__cell--non-numeric">Ngày</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($histories as $history)
                                    <tr>
                                        <td class="mdl-data-table__cell--non-numeric">{{ $history->date->format('d-m-Y') }}</td>
                                        <td>
                                            <a class="description" href="#" data-content="{{ $history->description }}">nội dung</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="mdl-card__menu">
                        <button id="showModalAddHistory" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                            <i class="material-icons">add</i>
                            Thêm lịch sử bảo hành
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.dialog-update-product-for-code', ['code' => $code])
    @include('components.dialog-add-history', ['code' => $code])
    <dialog id="dialogShowHistory" class="mdl-dialog" style="width: 690px; max-height: 90%; overflow-y: scroll">
        <div id="xxx" class="mdl-dialog__content"></div>
        <div class="mdl-dialog__actions">
            <button type="button" class="mdl-button mdl-js-button close">Đóng</button>
        </div>
    </dialog>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        window.addEventListener('load', function (event) {
            var textareas = document.querySelectorAll('textarea');

            for (textarea of textareas) {
                CKEDITOR.replace(textarea);
            }
        });
    </script>
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
        "use strict";
        {
            var contents = document.querySelectorAll('.description');
            var dialogx = document.getElementById('dialogShowHistory');

            if (! dialogx.showModal) {
                dialogPolyfill.registerDialog(dialogx);
            }

            for (let content of contents) {
                content.addEventListener('click', function () {
                    let text = this.dataset.content;

                    document.getElementById('xxx').innerHTML = text;
                    dialogx.showModal();
                });
            }

            dialogx.querySelector('.close').addEventListener('click', function() {
                dialogx.close();
            });
        }
    </script>
@endpush